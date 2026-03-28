# Incremental Refactor Plan (Production-Ready Laravel)

## Context
Website property ini akan direfactor secara **inkremental** menjadi arsitektur Laravel yang lebih production-ready, tanpa mematahkan fungsi yang sudah ada.

## Constraints (Hard Rules)
- Jangan rewrite seluruh app sekaligus.
- Preserve existing functionality.
- Buat perubahan kecil dan aman.
- Reuse models/views/routes yang sudah ada.
- Jika logic sudah ada, refactor (bukan duplicating).
- File baru dibuat jika belum ada.

## Target Architecture (Ringkas)
1. Controller harus tipis (thin controllers).
2. Validasi dipindahkan ke Form Requests.
3. Business logic dipindahkan ke Services.
4. Authorization via Policies (khusus admin actions).
5. Tambah database table `inquiries/leads`, indexes untuk listing, dan perbaikan konsistensi data.

---

## PHASE 1 — Discovery
### Apa yang ditemukan (summary)
- Controller yang ada:
  - `app/Http/Controllers/HomeController.php` (home/featured/latest)
  - `app/Http/Controllers/CategoryController.php` (kategori detail)
  - `app/Http/Controllers/PropertyController.php` (listing/detail + endpoint upload gambar publik)
  - `app/Http/Controllers/AdminController.php` (admin CRUD property/category + upload gambar)
  - `app/Http/Controllers/AuthController.php` (login/super-admin)
- Admin middleware:
  - `app/Http/Middleware/AdminMiddleware.php`
  - alias `admin` terdaftar di `bootstrap/app.php`
- Routing:
  - Main routing ada di `routes/web.php`
  - Admin routes sudah menggunakan middleware `['auth','admin']`
  - Ada endpoint gambar publik yang saat ini belum terproteksi admin (akan ditangani di fase keamanan)
- Models + Schema property:
  - `app/Models/Property.php`, `PropertyImage.php`, `Category.php`, `User.php`
  - migrations: `categories`, `properties`, `property_images`, `users.role`
- Inquiry/contact flow:
  - Belum ada backend lead capture (belum ada table `inquiries`, belum ada endpoint `POST /inquiries`)
  - Form contact di `resources/views/home.blade.php` saat ini `action="#"` (tidak menyimpan lead)
- WhatsApp logic:
  - Nomor WA hard-coded di view (`wa.me/...`)
  - Template/format WA tersebar di view (belum single source of truth)
- Image upload logic:
  - Ada dua alur upload gambar: milik `PropertyController` dan `AdminController`
  - Teridentifikasi potensi inconsistency: nama input untuk primary image berbeda antara UI publik vs admin

### Output Phase 1
- Rangkuman arsitektur awal (controllers/routes/models/schema) seperti di atas.
- Daftar perubahan besar yang akan dilakukan di fase refactor berikutnya.

### Status Phase 1
✅ Discovery selesai (tanpa perubahan kode produksi).

---

## PHASE 2 — Safe Refactor Foundation (Done)
### Tujuan
- Siapkan folder struktur baru.
- Buat Form Requests.
- Pindahkan validasi dari controller ke Form Requests.
- Tetap jaga agar response/route/view behavior tidak berubah.

### Yang dibuat / diubah (tepatnya)
1. Folder baru:
   - `app/Http/Requests/`
   - `app/Http/Controllers/Admin/`
   - `app/Services/`
   - `app/Policies/`

2. Form Requests (baru):
   - `app/Http/Requests/PropertySearchRequest.php`
     - Validasi query filter listing: keyword, kategori, type, status, city, min/max price, sort
     - Mendukung `price_range` (hero) dengan mapping ke `min_price/max_price` agar kompatibel dengan logic controller yang ada.
   - `app/Http/Requests/LeadInquiryRequest.php`
     - Fondasi validasi lead/inquiry (belum di-hook karena belum ada endpoint backend inquiry saat ini).
   - `app/Http/Requests/PropertyImageUploadRequest.php`
     - Validasi upload gambar: array file, tipe image, mimes, max size
     - Mengizinkan input legacy `set_first_as_primary` (dan `is_primary` bila ada).

3. Refactor controller minimal (tanpa mengubah route/view):
   - `app/Http/Controllers/PropertyController.php`
     - `index()` type-hint ke `PropertySearchRequest` (validasi aktif via FormRequest)
     - `uploadImages()` type-hint ke `PropertyImageUploadRequest`
     - blok `validate()` untuk upload gambar dihapus (dipindah ke FormRequest)
   - `app/Http/Controllers/AdminController.php`
     - `uploadImages()` type-hint ke `PropertyImageUploadRequest`
     - blok `validate()` untuk upload gambar dihapus (dipindah ke FormRequest)

### Kenapa ini aman
- Tidak mengubah logic query/bisnis secara luas.
- Tidak mengubah view output.
- Perubahan hanya pada validasi request dan type-hint signature.

### Risiko regresi (yang mungkin)
- Jika UI mengirim nilai filter/sort yang tidak sesuai rule FormRequest, validasi bisa gagal.
- `price_range` mapping hanya terjadi jika `min_price` dan `max_price` belum ada (jadi kompatibel dengan existing behavior).

### Status Phase 2
✅ Dilakukan dan lulus syntax check (`php -l`) + tidak ada linter errors.

---

## PHASE 3 — Service Layer (Next Step, belum dikerjakan)
### Target
- Tambah Services:
  - `PropertyQueryService`
  - `InquiryService`
  - `PropertyImageService`
  - `WhatsAppService`
- Controller akan dipendekkan secara bertahap:
  - listing/detail -> query service
  - upload/delete/primary -> image service
  - inquiry/lead -> inquiry service + WhatsAppService

### Urutan implementasi yang disarankan (aman)
1. Buat Service classes (tanpa mengubah controller dulu).
2. Pindahkan logic keyword/filter/pagination dari `PropertyController@index` ke `PropertyQueryService`, lalu update controller memanggil service.
3. Pindahkan upload primary logic ke `PropertyImageService`, lalu update controller memanggil service.
4. Setelah ada endpoint inquiry backend, baru integrasikan `LeadInquiryRequest` + `InquiryService`.

---

## Phase Checklist Ringkas
- Phase 1: Discovery ✅
- Phase 2: Safe Refactor Foundation ✅
- Phase 3: Service Layer ✅
- Phase 4: Split Admin Controllers ✅
- Phase 5: Policies & Security + Dashboard Cleanup ✅
- Phase 6: Database (inquiries + property listing indexes) ✅
- Phase 7: Route Cleanup & Grouping ✅
- Phase 8: View Integration (Inquiry Flow + UI feedback states) ✅
- Phase 9: Stability Check (smoke test + feature test fix) ✅

