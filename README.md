# 📋 Sistem Informasi Absensi Karyawan

Sistem web untuk manajemen absensi karyawan yang modern, responsif, dan mudah digunakan. Dibangun dengan Laravel 12 dan Bootstrap 5.3.2.

## 📸 Fitur Utama

✅ **Manajemen Karyawan** - CRUD lengkap data karyawan
✅ **Manajemen Jabatan** - Kelola posisi/jabatan kerja
✅ **Manajemen User** - Kelola data user sistem
✅ **Sistem Absensi** - Check-in/check-out dan admin panel
✅ **Dashboard Admin** - Statistik dan laporan attendance
✅ **Modern UI** - Desain gradient glassmorphism dengan Bootstrap 5
✅ **Responsive** - Kompatibel desktop, tablet, dan mobile
✅ **Data Export** - Export employee data ke CSV/JSON

## 🏗️ Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| Backend | Laravel 12.x |
| Database | MySQL 5.7+ |
| Frontend | Bootstrap 5.3.2 |
| Icons | Bootstrap Icons 1.11.1 |
| Charts | Chart.js 3.9.1 |
| Build Tool | Vite 7.0.7 |
| Package Manager | Composer & NPM |

## 📋 Persyaratan Sistem

- **PHP** 8.2 atau lebih tinggi
- **MySQL** 5.7 atau lebih tinggi
- **Composer** (untuk manage PHP dependencies)
- **Node.js** & **NPM** (untuk asset compilation)
- **Git** (optional, untuk version control)

## 🚀 Instalasi

### 1. Clone atau Download Project
```bash
cd path/to/project
cd absensiazril
```

### 2. Install Backend Dependencies
```bash
composer install
```

### 3. Install Frontend Dependencies
```bash
npm install
```

### 4. Setup Environment File
```bash
# Copy .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensiazril
DB_USERNAME=root
DB_PASSWORD=
```

Buat database di MySQL:
```sql
CREATE DATABASE absensiazril CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Jalankan Migration & Seeding
```bash
# Fresh migration dengan seeding
php artisan migrate:fresh --seed

# Atau step-by-step
php artisan migrate
php artisan db:seed
```

### 7. (Optional) Compile Assets
```bash
# Development
npm run dev

# Production
npm run build
```

## ▶️ Menjalankan Aplikasi

### Development Server
```bash
php artisan serve
```
Akses: `http://localhost:8000`

### PHP Built-in Server Alternative
```bash
php -S localhost:8000 -t public
```

### Production Setup
Setup Nginx/Apache virtual host ke folder `public/`

## 📖 Panduan Penggunaan

### 🏠 Halaman Beranda
- **URL:** `http://localhost:8000/`
- **Fungsi:** Dashboard utama dengan statistik karyawan
- **Fitur:**
  - Tampilan semua data karyawan
  - 3 Stat cards (Total, Tetap, Kontrak)
  - Chart statistik bulanan
  - Tabel 5 karyawan terakhir

### 👥 Manajemen Karyawan
- **URL:** `http://localhost:8000/employees`
- **Fitur:**
  - ✏️ Tambah karyawan baru
  - 📖 Lihat semua karyawan
  - ✏️ Edit data karyawan
  - 🗑️ Hapus karyawan
  - 📥 Export ke CSV/JSON

**Cara Menambah:**
1. Klik tombol "Tambah Karyawan"
2. Isi form: Nama, Email, Telepon, Posisi
3. Klik "Simpan"

**Cara Edit:**
1. Dari daftar karyawan, klik tombol "Edit"
2. Ubah data yang diperlukan
3. Klik "Update"

**Cara Hapus:**
1. Dari daftar karyawan, klik tombol "Hapus"
2. Konfirmasi penghapusan
3. Data akan dihapus

### 💼 Manajemen Jabatan
- **URL:** `http://localhost:8000/positions`
- **Fitur:**
  - ✏️ Tambah jabatan baru
  - 📖 Lihat semua jabatan
  - ✏️ Edit jabatan
  - 🗑️ Hapus jabatan

### 👤 Manajemen User
- **URL:** `http://localhost:8000/users`
- **Fitur:**
  - ✏️ Tambah user
  - 📖 Lihat semua user
  - ✏️ Edit user
  - 🗑️ Hapus user

### 🕐 Sistem Absensi

#### User Check-In/Check-Out
- **URL:** `http://localhost:8000/attendance/check-in`
- **Fitur:**
  - ✅ Check-in (mencatat waktu datang)
  - ✅ Check-out (mencatat waktu pulang)
  - 📊 Status absensi hari ini
  - ⏰ Tampilan waktu check-in dan check-out

#### Admin Dashboard
- **URL:** `http://localhost:8000/admin/attendance`
- **Fitur:**
  - 📊 Statistik harian (Total, Hadir, Alfa, Izin+Sakit)
  - 📋 Tabel kehadiran dengan filter tanggal
  - 👤 Info karyawan dengan avatar
  - ⏰ Waktu check-in/out

#### Kelola Data Absensi
- **URL:** `http://localhost:8000/admin/attendance/list`
- **Fitur:**
  - 🔍 Filter berdasarkan tanggal, karyawan, status
  - 📖 Daftar lengkap attendance records
  - ✏️ Edit attendance
  - 🗑️ Hapus attendance
  - 📄 Pagination (20 records per halaman)

## 🗂️ Struktur Direktori

```
absensiazril/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── EmployeeController.php      # CRUD Karyawan
│   │       ├── PositionController.php      # CRUD Jabatan
│   │       ├── UserController.php          # CRUD User
│   │       └── AttendanceController.php    # CRUD & Dashboard Absensi
│   ├── Models/
│   │   ├── Employee.php                    # Model Karyawan
│   │   ├── Position.php                    # Model Jabatan
│   │   ├── Attendance.php                  # Model Absensi
│   │   └── User.php
│   └── Providers/
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_11_27_035205_create_employees_table.php
│   │   ├── 2025_11_27_035221_create_attendances_table.php
│   │   ├── 2025_11_27_120000_create_positions_table.php
│   │   └── 2025_11_28_072839_add_position_id_to_employees_table.php
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
│       ├── DatabaseSeeder.php              # Main seeder
│       ├── EmployeeSeeder.php              # 10 sample employees
│       ├── PositionSeeder.php              # 5 sample positions
│       └── AttendanceSeeder.php            # 100 sample attendance records
├── routes/
│   └── web.php                             # Semua URL routes
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php               # Master layout
│   │   ├── attendance/
│   │   │   └── check-in.blade.php          # User check-in page
│   │   ├── admin/
│   │   │   └── attendance/
│   │   │       ├── dashboard.blade.php     # Admin dashboard
│   │   │       ├── index.blade.php         # Admin list attendance
│   │   │       └── edit.blade.php          # Admin edit attendance
│   │   ├── employees/
│   │   │   ├── home.blade.php              # Daftar karyawan
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php            # Form tambah
│   │   │   └── edit.blade.php              # Form edit
│   │   ├── positions/
│   │   ├── users/
│   │   └── welcome.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── bootstrap/
├── config/
├── public/
│   ├── index.php                           # Entry point
│   └── robots.txt
├── storage/
│   ├── logs/                               # Application logs
│   ├── app/
│   │   └── public/
│   └── framework/
├── tests/
├── .env                                    # Environment variables
├── .env.example                            # Template .env
├── artisan                                 # CLI commands
├── composer.json                           # PHP dependencies
├── package.json                            # NPM dependencies
├── vite.config.js                          # Vite build config
├── phpunit.xml                             # Testing config
├── ERD.md                                  # Entity Relationship Diagram
├── UML.md                                  # Class & Architecture Diagram
├── SETUP.md                                # Setup Guide
└── README.md                               # Dokumentasi ini
```

## 🗄️ Database Schema

Lihat [ERD.md](ERD.md) untuk Entity Relationship Diagram lengkap.

### Tabel Users
```sql
id              - BIGINT PRIMARY KEY
name            - VARCHAR(255)
email           - VARCHAR(255) UNIQUE
password        - VARCHAR(255)
created_at      - TIMESTAMP
updated_at      - TIMESTAMP
```

### Tabel Employees
```sql
id              - BIGINT PRIMARY KEY
name            - VARCHAR(255)
email           - VARCHAR(255) UNIQUE
phone           - VARCHAR(20)
position        - VARCHAR(100)
position_id     - BIGINT FOREIGN KEY -> positions.id
created_at      - TIMESTAMP
updated_at      - TIMESTAMP
```

### Tabel Positions
```sql
id              - BIGINT PRIMARY KEY
name            - VARCHAR(255) UNIQUE
description     - TEXT
created_at      - TIMESTAMP
updated_at      - TIMESTAMP
```

### Tabel Attendances
```sql
id              - BIGINT PRIMARY KEY
employee_id     - BIGINT FOREIGN KEY -> employees.id (CASCADE DELETE)
attendance_date - DATE
check_in_time   - TIME (nullable)
check_out_time  - TIME (nullable)
status          - ENUM (hadir, sakit, izin, alfa)
notes           - TEXT (nullable)
created_at      - TIMESTAMP
updated_at      - TIMESTAMP
UNIQUE(employee_id, attendance_date)
```

## 🔌 API Routes

| Method | Route | Controller Action | Deskripsi |
|--------|-------|-------------------|-----------|
| GET | `/` | EmployeeController@home | Halaman beranda |
| GET | `/employees` | EmployeeController@index | Daftar karyawan |
| GET | `/employees/create` | EmployeeController@create | Form tambah |
| POST | `/employees` | EmployeeController@store | Simpan karyawan |
| GET | `/employees/{id}/edit` | EmployeeController@edit | Form edit |
| PUT | `/employees/{id}` | EmployeeController@update | Update karyawan |
| DELETE | `/employees/{id}` | EmployeeController@destroy | Hapus karyawan |
| GET | `/employees/export/csv` | EmployeeController@exportCsv | Export CSV |
| GET | `/employees/export/json` | EmployeeController@exportJson | Export JSON |
| GET | `/positions` | PositionController@index | Daftar jabatan |
| POST | `/positions` | PositionController@store | Simpan jabatan |
| GET | `/positions/{id}/edit` | PositionController@edit | Form edit jabatan |
| PUT | `/positions/{id}` | PositionController@update | Update jabatan |
| DELETE | `/positions/{id}` | PositionController@destroy | Hapus jabatan |
| GET | `/users` | UserController@index | Daftar user |
| POST | `/users` | UserController@store | Simpan user |
| GET | `/users/{id}/edit` | UserController@edit | Form edit user |
| PUT | `/users/{id}` | UserController@update | Update user |
| DELETE | `/users/{id}` | UserController@destroy | Hapus user |
| GET | `/attendance/check-in` | AttendanceController@checkIn | Halaman check-in |
| POST | `/attendance/check-in` | AttendanceController@doCheckIn | Proses check-in |
| POST | `/attendance/check-out` | AttendanceController@doCheckOut | Proses check-out |
| GET | `/admin/attendance` | AttendanceController@adminDashboard | Dashboard admin |
| GET | `/admin/attendance/list` | AttendanceController@adminIndex | Daftar attendance |
| GET | `/admin/attendance/{id}/edit` | AttendanceController@adminEdit | Form edit |
| PUT | `/admin/attendance/{id}` | AttendanceController@adminUpdate | Update attendance |
| DELETE | `/admin/attendance/{id}` | AttendanceController@adminDestroy | Hapus attendance |

## ⚙️ Artisan Commands

```bash
# Server & Serve
php artisan serve                           # Start development server

# Database & Migrations
php artisan migrate                         # Run migrations
php artisan migrate:rollback                # Rollback last migration
php artisan migrate:refresh                 # Refresh (reset + migrate)
php artisan migrate:fresh                   # Drop all + migrate
php artisan migrate:fresh --seed            # Drop all + migrate + seed

# Seeding
php artisan db:seed                         # Run all seeders
php artisan db:seed --class=EmployeeSeeder  # Run specific seeder

# Generate
php artisan make:model ModelName            # Create model
php artisan make:controller ControllerName  # Create controller
php artisan make:migration migration_name   # Create migration
php artisan make:seeder SeederName          # Create seeder

# Cache & Optimization
php artisan cache:clear                     # Clear application cache
php artisan config:cache                    # Cache config
php artisan route:list                      # Show all routes
php artisan tinker                          # Interactive shell

# Assets
npm run dev                                 # Development asset compilation
npm run build                               # Production asset compilation
```

## 🎨 Design System

### Color Palette
- **Primary Gradient:** `#667eea` → `#764ba2` (Purple-Blue)
- **Secondary Gradients:**
  - Green: `#11998e` → `#38ef7d`
  - Pink: `#f093fb` → `#f5576c`
  - Yellow: `#fa709a` → `#fee140`

### Typography
- **Font Family:** 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
- **Headings:** Bold, 1.8rem
- **Body:** Regular, 1rem

### Components
- **Border Radius:** 8px (buttons/forms), 15px (cards)
- **Box Shadow:** 0 2px 8px (light) to 0 20px 60px (heavy)
- **Animations:** Slide-in alerts, hover translateY effects

## 📊 Architecture & Documentation

- 📋 **[ERD.md](ERD.md)** - Entity Relationship Diagram untuk database schema
- 🎯 **[UML.md](UML.md)** - Class Diagram dan Application Architecture

Sistem menggunakan **MVC (Model-View-Controller) Pattern**:
- **Models:** Eloquent ORM untuk database interaction
- **Controllers:** Business logic dan request handling
- **Views:** Blade templating engine untuk rendering

## 🧪 Testing

```bash
# Run PHPUnit tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test
php artisan test tests/Feature/EmployeeControllerTest.php
```

## 🚨 Troubleshooting

### Database Connection Error
```
Solution:
1. Pastikan MySQL sudah running
2. Check file `.env` configuration
3. Jalankan: php artisan config:cache
4. Jalankan: php artisan migrate:fresh --seed
```

### Class Not Found
```
Solution:
1. Jalankan: composer dump-autoload
2. Jalankan: php artisan cache:clear
3. Restart PHP server
```

### Assets Not Loading
```
Solution:
1. Jalankan: npm run dev (development) atau npm run build (production)
2. Hard refresh browser: Ctrl+Shift+R
3. Clear browser cache
```

### Permission Denied
```
Solution (Linux/Mac):
chmod -R 775 storage bootstrap/cache
chmod -R 775 database

Solution (Windows):
Right-click folder → Properties → Security → Edit permissions
```

### Migration Error
```
Solution:
1. Jalankan: php artisan migrate:reset
2. Jalankan: php artisan migrate:fresh --seed
3. Jika still error, check log: tail -f storage/logs/laravel.log
```

## 📚 Learning Resources

- [Laravel Official Docs](https://laravel.com/docs/12.x)
- [Laravel Eloquent ORM](https://laravel.com/docs/12.x/eloquent)
- [Laravel Migrations](https://laravel.com/docs/12.x/migrations)
- [Blade Template Engine](https://laravel.com/docs/12.x/blade)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)
- [Chart.js Documentation](https://www.chartjs.org/)

## 🐛 Bug Reports & Contributions

Jika menemukan bug atau ingin berkontribusi:
1. Create issue di repository
2. Describe bug/feature dengan detail
3. Submit pull request dengan perubahan

## 📝 Changelog

### Version 1.0 - November 28, 2025
- ✅ Manajemen Karyawan (CRUD)
- ✅ Manajemen Jabatan (CRUD)
- ✅ Manajemen User (CRUD)
- ✅ Sistem Absensi User (Check-in/Check-out)
- ✅ Admin Dashboard Absensi
- ✅ Admin Management Absensi (CRUD)
- ✅ Modern UI dengan Gradient & Glassmorphism
- ✅ Responsive Design
- ✅ Export Data (CSV/JSON)
- ✅ Dashboard dengan Statistics

## 📞 Support & Contact

Untuk pertanyaan atau dukungan:
- 📧 Email: azril27@example.com
- 💼 LinkedIn: [Azril Profile]
- 🐙 GitHub: [azril27](https://github.com/azril27)

## 📄 License

MIT License - Silakan gunakan dan modify sesuai kebutuhan.

## ✨ Credits

Built with ❤️ using:
- **Laravel 12** - Web Framework
- **Bootstrap 5** - CSS Framework
- **Chart.js** - Data Visualization
- **MySQL** - Database
- **Vite** - Build Tool

---

**Version:** 1.0.0  
**Last Updated:** November 28, 2025  
**Status:** Production Ready  
**Author:** Azril Programmer

**Dokumentasi Lengkap:**
- 📋 [Entity Relationship Diagram](ERD.md)
- 🎯 [Class & Architecture Diagram](UML.md)
- 🔧 [Setup & Installation Guide](SETUP.md)
