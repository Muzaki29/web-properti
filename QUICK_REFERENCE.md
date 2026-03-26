# Quick Reference Guide - Jagad Property

## 🔗 URL Penting

| URL | Deskripsi |
|-----|-----------|
| `http://localhost:8002/` | Homepage website |
| `http://localhost:8002/properties` | Daftar semua property |
| `http://localhost:8002/super-admin` | Login super admin |
| `http://localhost:8002/admin/dashboard` | Dashboard admin (setelah login) |

## 🔑 Credentials Default

**Super Admin:**
- Email: `admin@jagadproperty.com`
- Password: `password`

## 📋 Commands Penting

### Development
```bash
# Run server
php artisan serve --port=8002

# Build assets (production)
npm run build

# Build assets (development dengan hot reload)
npm run dev

# Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### Database
```bash
# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Fresh migration + seed
php artisan migrate:fresh --seed

# Create migration
php artisan make:migration create_table_name
```

### Storage
```bash
# Create storage link
php artisan storage:link
```

## 🗂️ File Penting

### Controllers
- `app/Http/Controllers/AdminController.php` - Admin panel logic
- `app/Http/Controllers/AuthController.php` - Authentication logic
- `app/Http/Controllers/PropertyController.php` - Property logic
- `app/Http/Controllers/CategoryController.php` - Category logic
- `app/Http/Controllers/HomeController.php` - Homepage logic

### Middleware
- `app/Http/Middleware/AdminMiddleware.php` - Protect admin routes

### Models
- `app/Models/Property.php` - Property model
- `app/Models/Category.php` - Category model
- `app/Models/PropertyImage.php` - Property image model
- `app/Models/User.php` - User model

### Routes
- `routes/web.php` - Semua routes aplikasi

## 🎨 Views Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php          # Layout website public
│   └── admin.blade.php         # Layout admin panel
├── home.blade.php              # Homepage
├── properties/
│   ├── index.blade.php         # Property listing
│   └── show.blade.php          # Property detail
├── admin/
│   ├── dashboard.blade.php     # Admin dashboard
│   ├── properties/             # Admin property views
│   └── categories/             # Admin category views
└── auth/
    ├── login.blade.php         # Login page
    └── super-admin-login.blade.php  # Super admin login
```

## 🔧 Konfigurasi

### .env Settings
```env
APP_NAME="Jagad Property"
APP_URL=http://localhost:8002

DB_CONNECTION=sqlite
# atau
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=jagad_property
DB_USERNAME=root
DB_PASSWORD=
```

### WhatsApp Number
Semua link WhatsApp: `+62 857-8178-0369`

## 🐛 Troubleshooting Quick Fix

| Masalah | Solusi |
|---------|--------|
| Error 419 | `php artisan config:clear && php artisan view:clear` |
| Image tidak muncul | `php artisan storage:link` |
| Route tidak ditemukan | `php artisan route:clear` |
| Admin tidak bisa login | Update role di database: `UPDATE users SET role='admin' WHERE email='admin@jagadproperty.com'` |
| Permission denied | `chmod -R 775 storage bootstrap/cache` |

## 📊 Database Tables

| Table | Deskripsi |
|-------|-----------|
| `users` | User accounts (admin/user) |
| `categories` | Property categories |
| `properties` | Property listings |
| `property_images` | Property images |

## 🔐 Role System

- **admin**: Akses penuh ke admin panel
- **user**: Akses terbatas (default)

## 📱 WhatsApp Integration

Format link: `https://wa.me/6285781780369`

Contoh penggunaan:
```html
<a href="https://wa.me/6285781780369" target="_blank">
    Hubungi WA
</a>
```

## 🖼️ Image Upload

- **Location**: `storage/app/public/properties/`
- **Public URL**: `public/storage/properties/`
- **Max Size**: 5MB
- **Formats**: jpeg, png, jpg, gif, webp

## 🎯 Admin Routes (Protected)

Semua route admin memerlukan:
1. User harus login (`auth` middleware)
2. User harus memiliki role 'admin' (`admin` middleware)

## 📝 Notes

- Website public hanya untuk melihat katalog
- Tidak ada link ke admin panel di website public
- Super admin akses via URL langsung: `/super-admin`
- Semua gambar property disimpan di storage
- Primary image otomatis ditampilkan di listing

---

**Untuk dokumentasi lengkap, lihat [DOCUMENTATION.md](DOCUMENTATION.md)**





