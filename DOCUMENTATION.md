# Dokumentasi Website Jagad Property

## 📋 Daftar Isi
1. [Overview](#overview)
2. [Fitur Website](#fitur-website)
3. [Struktur Proyek](#struktur-proyek)
4. [Instalasi & Setup](#instalasi--setup)
5. [Konfigurasi](#konfigurasi)
6. [Cara Penggunaan](#cara-penggunaan)
7. [Super Admin Panel](#super-admin-panel)
8. [Database Structure](#database-structure)
9. [Routes](#routes)
10. [Troubleshooting](#troubleshooting)

---

## Overview

**Jagad Property** adalah website untuk menampilkan katalog property (rumah, tanah, apartemen, dll) dengan sistem admin panel untuk mengelola konten.

### Teknologi yang Digunakan
- **Framework**: Laravel 12.41.1
- **PHP**: 8.3.16
- **Database**: SQLite (default) / MySQL
- **Frontend**: Tailwind CSS
- **Asset Bundler**: Vite

---

## Fitur Website

### 🏠 Website Public (User)
1. **Homepage**
   - Hero section dengan quick filters
   - Trust badges section
   - Project showcase (menampilkan 3 property terbaru)
   - About section dengan timeline
   - Testimoni carousel
   - Contact section dengan Google Maps
   - WhatsApp integration

2. **Property Listing**
   - Daftar semua property
   - Filter berdasarkan kategori, kota, harga
   - Search functionality
   - Pagination

3. **Property Detail**
   - Galeri foto
   - Detail lengkap property
   - Informasi kontak penjual
   - WhatsApp contact button

### 🔐 Super Admin Panel
1. **Dashboard**
   - Statistik website (Total Properties, Active, Featured, Categories)
   - Tabel property terbaru

2. **Manajemen Properties**
   - CRUD (Create, Read, Update, Delete)
   - Upload multiple images
   - Set primary image
   - Delete images

3. **Manajemen Categories**
   - CRUD Categories
   - Validasi saat delete (cek apakah masih digunakan)

---

## Struktur Proyek

```
web-jagadproperty/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      # Controller untuk admin panel
│   │   │   ├── AuthController.php       # Controller untuk authentication
│   │   │   ├── CategoryController.php   # Controller untuk categories
│   │   │   ├── HomeController.php       # Controller untuk homepage
│   │   │   └── PropertyController.php   # Controller untuk properties
│   │   └── Middleware/
│   │       └── AdminMiddleware.php      # Middleware untuk protect admin routes
│   └── Models/
│       ├── Category.php
│       ├── Property.php
│       ├── PropertyImage.php
│       └── User.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_12_10_044419_add_role_to_users_table.php
│   │   └── ... (migrations lainnya)
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── CategorySeeder.php
│       └── PropertySeeder.php
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── super-admin-login.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── properties/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── images.blade.php
│       │   └── categories/
│       │       ├── index.blade.php
│       │       ├── create.blade.php
│       │       └── edit.blade.php
│       ├── layouts/
│       │   ├── app.blade.php          # Layout untuk website public
│       │   └── admin.blade.php        # Layout untuk admin panel
│       ├── properties/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── home.blade.php
├── routes/
│   └── web.php                        # Semua routes aplikasi
├── public/
│   └── storage/                       # Storage untuk uploaded images
└── .env                               # Environment configuration
```

---

## Instalasi & Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd web-jagadproperty
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=sqlite
# atau
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jagad_property
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Setup Database
```bash
# Jika menggunakan SQLite, buat file database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Run seeders (optional)
php artisan db:seed
```

### 6. Setup Storage Link
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 8. Run Server
```bash
php artisan serve --port=8002
```

Akses website di: `http://localhost:8002`

---

## Konfigurasi

### User Admin Default
Setelah menjalankan seeder, user admin default:
- **Email**: `admin@jagadproperty.com`
- **Password**: `password`
- **Role**: `admin`

### WhatsApp Number
Semua link WhatsApp mengarah ke: `+62 857-8178-0369`

### Storage Configuration
File upload disimpan di: `storage/app/public/properties/`
Public access: `public/storage/properties/`

---

## Cara Penggunaan

### Untuk User (Website Public)

1. **Melihat Katalog Property**
   - Buka: `http://localhost:8002/`
   - Klik "Lihat Listing" atau "Project"
   - Filter berdasarkan kategori, kota, atau harga

2. **Melihat Detail Property**
   - Klik property yang diinginkan
   - Lihat galeri foto dan detail lengkap
   - Hubungi penjual via WhatsApp

3. **Kontak**
   - Klik tombol "Hubungi WA" di navbar
   - Atau scroll ke section "Kontak Kami"

### Untuk Super Admin

1. **Login Super Admin**
   - Buka: `http://localhost:8002/super-admin`
   - Masukkan email dan password
   - Klik "Masuk sebagai Super Admin"

2. **Dashboard**
   - Lihat statistik website
   - Lihat property terbaru
   - Navigasi ke menu lain via sidebar

3. **Kelola Properties**
   - Klik "Properties" di sidebar
   - **Tambah**: Klik "Tambah Property" → Isi form → Simpan
   - **Edit**: Klik icon edit → Ubah data → Update
   - **Hapus**: Klik icon delete → Konfirmasi
   - **Upload Gambar**: Klik "Manage Images" → Upload → Set Primary

4. **Kelola Categories**
   - Klik "Categories" di sidebar
   - **Tambah**: Klik "Tambah Category" → Isi form → Simpan
   - **Edit**: Klik icon edit → Ubah data → Update
   - **Hapus**: Klik icon delete → Konfirmasi (validasi otomatis)

---

## Super Admin Panel

### Routes Admin

#### Authentication
- `GET /super-admin` - Halaman login super admin
- `POST /super-admin` - Proses login super admin

#### Dashboard
- `GET /admin/dashboard` - Dashboard admin

#### Properties Management
- `GET /admin/properties` - List semua properties
- `GET /admin/properties/create` - Form tambah property
- `POST /admin/properties` - Simpan property baru
- `GET /admin/properties/{id}/edit` - Form edit property
- `PUT /admin/properties/{id}` - Update property
- `DELETE /admin/properties/{id}` - Hapus property

#### Property Images
- `GET /admin/properties/{id}/images` - Halaman manage images
- `POST /admin/properties/{id}/images` - Upload images
- `DELETE /admin/images/{id}` - Hapus image
- `POST /admin/images/{id}/set-primary` - Set primary image

#### Categories Management
- `GET /admin/categories` - List semua categories
- `GET /admin/categories/create` - Form tambah category
- `POST /admin/categories` - Simpan category baru
- `GET /admin/categories/{id}/edit` - Form edit category
- `PUT /admin/categories/{id}` - Update category
- `DELETE /admin/categories/{id}` - Hapus category

### Middleware Protection
Semua route admin dilindungi oleh:
- `auth` middleware - User harus login
- `admin` middleware - User harus memiliki role 'admin'

### Access Control
- Hanya user dengan `role = 'admin'` yang bisa akses admin panel
- User biasa tidak bisa akses admin panel meskipun sudah login
- Jika user biasa mencoba login via `/super-admin`, akan auto logout dan tampilkan error

---

## Database Structure

### Users Table
```sql
- id (bigint, primary key)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string)
- role (string, default: 'user') // 'admin' atau 'user'
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### Categories Table
```sql
- id (bigint, primary key)
- name (string)
- slug (string, unique)
- description (text, nullable)
- icon (string, nullable)
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### Properties Table
```sql
- id (bigint, primary key)
- title (string)
- slug (string, unique)
- description (text)
- price (decimal)
- property_type (string) // 'rumah', 'tanah', 'apartemen', dll
- status (string) // 'available', 'sold', 'reserved'
- address (text)
- city (string)
- province (string)
- category_id (bigint, foreign key)
- user_id (bigint, foreign key)
- bedrooms (integer, nullable)
- bathrooms (integer, nullable)
- land_size (decimal, nullable)
- building_size (decimal, nullable)
- is_featured (boolean, default: false)
- is_active (boolean, default: true)
- views (integer, default: 0)
- created_at (timestamp)
- updated_at (timestamp)
```

### Property Images Table
```sql
- id (bigint, primary key)
- property_id (bigint, foreign key)
- image_path (string)
- image_name (string)
- is_primary (boolean, default: false)
- order (integer, default: 0)
- created_at (timestamp)
- updated_at (timestamp)
```

---

## Routes

### Public Routes
```
GET  /                              → Homepage
GET  /properties                    → Property listing
GET  /properties/{slug}             → Property detail
GET  /categories/{slug}             → Category detail
GET  /login                         → Login page
POST /login                         → Process login
POST /logout                        → Logout
```

### Super Admin Routes
```
GET  /super-admin                   → Super admin login page
POST /super-admin                   → Process super admin login
```

### Admin Routes (Protected)
```
GET     /admin/dashboard
GET     /admin/properties
GET     /admin/properties/create
POST    /admin/properties
GET     /admin/properties/{id}/edit
PUT     /admin/properties/{id}
DELETE  /admin/properties/{id}
GET     /admin/properties/{id}/images
POST    /admin/properties/{id}/images
DELETE  /admin/images/{id}
POST    /admin/images/{id}/set-primary
GET     /admin/categories
GET     /admin/categories/create
POST    /admin/categories
GET     /admin/categories/{id}/edit
PUT     /admin/categories/{id}
DELETE  /admin/categories/{id}
```

---

## Troubleshooting

### Error 419 (Page Expired)
**Penyebab**: CSRF token expired atau session expired

**Solusi**:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```
Refresh browser atau buka di tab baru.

### Image tidak muncul
**Penyebab**: Storage link belum dibuat

**Solusi**:
```bash
php artisan storage:link
```

### Admin tidak bisa login
**Penyebab**: User belum memiliki role 'admin'

**Solusi**:
```bash
php artisan tinker
```
Kemudian:
```php
App\Models\User::where('email', 'admin@jagadproperty.com')->update(['role' => 'admin']);
```

### Route tidak ditemukan
**Penyebab**: Route cache belum di-clear

**Solusi**:
```bash
php artisan route:clear
php artisan route:cache
```

### Permission denied pada storage
**Penyebab**: Folder storage tidak memiliki permission write

**Solusi** (Linux/Mac):
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Database error
**Penyebab**: Database belum di-migrate atau konfigurasi salah

**Solusi**:
```bash
php artisan migrate:fresh
php artisan db:seed
```

---

## Fitur UI/UX yang Telah Diimplementasikan

### Homepage
- ✅ Sticky navbar dengan backdrop blur
- ✅ Hero section dengan gradient overlay dan parallax effect
- ✅ Quick search filters (kota, harga, tipe property)
- ✅ Trust badges section
- ✅ Interactive project cards dengan hover effects
- ✅ "Promo DP 0%" ribbons
- ✅ Property highlights (LB, LT, KT, certificate)
- ✅ Lazy-loading images
- ✅ WhatsApp integration buttons
- ✅ Interactive timeline untuk About section
- ✅ Autoplay testimoni carousel
- ✅ Google Maps embedding
- ✅ Contact form dengan dropdown project

### Property Listing
- ✅ Enhanced filter sidebar
- ✅ Property cards dengan hover effects
- ✅ Status badges
- ✅ Detailed property information dengan icons
- ✅ WhatsApp contact buttons

### Admin Panel
- ✅ Modern sidebar navigation
- ✅ Stats cards dengan icons
- ✅ Responsive tables
- ✅ Image upload dengan preview
- ✅ Success/error notifications
- ✅ Form validations

---

## Catatan Penting

1. **Security**
   - Semua route admin dilindungi dengan middleware
   - Hanya user dengan role 'admin' yang bisa akses
   - CSRF protection aktif untuk semua form

2. **File Upload**
   - Maksimal ukuran file: 5MB
   - Format yang didukung: jpeg, png, jpg, gif, webp
   - File disimpan di `storage/app/public/properties/`

3. **WhatsApp Integration**
   - Semua link WhatsApp mengarah ke: `+62 857-8178-0369`
   - Format: `https://wa.me/6285781780369`

4. **Database**
   - Default menggunakan SQLite
   - Bisa diubah ke MySQL/PostgreSQL di file `.env`

5. **Development**
   - Server default: `http://localhost:8002`
   - Hot reload: `npm run dev`
   - Production build: `npm run build`

---

## Changelog

### Version 1.0.0
- ✅ Setup project Laravel
- ✅ Implementasi UI/UX homepage
- ✅ Property listing & detail pages
- ✅ Super admin panel dengan CRUD
- ✅ Image management system
- ✅ Category management
- ✅ WhatsApp integration
- ✅ Google Maps integration
- ✅ Authentication system
- ✅ Admin middleware protection

---

## Support & Contact

Untuk pertanyaan atau bantuan, silakan hubungi:
- **WhatsApp**: +62 857-8178-0369
- **Email**: admin@jagadproperty.com

---

**Dokumentasi ini dibuat untuk memudahkan pengembangan dan maintenance website Jagad Property.**





