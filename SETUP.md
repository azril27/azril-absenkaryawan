# 🎯 Setup & Panduan Menggunakan Sistem Absensi Karyawan

## 📦 Persyaratan Sistem

- PHP 8.1 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer
- Node.js & NPM (untuk asset compilation)

## 🔧 Instalasi Awal

### 1. Clone atau Buka Project
```bash
cd c:\Users\RPL-002\absensiazril
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
# Copy .env.example ke .env (jika belum ada)
cp .env.example .env

# Generate APP_KEY
php artisan key:generate
```

### 4. Konfigurasi Database

Buka file `.env` dan sesuaikan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensiazril
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `absensiazril` sudah dibuat di MySQL:
```sql
CREATE DATABASE absensiazril;
```

### 5. Jalankan Migration & Seeder
```bash
# Buat tabel di database
php artisan migrate

# Isi dengan data sample
php artisan db:seed
```

### 6. Build Assets (Optional)
```bash
# Development
npm run dev

# Production
npm run build
```

## 🚀 Menjalankan Aplikasi

### Opsi 1: Development Server
```bash
php artisan serve
```
Akses: `http://localhost:8000`

### Opsi 2: PHP Built-in Server
```bash
php -S localhost:8000 -t public
```

### Opsi 3: Nginx/Apache
Setup virtual host ke folder `public/`

## 📖 Panduan Penggunaan

### 🏠 Halaman Beranda
1. Akses: `http://localhost:8000/`
2. Tampilan: Daftar semua karyawan + statistik
3. Fitur:
   - Lihat semua data karyawan
   - Tombol "Tambah Karyawan" di atas
   - Klik Edit atau Hapus di kolom Aksi

### ➕ Menambah Karyawan Baru
1. Klik tombol "Tambah Karyawan"
2. Isi form:
   - **Nama**: Nama lengkap karyawan
   - **Email**: Email unik (harus berbeda dengan yang lain)
   - **Telepon**: Nomor telepon
   - **Posisi**: Jabatan/posisi kerja
3. Klik "Simpan"
4. Otomatis redirect ke daftar karyawan dengan pesan sukses

### ✏️ Mengedit Data Karyawan
1. Dari halaman beranda/daftar, klik tombol "Edit"
2. Ubah data yang diperlukan
3. Klik "Update"
4. Data akan disimpan dan redirect ke daftar

### 🗑️ Menghapus Karyawan
1. Dari halaman beranda/daftar, klik tombol "Hapus"
2. Akan muncul konfirmasi "Yakin ingin menghapus?"
3. Klik "OK" untuk menghapus atau "Cancel" untuk batal
4. Data akan dihapus dan redirect ke daftar

## 🗂️ Struktur Project

```
absensiazril/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── EmployeeController.php     # Logic CRUD
│   └── Models/
│       ├── Employee.php                   # Model Karyawan
│       ├── User.php
│       └── Attendance.php                 # Model Absensi (future)
├── database/
│   ├── migrations/
│   │   ├── ...create_employees_table.php
│   │   └── ...create_attendances_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── EmployeeSeeder.php              # 6 sample data
├── routes/
│   └── web.php                             # URL routing
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               # Layout utama
│       └── employees/
│           ├── home.blade.php              # Halaman beranda
│           ├── index.blade.php             # Daftar karyawan
│           ├── create.blade.php            # Form tambah
│           └── edit.blade.php              # Form edit
├── .env                                    # Environment config
├── artisan                                 # CLI commands
└── composer.json                           # Dependencies

```

## 🔌 API Endpoints

Sistem menggunakan Resource Controller, berikut endpoints yang tersedia:

| Method | Route | Action | Keterangan |
|--------|-------|--------|-----------|
| GET | `/` | home | Halaman beranda |
| GET | `/employees` | index | Daftar semua karyawan |
| GET | `/employees/create` | create | Form tambah karyawan |
| POST | `/employees` | store | Simpan data karyawan |
| GET | `/employees/{id}/edit` | edit | Form edit karyawan |
| PUT/PATCH | `/employees/{id}` | update | Update data karyawan |
| DELETE | `/employees/{id}` | destroy | Hapus karyawan |

## 🛠️ Database Schema

### Tabel: employees
```sql
id              - INTEGER (Primary Key, Auto Increment)
name            - VARCHAR(255)
email           - VARCHAR(255) UNIQUE
phone           - VARCHAR(20)
position        - VARCHAR(100)
created_at      - TIMESTAMP
updated_at      - TIMESTAMP
```

## ⚙️ Artisan Commands Penting

```bash
# Jalankan server
php artisan serve

# Buat migration baru
php artisan make:migration create_nama_table

# Buat model baru
php artisan make:model NamaModel

# Buat controller baru
php artisan make:controller NamaController

# Jalankan migration
php artisan migrate

# Rollback migration
php artisan migrate:rollback

# Jalankan seeder
php artisan db:seed

# Jalankan seeder tertentu
php artisan db:seed --class=EmployeeSeeder

# Refresh database (reset semua + migrate + seed)
php artisan migrate:refresh --seed

# Clear cache
php artisan cache:clear

# Lihat semua route
php artisan route:list
```

## 🎨 Styling & Assets

### Bootstrap 5
- CDN dari jsdelivr.net
- Tersedia di layout `app.blade.php`

### Bootstrap Icons
- Icon library untuk UI
- CDN dari jsdelivr.net

### Custom CSS
- Minimal styling di `app.blade.php`
- Warna: Primary Blue (#0D6EFD)
- Font: Segoe UI

## 🐛 Troubleshooting

### Error: "Database connection refused"
1. Pastikan MySQL running
2. Cek konfigurasi `.env`
3. Jalankan: `php artisan config:cache`

### Error: "No such file or directory"
1. Jalankan: `composer install`
2. Pastikan folder `storage/logs` writable
3. Jalankan: `chmod -R 775 storage bootstrap/cache`

### Error: "Class not found"
1. Jalankan: `composer dump-autoload`
2. Jalankan: `php artisan cache:clear`

### Assets tidak loading
1. Jalankan: `npm run dev`
2. Hard refresh browser (Ctrl+Shift+R)

## 📝 Sample Curl Commands

```bash
# Get semua karyawan
curl -X GET http://localhost:8000/employees

# Tambah karyawan
curl -X POST http://localhost:8000/employees \
  -d "name=John Doe" \
  -d "email=john@example.com" \
  -d "phone=081234567890" \
  -d "position=Developer"

# Edit karyawan
curl -X PUT http://localhost:8000/employees/1 \
  -d "name=Jane Doe" \
  -d "email=jane@example.com"

# Hapus karyawan
curl -X DELETE http://localhost:8000/employees/1
```

## 📚 Referensi Berguna

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.0/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)

## 💡 Tips & Tricks

1. **Debugging**: Gunakan `dd($variable)` untuk debug
2. **Database**: Gunakan `php artisan tinker` untuk query testing
3. **Logs**: Check `storage/logs/laravel.log` untuk error logs
4. **Performance**: Gunakan `php artisan optimize` untuk production

---

**Versi:** 1.0
**Last Updated:** 27 November 2025
**Status:** Ready for Development
