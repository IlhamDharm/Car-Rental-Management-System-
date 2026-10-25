# 📋 Penjelasan Struktur Kode Website Penyewaan Mobil

## 1️⃣ TEKNOLOGI YANG DIGUNAKAN
- **Framework Backend**: Laravel 12 (PHP 8.2+)
- **Panel Admin**: Filament 5.0
- **Frontend**: Blade Template Engine + Vite (JavaScript/CSS)
- **Database**: MySQL
- **Testing**: PHPUnit

---

## 2️⃣ ARSITEKTUR APLIKASI

```
Website Penyewaan Mobil (MVC Architecture)
│
├─ Models (Database Layer)
├─ Controllers (Logic Layer)  
├─ Views (Presentation Layer)
└─ Routes (Entry Points)
```

**Model-View-Controller (MVC)**:
- **Models** → Mengelola data dan database (Booking, Car, User, Product, Category, Tag)
- **Controllers** → Memproses logika bisnis (CarController, BookingController, UserController, dll)
- **Views** → Tampilan HTML yang dilihat user (Blade template)
- **Routes** → Menghubungkan URL dengan Controller

---

## 3️⃣ MODEL & DATABASE

### 📊 Entitas Utama:

#### **A. MODEL CAR (Mobil)**
```
Tabel: cars
- id (Primary Key)
- image (Gambar mobil)
- brand (Merek: Toyota, Honda, etc)
- model (Model: Avanza, Civic, etc)
- capacity (Kapasitas penumpang)
- transmission (Manual/Automatic)
- fuel_type (Jenis Bahan Bakar)
- price (Harga sewa per hari)
- description (Deskripsi)
- provider_name (Nama penyedia)
- provider_contact (Kontak penyedia)
- stock (Jumlah mobil tersedia)
- tahun (Tahun pembuatan)
- warna (Warna mobil)
```

**Relasi**:
- `hasMany(Booking)` → 1 mobil bisa punya banyak booking

---

#### **B. MODEL BOOKING (Pemesanan)**
```
Tabel: bookings
- id (Primary Key)
- user_id (FK ke users - penyewa)
- car_id (FK ke cars - mobil yang disewa)
- customer_name (Nama penyewa)
- customer_contact (Kontak penyewa)
- start_date (Tanggal mulai sewa)
- end_date (Tanggal berakhir sewa)
- duration (Durasi sewa dalam hari)
- total_price (Total harga)
- payment_method (Metode pembayaran)
- status (Status: pending, approved, completed, cancelled)
- email (Email penyewa)
- alamat (Alamat penyewa)
- ktp_file (File KTP)
- sim_file (File SIM)
- pickup_location (Lokasi pickup)
- pickup_method (Cara pickup: antar, ambil sendiri)
- return_method (Cara kembalikan: antar, ambil sendiri)
- source_info (Asal informasi)
```

**Relasi**:
- `belongsTo(Car)` → Setiap booking mengacu pada 1 mobil
- `belongsTo(User)` → Setiap booking dimiliki 1 user

---

#### **C. MODEL USER (Pengguna)**
```
Tabel: users
- id (Primary Key)
- name (Nama)
- email (Email)
- password (Password hash)
- profile (Foto profil - ditambahkan later)
- created_at (Waktu buat akun)
- updated_at (Waktu update terakhir)
```

**Relasi**:
- `hasMany(Booking)` → 1 user bisa punya banyak booking

---

#### **D. MODEL PRODUCT (Produk)**
```
Tabel: products
- id (Primary Key)
- name (Nama produk)
- category_id (FK ke categories)
- description (Deskripsi)
- price (Harga)
- type (Tipe produk)
- location (Lokasi)
- stock (Jumlah stok)
```

---

#### **E. MODEL CATEGORY (Kategori)**
```
Tabel: categories
- id (Primary Key)
- name (Nama kategori)
- slug (URL slug)
```

---

#### **F. MODEL POST & TAG**
- **Post**: Blog/artikel
- **Tag**: Label untuk post/kategori konten

---

### 📈 DIAGRAM RELASI DATABASE:

```
users (1) ──────────── (M) bookings
                             │
                             ├──────────── (1) cars
                             
cars (1) ──────────── (M) bookings

categories (1) ──────────── (M) products

posts (M) ──────────── (M) tags (via pivot table)
```

---

## 4️⃣ CONTROLLERS (Logika Bisnis)

### **CarController**
**Fungsi**: Mengelola data dan tampilan mobil
- `show()` → Menampilkan detail mobil
- `userShow()` → Tampilan user (dari product)

### **BookingController**
**Fungsi**: Mengelola pemesanan/reservasi
- Membuat booking baru
- Update status booking
- Menghapus booking

### **UserController**
**Fungsi**: Mengelola data pengguna
- `profile()` → Tampilkan profil user
- `rentalHistory()` → Riwayat penyewaan user
- `updateProfile()` → Update profil user

### **AuthController**
**Fungsi**: Autentikasi (login/register)
- `showLogin()` → Tampilkan form login
- `login()` → Proses login
- `showRegister()` → Tampilkan form register
- `register()` → Proses register
- `logout()` → Logout user

### **PaymentController**
**Fungsi**: Mengelola pembayaran
- `index()` → Tampilkan halaman pembayaran
- `store()` → Proses pembayaran

### **ProductController**
**Fungsi**: Mengelola produk
- `index()` → Daftar produk
- `syncToCars()` → Sinkronisasi produk ke cars

### **GlobalSearchController**
**Fungsi**: Pencarian global di website

---

## 5️⃣ ROUTES (Rute URL)

### **Halaman Publik**:
```
GET  /                    → Redirect ke /customer
GET  /customer            → Halaman utama (daftar mobil)
GET  /search              → Pencarian global
GET  /product             → Daftar produk
GET  /product/{id}        → Detail produk/mobil
GET  /cars/{id}           → Detail mobil (dari car model)
```

### **Authentication**:
```
GET  /login               → Form login
POST /login               → Proses login
GET  /register            → Form register
POST /register            → Proses register
POST /logout              → Logout
```

### **User Area** (Harus login):
```
GET  /user/profile                → Profil user
GET  /user/rental-history         → Riwayat sewa
POST /user/update-profile         → Update profil
```

### **Payment**:
```
GET  /payment             → Halaman pembayaran
POST /payment             → Proses pembayaran
```

### **Synchronization**:
```
GET  /sync-products-cars  → Sinkronisasi data
```

---

## 6️⃣ STRUKTUR FOLDER

```
app/
├─ Models/
│  ├─ Booking.php        ← Model untuk pemesanan
│  ├─ Car.php            ← Model untuk mobil
│  ├─ User.php           ← Model untuk user
│  ├─ Product.php        ← Model untuk produk
│  ├─ Category.php       ← Model untuk kategori
│  └─ Tag.php            ← Model untuk tag
│
├─ Http/
│  └─ Controllers/
│     ├─ BookingController.php
│     ├─ CarController.php
│     ├─ UserController.php
│     ├─ AuthController.php
│     ├─ PaymentController.php
│     ├─ ProductController.php
│     └─ GlobalSearchController.php
│
└─ Providers/
   └─ AppServiceProvider.php     ← Konfigurasi aplikasi

routes/
├─ web.php               ← Semua routes untuk web
└─ console.php           ← Routes untuk command line

resources/
└─ views/               ← Template Blade (HTML)
   ├─ home/
   ├─ cars/
   ├─ users/
   └─ ...

database/
├─ migrations/          ← Migrasi database
├─ seeders/             ← Data dummy untuk testing
└─ factories/           ← Factory untuk testing

config/
├─ app.php             ← Konfigurasi aplikasi
├─ database.php        ← Konfigurasi database
├─ auth.php            ← Konfigurasi autentikasi
└─ ...

public/
├─ index.php           ← Entry point aplikasi
├─ css/                ← File CSS
├─ js/                 ← File JavaScript
└─ storage/            ← File upload

vendor/
└─ ...                 ← Semua library/package eksternal
```

---

## 7️⃣ ALUR REQUEST & RESPONSE

```
User akses URL
    ↓
Route (web.php) menemukan route
    ↓
Controller mengambil logic
    ↓
Model query ke database
    ↓
Database mengembalikan data
    ↓
Model ke Controller
    ↓
Controller mengirim ke View
    ↓
View (Blade) render HTML
    ↓
Browser menampilkan halaman
```

### **Contoh Alur Melihat Detail Mobil**:
```
User: GET /cars/1
    ↓
routes/web.php: Route::get('/cars/{id}', [CarController::class, 'show'])
    ↓
CarController.show() dipanggil dengan id=1
    ↓
Model Car mencari data mobil dengan id=1
    ↓
Database mengembalikan data mobil
    ↓
Controller kirim ke view: resources/views/cars/show.blade.php
    ↓
View menampilkan detail mobil di browser
```

---

## 8️⃣ FITUR UTAMA APLIKASI

### **🚗 Manajemen Mobil**:
- Daftar mobil dengan filter
- Detail mobil (spesifikasi, harga, ketersediaan)
- Pencarian mobil

### **📅 Sistem Pemesanan**:
- User bisa pesan mobil (start_date, duration, end_date)
- Upload dokumen (KTP, SIM)
- Pilih metode pickup/return
- Status tracking pemesanan

### **💳 Pembayaran**:
- Halaman pembayaran
- Proses pembayaran
- Total harga = price mobil × duration

### **👤 User Profile**:
- Registrasi akun
- Login/Logout
- Lihat/edit profil
- Riwayat penyewaan

### **🔍 Pencarian & Filter**:
- Pencarian global
- Filter mobil by kategori, harga, type
- Sinkronisasi data produk ke mobil

### **📊 Admin Panel (Filament)**:
- Kelola mobil, kategori, produk
- Kelola booking, user
- Dashboard statistik

---

## 9️⃣ FILE PENTING YANG PERLU DIKETAHUI

### **Konfigurasi**:
- `.env` → Environment variables (database, app key, dll)
- `composer.json` → PHP dependencies
- `package.json` → JavaScript dependencies
- `phpunit.xml` → Testing configuration

### **Entry Point**:
- `public/index.php` → Entry point aplikasi

### **Middleware** (jika ada):
- `app/Http/Middleware/` → Filter request

### **Database**:
- `database/migrations/` → Skema database
- `database/seeders/` → Data dummy awal

---

## 🔟 TECH STACK RINGKAS

```
┌─────────────────────────────────────────┐
│     Backend: Laravel 12 (PHP 8.2+)     │
│     - ORM: Eloquent                     │
│     - Admin: Filament 5.0               │
├─────────────────────────────────────────┤
│   Frontend: Blade + Vite + JavaScript   │
├─────────────────────────────────────────┤
│     Database: MySQL                     │
├─────────────────────────────────────────┤
│     Testing: PHPUnit                    │
└─────────────────────────────────────────┘
```

---

## 1️⃣1️⃣ WORKFLOW PENYEWAAN MOBIL

```
1. User akses /customer
   ├─ Lihat daftar mobil
   └─ Filter by kategori/harga
   
2. User pilih mobil
   └─ GET /cars/{id} → Lihat detail
   
3. User klik "Pesan"
   └─ Redirect ke booking form
   
4. User isi form booking
   ├─ Tanggal mulai & durasi
   ├─ Data diri
   ├─ Upload KTP & SIM
   └─ Pilih metode pickup/return
   
5. User submit booking
   └─ POST /booking
      ├─ Controller validate data
      ├─ Cek stock mobil
      ├─ Hitung total_price = price × duration
      └─ Simpan ke database
   
6. Redirect ke payment
   └─ GET /payment → Lihat total pembayaran
   
7. User lakukan pembayaran
   └─ POST /payment
      ├─ Process pembayaran
      └─ Update booking status = 'paid'
   
8. Booking konfirmasi
   └─ User dapat konfirmasi email
      ├─ Nomor booking
      ├─ Detail mobil
      ├─ Jadwal pickup
      └─ Instruksi return
   
9. User akses /user/rental-history
   └─ Lihat riwayat penyewaan
```

---

## 1️⃣2️⃣ MIGRATION (Database Versioning)

```
database/migrations/ berisi:
├─ 0001_01_01_000000_create_users_table.php
├─ 2026_03_05_044316_create_categories_table.php
├─ 2026_03_05_044839_create_posts_table.php
├─ 2026_03_09_112411_create_products_table.php
├─ 2026_04_13_161027_create_cars_table.php
├─ 2026_04_13_173241_create_bookings_table.php
├─ 2026_04_28_000000_add_stock_to_cars_table.php
├─ 2026_05_05_075819_add_profile_to_users.php
├─ 2026_05_05_080849_add_user_id_to_bookings.php
└─ 2026_05_09_185826_add_nemob_fields_to_bookings_table.php

Setiap file = 1 perubahan database
Format: YYYY_MM_DD_HHMMSS_action_description.php
```

---

## 1️⃣3️⃣ COMMAND PENTING

```bash
# Setup awal
composer install              # Install PHP dependencies
npm install                   # Install JS dependencies
php artisan migrate           # Jalankan semua migration
php artisan seed              # Isi data dummy

# Development
php artisan serve             # Start server (localhost:8000)
npm run dev                   # Start Vite dev server

# Testing
php artisan test              # Run PHPUnit tests

# Production
php artisan migrate --force   # Migrate di production
npm run build                 # Build untuk production
```

---

## 📌 KESIMPULAN POIN-POIN KUNCI

✅ **Architecture**: MVC Pattern (Model-View-Controller)
✅ **Database**: Relational (MySQL) dengan 7+ tables
✅ **Main Entities**: Car, Booking, User, Product, Category
✅ **Key Features**: Booking, Payment, User Auth, Search
✅ **Frontend**: Blade Template + Vite
✅ **Admin**: Filament UI Panel
✅ **Testing**: PHPUnit untuk unit & feature tests

---

**Dibuat untuk presentasi/penjelasan struktur kode**
**Website Penyewaan Mobil - 2026**
