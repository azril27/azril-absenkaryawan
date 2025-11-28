

# 📦 Cara Instalasi Azril Absensi Karyawan (Dari Nol Sampai Jalan)

Panduan ini dibuat agar pengguna lain dapat meng-clone, mengonfigurasi, dan menjalankan aplikasi tanpa bingung.
Asumsi umum: proyek ini berbasis **PHP** + **Database (MySQL/MariaDB)**.

---

# ✅ 1. Persiapan Lingkungan (Wajib)

Sebelum menginstall aplikasi, pastikan PC/laptop sudah memiliki:

### **A. PHP**

Versi minimal biasanya **PHP 7.4+** atau **PHP 8+**
Cek dengan:

```bash
php -v
```

### **B. Composer**

Jika belum ada, unduh di:
[https://getcomposer.org/](https://getcomposer.org/)

Cek:

```bash
composer -v
```

### **C. Web Server**

* XAMPP
* Laragon
* WAMP
* MAMP
  (Disarankan **XAMPP** atau **Laragon** untuk pemula)

### **D. MySQL / MariaDB**

Biasanya sudah termasuk dalam XAMPP/Laragon.

---

# ✅ 2. Clone Repository

Buka terminal / CMD / Git Bash, lalu jalankan:

```bash
git clone https://github.com/azril27/azril-absenkaryawan.git
```

Masuk ke folder:

```bash
cd azril-absenkaryawan
```

---

# ✅ 3. Instal Dependency

Jika proyek menggunakan Composer, jalankan:

```bash
composer install
```

Jika tidak ada `composer.json`, lewati langkah ini.

---

# ✅ 4. Konfigurasi File `.env`

1. Salin file:

```bash
cp .env.example .env
```

2. Edit file `.env` menggunakan editor:

   * Sesuaikan nama database
   * Sesuaikan user & password

Contoh:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi_db
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan:**
>
> * Jika pakai XAMPP, default password MySQL biasanya kosong.
> * Jika pakai Laragon, password default juga kosong kecuali diubah.

---

# ✅ 5. Buat Database

Masuk ke **phpMyAdmin** atau tools lain:

* [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
* Buat database:

```
absensi_db
```

(tulis nama sama seperti di file `.env`)

---

# ✅ 6. Migrasi Database (Jika tersedia)

Jika proyek menggunakan sistem migrate (Laravel misalnya):

```bash
php artisan migrate
```

Jika tidak ada command tersebut, artinya database harus dibuat manual sesuai ERD.

---

# ✅ 7. Jalankan Server Lokal

Jika Laravel / PHP artisan:

```bash
php artisan serve
```

Jika tidak, letakkan folder pada:

* **XAMPP** → `htdocs`
* **Laragon** → `www`

Lalu akses:

```
http://localhost/azril-absenkaryawan
```

---

# ✅ 8. Login / Akses Aplikasi

Jika aplikasi memiliki login, gunakan akun default atau buat user baru di database.
Jika tidak ada login, aplikasi bisa langsung digunakan.

---

# 🎉 Aplikasi Berhasil Dijalankan!

Pengguna lain sekarang dapat:

* Menambahkan karyawan
* Melakukan absen masuk / keluar
* Melihat daftar absensi
* Mengelola data lain sesuai fitur

---

# 💬 Ingin saya buatkan versi:

### ✓ Format markdown lengkap untuk dimasukkan ke README?

### ✓ Atau ingin saya sesuaikan langkahnya berdasarkan *framework* proyek (Laravel / Native PHP)?

Cukup beri tahu saya framework apa yang digunakan dalam repo kamu, nanti saya sesuaikan secara presisi.
