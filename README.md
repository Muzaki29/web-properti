# Jagad Property Website

Website untuk menampilkan katalog property (rumah, tanah, apartemen, dll) dengan sistem admin panel untuk mengelola konten.

## 🚀 Quick Start

### Prerequisites
- PHP >= 8.3
- Composer
- Node.js & NPM
- SQLite atau MySQL

### Installation

1. **Clone repository**
```bash
git clone <repository-url>
cd web-jagadproperty
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Setup database**
```bash
# Jika menggunakan SQLite
touch database/database.sqlite

# Run migrations
php artisan migrate

# Run seeders (optional)
php artisan db:seed
```

5. **Setup storage**
```bash
php artisan storage:link
```

6. **Build assets**
```bash
npm run build
```

7. **Run server**
```bash
php artisan serve --port=8002
```

Akses website di: `http://localhost:8002`

## 🔐 Super Admin Access

**URL**: `http://localhost:8002/super-admin`

**Default Credentials**:
- Email: `admin@jagadproperty.com`
- Password: `password`

## 📁 Struktur Proyek

```
web-jagadproperty/
├── app/Http/Controllers/     # Controllers
├── app/Http/Middleware/       # Middleware
├── app/Models/                # Eloquent Models
├── database/migrations/        # Database migrations
├── database/seeders/          # Database seeders
├── resources/views/           # Blade templates
│   ├── admin/                 # Admin panel views
│   ├── auth/                  # Authentication views
│   └── properties/            # Property views
└── routes/web.php             # Application routes
```

## 🎯 Fitur Utama

### Website Public
- ✅ Homepage dengan hero section
- ✅ Property listing dengan filter
- ✅ Property detail dengan galeri foto
- ✅ WhatsApp integration
- ✅ Google Maps integration

### Super Admin Panel
- ✅ Dashboard dengan statistik
- ✅ CRUD Properties
- ✅ CRUD Categories
- ✅ Upload & manage property images
- ✅ Set primary image

## 📚 Dokumentasi Lengkap

Lihat [DOCUMENTATION.md](DOCUMENTATION.md) untuk dokumentasi lengkap.

## 🛠️ Tech Stack

- **Backend**: Laravel 12.41.1
- **Frontend**: Tailwind CSS
- **Database**: SQLite (default) / MySQL
- **Asset Bundler**: Vite

## 📝 License

Proprietary - Jagad Property

---

**Dikembangkan untuk Jagad Property** 🏠
