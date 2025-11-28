# 📊 Entity Relationship Diagram (ERD)

## Database Schema Overview

Sistem Absensi Karyawan menggunakan 4 tabel utama dengan relationships yang terdefinisi dengan baik.

## ER Diagram

```
┌──────────────────────────────┐
│          USERS               │
├──────────────────────────────┤
│ PK  id (BIGINT)              │
│     name (VARCHAR)           │
│ UQ  email (VARCHAR)          │
│     password (VARCHAR)       │
│     created_at (TIMESTAMP)   │
│     updated_at (TIMESTAMP)   │
└──────────────────────────────┘
         │
         │ (1:N)
         │ User has many Employees
         │
         ▼

┌──────────────────────────────┐        ┌──────────────────────────────┐
│       POSITIONS              │        │      EMPLOYEES               │
├──────────────────────────────┤        ├──────────────────────────────┤
│ PK  id (BIGINT)              │◄───────│ FK  position_id (BIGINT)     │
│ UQ  name (VARCHAR)           │ 1:N    │                              │
│     description (TEXT)       │        │ PK  id (BIGINT)              │
│     created_at (TIMESTAMP)   │        │     name (VARCHAR)           │
│     updated_at (TIMESTAMP)   │        │ UQ  email (VARCHAR)          │
└──────────────────────────────┘        │     phone (VARCHAR)          │
                                        │     position (VARCHAR)       │
                                        │     created_at (TIMESTAMP)   │
                                        │     updated_at (TIMESTAMP)   │
                                        └──────────────────────────────┘
                                                   │
                                                   │ (1:N)
                                                   │ Employee has many Attendances
                                                   │
                                                   ▼
                                        ┌──────────────────────────────┐
                                        │     ATTENDANCES              │
                                        ├──────────────────────────────┤
                                        │ PK  id (BIGINT)              │
                                        │ FK  employee_id (BIGINT)     │
                                        │     attendance_date (DATE)   │
                                        │     check_in_time (TIME)     │
                                        │     check_out_time (TIME)    │
                                        │     status (ENUM)            │
                                        │     notes (TEXT)             │
                                        │ UQ  (employee_id,            │
                                        │     attendance_date)         │
                                        │     created_at (TIMESTAMP)   │
                                        │     updated_at (TIMESTAMP)   │
                                        └──────────────────────────────┘
```

## Tabel Detailed Schema

### 1. USERS TABLE

**Tujuan:** Menyimpan data pengguna sistem

| Column | Type | Constraint | Deskripsi |
|--------|------|-----------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | VARCHAR(255) | NOT NULL | Nama user |
| email | VARCHAR(255) | UNIQUE, NOT NULL | Email unik untuk login |
| password | VARCHAR(255) | NOT NULL | Password terenkripsi |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Tanggal pembuatan |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Tanggal update |

**Relationships:**
- One-to-Many dengan EMPLOYEES (implicit)

**Sample Data:**
```sql
INSERT INTO users (name, email, password) VALUES 
('Admin User', 'admin@example.com', '$2y$12$...'),
('Test User', 'test@example.com', '$2y$12$...');
```

---

### 2. POSITIONS TABLE

**Tujuan:** Menyimpan data jabatan/posisi kerja karyawan

| Column | Type | Constraint | Deskripsi |
|--------|------|-----------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | VARCHAR(255) | UNIQUE, NOT NULL | Nama jabatan |
| description | TEXT | NULLABLE | Deskripsi jabatan |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Tanggal pembuatan |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Tanggal update |

**Relationships:**
- One-to-Many dengan EMPLOYEES

**Sample Data:**
```sql
INSERT INTO positions (name, description) VALUES 
('Manager', 'Manajer departemen'),
('Developer', 'Programmer PHP/Laravel'),
('Designer', 'UI/UX Designer'),
('Admin', 'Administrative staff'),
('Director', 'Direktur perusahaan');
```

---

### 3. EMPLOYEES TABLE

**Tujuan:** Menyimpan data karyawan perusahaan

| Column | Type | Constraint | Deskripsi |
|--------|------|-----------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | VARCHAR(255) | NOT NULL | Nama lengkap karyawan |
| email | VARCHAR(255) | UNIQUE, NOT NULL | Email karyawan (unik) |
| phone | VARCHAR(20) | NOT NULL | Nomor telepon |
| position | VARCHAR(100) | NOT NULL | Jabatan (legacy field) |
| position_id | BIGINT | FOREIGN KEY, NULLABLE | FK ke positions.id |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Tanggal pembuatan |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Tanggal update |

**Relationships:**
- Many-to-One dengan POSITIONS
- One-to-Many dengan ATTENDANCES

**Foreign Keys:**
```sql
ALTER TABLE employees ADD CONSTRAINT employees_position_id_foreign
  FOREIGN KEY (position_id) REFERENCES positions(id) ON DELETE SET NULL;
```

**Sample Data:**
```sql
INSERT INTO employees (name, email, phone, position, position_id) VALUES 
('John Doe', 'john@company.com', '081234567890', 'Developer', 2),
('Jane Smith', 'jane@company.com', '082345678901', 'Designer', 3),
('Bob Manager', 'bob@company.com', '083456789012', 'Manager', 1);
```

---

### 4. ATTENDANCES TABLE

**Tujuan:** Menyimpan data absensi/kehadiran karyawan

| Column | Type | Constraint | Deskripsi |
|--------|------|-----------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| employee_id | BIGINT | FOREIGN KEY, NOT NULL | FK ke employees.id |
| attendance_date | DATE | NOT NULL | Tanggal absensi |
| check_in_time | TIME | NULLABLE | Waktu masuk (HH:MM:SS) |
| check_out_time | TIME | NULLABLE | Waktu pulang (HH:MM:SS) |
| status | ENUM | NOT NULL | Status: hadir, sakit, izin, alfa |
| notes | TEXT | NULLABLE | Catatan/keterangan |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Tanggal pembuatan |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Tanggal update |

**Constraints:**
```sql
UNIQUE KEY unique_attendance (employee_id, attendance_date),
FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
```

**ENUM Values:**
- `hadir` - Karyawan hadir dengan check-in/out
- `sakit` - Karyawan sakit (tidak ada check-in/out)
- `izin` - Karyawan izin (tidak ada check-in/out)
- `alfa` - Karyawan tidak masuk tanpa keterangan

**Sample Data:**
```sql
INSERT INTO attendances (employee_id, attendance_date, check_in_time, check_out_time, status, notes) VALUES 
(1, '2025-11-28', '08:15:00', '17:30:00', 'hadir', NULL),
(2, '2025-11-28', NULL, NULL, 'sakit', 'Sakit'),
(3, '2025-11-28', '08:00:00', '17:00:00', 'hadir', NULL);
```

## Relationship Types

### 1. POSITIONS ↔ EMPLOYEES (One-to-Many)
```
1 Position dapat memiliki banyak Employees
- Position.id (1) → Employees.position_id (N)
- Contoh: 1 Manager dapat mengawasi banyak Developer
```

### 2. EMPLOYEES ↔ ATTENDANCES (One-to-Many)
```
1 Employee dapat memiliki banyak Attendance records
- Employee.id (1) → Attendance.employee_id (N)
- Contoh: 1 Karyawan memiliki history absensi 30 hari
```

## Constraints & Rules

### Foreign Key Constraints
```sql
-- EMPLOYEES.position_id → POSITIONS.id
ON DELETE SET NULL         -- Jika position dihapus, position_id jadi NULL
ON UPDATE CASCADE          -- Jika position id berubah, employees.position_id ikut berubah

-- ATTENDANCES.employee_id → EMPLOYEES.id
ON DELETE CASCADE          -- Jika employee dihapus, attendance records dihapus juga
ON UPDATE CASCADE          -- Jika employee id berubah, attendance ikut berubah
```

### Unique Constraints
```sql
-- users.email UNIQUE
-- Setiap user harus punya email unik

-- positions.name UNIQUE
-- Setiap posisi harus punya nama unik

-- employees.email UNIQUE
-- Setiap karyawan harus punya email unik

-- attendances (employee_id, attendance_date) UNIQUE
-- 1 karyawan hanya bisa punya 1 record per hari
```

## Data Flow

### Proses Check-In
```
User → attendance/check-in (GET)
       ↓
     AttendanceController@checkIn
       ↓
     Create attendance record or update existing
       ↓
     INSERT INTO attendances (employee_id, attendance_date, check_in_time, status)
       ↓
     Show check-in page dengan status "Sudah Check-In"
```

### Proses Check-Out
```
User → attendance/check-out (POST)
       ↓
     AttendanceController@doCheckOut
       ↓
     Find existing attendance record untuk hari ini
       ↓
     UPDATE attendances SET check_out_time = NOW() WHERE id = ?
       ↓
     Show confirmation dengan "Check-Out Berhasil"
```

### Proses Admin View Attendance
```
Admin → /admin/attendance (GET)
        ↓
      AttendanceController@adminDashboard
        ↓
      SELECT * FROM attendances 
      WHERE DATE(attendance_date) = CURDATE()
      LEFT JOIN employees ON attendances.employee_id = employees.id
        ↓
      Calculate statistics:
      - Total Employees
      - Count(hadir)
      - Count(alfa)
      - Count(sakit + izin)
        ↓
      Render dashboard dengan stat cards dan table
```

## Indexing Strategy

### Recommended Indexes
```sql
-- Untuk query filtering
CREATE INDEX idx_attendance_date ON attendances(attendance_date);
CREATE INDEX idx_attendance_employee ON attendances(employee_id);
CREATE INDEX idx_attendance_status ON attendances(status);
CREATE INDEX idx_employee_position ON employees(position_id);
CREATE INDEX idx_attendance_emp_date ON attendances(employee_id, attendance_date);

-- Untuk unique constraint
ALTER TABLE attendances ADD UNIQUE INDEX unique_emp_date (employee_id, attendance_date);
```

## Migration History

```bash
# 1. Create initial tables
php artisan migrate

# 2. Add position_id to employees
php artisan migrate --path="database/migrations/2025_11_28_072839_add_position_id_to_employees_table.php"

# View status
php artisan migrate:status
```

## Database Backup & Recovery

### Backup Database
```bash
# MySQL Command Line
mysqldump -u root -p absensiazril > backup_absensiazril.sql

# With gzip compression
mysqldump -u root -p absensiazril | gzip > backup_absensiazril.sql.gz
```

### Restore Database
```bash
# Restore dari SQL file
mysql -u root -p absensiazril < backup_absensiazril.sql

# Restore dari compressed file
gunzip < backup_absensiazril.sql.gz | mysql -u root -p absensiazril
```

## Performance Considerations

1. **Indexing** - Semua FK dan fields yang sering diquery sudah diindex
2. **Query Optimization** - Gunakan SELECT fields yang diperlukan saja
3. **Pagination** - Attendance list menggunakan pagination (20 per halaman)
4. **Caching** - Pertimbangkan cache untuk dashboard statistics
5. **Archive** - Attendance lebih dari 1 tahun bisa di-archive ke tabel terpisah

## Normalization Level

**Normalization:** 3NF (Third Normal Form)

- ✅ 1NF - Semua values atomic (tidak ada multi-values dalam 1 cell)
- ✅ 2NF - Semua non-key columns fully dependent pada primary key
- ✅ 3NF - Tidak ada transitive dependency antar non-key columns

## Sample Queries

```sql
-- Get all employees dengan position mereka
SELECT e.id, e.name, e.email, p.name as position_name
FROM employees e
LEFT JOIN positions p ON e.position_id = p.id
ORDER BY e.created_at DESC;

-- Get attendance statistics untuk hari ini
SELECT 
  COUNT(*) as total_employees,
  SUM(CASE WHEN status = 'hadir' THEN 1 ELSE 0 END) as hadir,
  SUM(CASE WHEN status = 'alfa' THEN 1 ELSE 0 END) as alfa,
  SUM(CASE WHEN status IN ('sakit', 'izin') THEN 1 ELSE 0 END) as sakit_izin
FROM attendances
WHERE DATE(attendance_date) = CURDATE();

-- Get employee dengan attendance records
SELECT e.name, a.attendance_date, a.check_in_time, a.check_out_time, a.status
FROM employees e
LEFT JOIN attendances a ON e.id = a.employee_id
WHERE a.attendance_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
ORDER BY e.name, a.attendance_date DESC;

-- Get karyawan yang belum check-in hari ini
SELECT e.id, e.name, e.email
FROM employees e
WHERE NOT EXISTS (
  SELECT 1 FROM attendances a 
  WHERE a.employee_id = e.id 
  AND DATE(a.attendance_date) = CURDATE()
  AND a.check_in_time IS NOT NULL
);
```

---

**Last Updated:** November 28, 2025  
**Database Version:** MySQL 5.7+  
**Normalization:** 3NF (Third Normal Form)
