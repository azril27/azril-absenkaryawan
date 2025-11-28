# 📝 Dokumentasi Fitur Jabatan (Position)

## ✅ Fitur yang Baru Ditambahkan

### 1. **Manajemen Jabatan (Position Management)**
- **Halaman Daftar Jabatan** (`/positions`)
  - Menampilkan semua jabatan yang tersedia
  - Kolom: #, Nama Jabatan, Deskripsi, Aksi
  - Tombol Tambah Jabatan, Edit, dan Hapus

- **Tambah Jabatan Baru** (`/positions/create`)
  - Form input untuk nama jabatan (unique)
  - Field deskripsi (opsional)
  - Validasi input
  - Notifikasi success

- **Edit Jabatan** (`/positions/{id}/edit`)
  - Form pre-filled dengan data jabatan
  - Validasi unique name (exclude current record)
  - Tombol Update dan Batal

- **Hapus Jabatan** (`/positions/{id}`)
  - Konfirmasi sebelum delete
  - Cascade delete (employee yang menggunakan jabatan tidak terhapus, hanya position_id jadi null)

### 2. **Database Schema**

#### Tabel: positions
```sql
id              - INTEGER (PK, Auto Increment)
name            - VARCHAR(255) UNIQUE
description     - TEXT (nullable)
created_at      - TIMESTAMP
updated_at      - TIMESTAMP
```

#### Update pada Tabel: employees
```sql
position_id     - INTEGER (FK ke positions.id, nullable)
position        - VARCHAR(100) (tetap ada untuk backward compatibility)
```

### 3. **Model & Relationship**

**Position Model:**
```php
- Fillable: name, description
- Relationship: hasMany(Employee)
```

**Employee Model:**
```php
- Fillable tambahan: position_id
- Relationship: belongsTo(Position) as positionRelation()
```

### 4. **Controller & Routes**

**PositionController:**
- `index()` - Tampilkan semua jabatan
- `create()` - Form tambah jabatan
- `store()` - Simpan jabatan baru
- `edit()` - Form edit jabatan
- `update()` - Update jabatan
- `destroy()` - Hapus jabatan

**Routes:**
```php
GET/HEAD    /positions              - positions.index
POST        /positions              - positions.store
GET/HEAD    /positions/create       - positions.create
PUT/PATCH   /positions/{id}         - positions.update
DELETE      /positions/{id}         - positions.destroy
GET/HEAD    /positions/{id}/edit    - positions.edit
```

### 5. **Data Seeding**

8 jabatan default yang di-seed:
1. Manager
2. Senior Developer
3. Junior Developer
4. UI/UX Designer
5. QA Engineer
6. HR Staff
7. System Administrator
8. Business Analyst

Setiap jabatan memiliki deskripsi yang menjelaskan tanggung jawab.

### 6. **Navigation & UI**

- Menu "Jabatan" ditambahkan di navbar
- Konsisten dengan Bootstrap 5 styling
- Icons dari Bootstrap Icons (`bi-briefcase`)
- Color scheme: Primary Blue untuk header

### 7. **Validasi**

**Saat Tambah Jabatan:**
- `name` required, string, unique di tabel positions
- `description` nullable, string

**Saat Edit Jabatan:**
- `name` required, string, unique (exclude current record)
- `description` nullable, string

## 🔧 Perintah Artisan

```bash
# Buat model Position
php artisan make:model Position

# Buat controller PositionController
php artisan make:controller PositionController

# Buat seeder PositionSeeder
php artisan make:seeder PositionSeeder

# Jalankan migration terbaru
php artisan migrate

# Jalankan refresh dengan seed
php artisan migrate:refresh --seed
```

## 📁 File yang Dibuat/Dimodifikasi

```
app/
  Models/
    Position.php (NEW)
  Http/
    Controllers/
      PositionController.php (NEW)

database/
  migrations/
    2025_11_27_120000_create_positions_table.php (MODIFIED)
  seeders/
    PositionSeeder.php (NEW)
    DatabaseSeeder.php (MODIFIED)
    EmployeeSeeder.php (MODIFIED)

resources/
  views/
    positions/
      index.blade.php (NEW)
      create.blade.php (NEW)
      edit.blade.php (NEW)
    layouts/
      app.blade.php (MODIFIED - tambah menu Jabatan)

routes/
  web.php (MODIFIED - tambah route positions)
```

## 🚀 Cara Menggunakan

### 1. Menambah Jabatan Baru
1. Klik menu "Jabatan" di navbar
2. Klik tombol "Tambah Jabatan"
3. Isi form:
   - **Nama Jabatan** (required, unique)
   - **Deskripsi** (opsional)
4. Klik "Simpan"
5. Otomatis redirect dengan pesan success

### 2. Melihat Daftar Jabatan
1. Klik menu "Jabatan" di navbar
2. Lihat semua jabatan dalam tabel
3. Klik Edit untuk mengubah atau Hapus untuk menghapus

### 3. Mengedit Jabatan
1. Dari daftar jabatan, klik tombol "Edit"
2. Ubah data yang diperlukan
3. Klik "Update"

### 4. Menghapus Jabatan
1. Dari daftar jabatan, klik tombol "Hapus"
2. Konfirmasi penghapusan
3. Data jabatan akan dihapus (employee tetap ada)

## 🔗 Integrasi dengan Employee

Pada saat mendatang, fitur Employee dapat diupdate untuk:
1. Menggunakan dropdown Position saat tambah/edit karyawan
2. Menampilkan position name dari relasi (bukan string position)
3. Cascade update/delete positions

**SQL Query untuk mengecek:**
```sql
-- Lihat employee dengan position relation
SELECT e.*, p.name as position_name 
FROM employees e 
LEFT JOIN positions p ON e.position_id = p.id;
```

## ✅ Testing Checklist

- [x] Membuat tabel positions
- [x] Membuat model Position dengan relationship
- [x] Membuat PositionController dengan CRUD
- [x] Membuat views (index, create, edit)
- [x] Menambahkan routes
- [x] Menambahkan menu di navbar
- [x] Membuat PositionSeeder dengan 8 data
- [x] Update Employee model dan seeder
- [x] Migration refresh berhasil
- [x] Routes terdaftar dengan baik
- [x] Validasi form berfungsi

## 📊 Data Sample

Seeder menyediakan 8 jabatan:
- **Manager** - Mengelola dan mengawasi tim karyawan
- **Senior Developer** - Mengembangkan dan memelihara aplikasi software
- **Junior Developer** - Membantu pengembangan software di bawah bimbingan senior
- **UI/UX Designer** - Mendesain interface dan pengalaman pengguna aplikasi
- **QA Engineer** - Melakukan testing dan quality assurance pada aplikasi
- **HR Staff** - Menangani administrasi dan pengembangan SDM
- **System Administrator** - Mengelola infrastruktur dan sistem jaringan
- **Business Analyst** - Menganalisis kebutuhan bisnis dan solusi teknis

## 🎯 Rencana Pengembangan

- [ ] Update Employee form dengan dropdown position
- [ ] Search & filter positions
- [ ] Export positions to PDF/Excel
- [ ] Pagination untuk daftar positions
- [ ] Soft delete untuk positions
- [ ] Audit log untuk perubahan jabatan

---

**Created:** 27 November 2025
**Status:** ✅ Complete
