# 🎤 SCRIPT PRESENTASI SINGKAT
## Penjelasan Struktur Kode Website Penyewaan Mobil

---

## PEMBUKAAN (30 detik)
```
"Assalamu'alaikum, saya akan menjelaskan struktur kode dari website 
penyewaan mobil ini. Website ini dibangun menggunakan Laravel framework 
dengan konsep MVC (Model-View-Controller). Mari kita lihat komponen-
komponennya satu per satu."
```

---

## BAGIAN 1: TEKNOLOGI STACK (1 menit)
```
"Pertama, teknologi yang digunakan:
- Backend: Laravel 12 (Framework PHP modern)
- Frontend: Blade Template + Vite (untuk JavaScript & CSS)
- Database: MySQL (penyimpanan data)
- Admin Panel: Filament (untuk management data)

Jadi singkatnya, ini website full-stack modern yang bisa menangani:
✓ Data mobil
✓ Pemesanan/booking
✓ Pembayaran
✓ User account & profile
✓ Riwayat penyewaan"
```

---

## BAGIAN 2: ARSITEKTUR MVC (1.5 menit)
```
"Website ini mengikuti pola MVC. Apa itu MVC?

MODEL = Database Layer
- File: app/Models/ (Car.php, Booking.php, User.php, dll)
- Fungsi: Mengelola data dan hubungan antar table
- Contoh: Model Car punya banyak Booking

VIEW = Presentation Layer
- File: resources/views/ (HTML menggunakan Blade Template)
- Fungsi: Tampilan yang dilihat oleh user di browser
- Contoh: Show detail mobil, form booking, user profile

CONTROLLER = Logic Layer
- File: app/Http/Controllers/ (CarController, BookingController, dll)
- Fungsi: Menangani logika bisnis
- Alur:
  1. Terima request dari user
  2. Ambil data dari Model/Database
  3. Proses logika
  4. Kirim data ke View
  5. Tampilkan ke browser

Jadi alurnya: User → Route → Controller → Model → Database → Controller → View → Browser"
```

---

## BAGIAN 3: MODELS & RELASI DATABASE (2 menit)
```
"Sekarang model-model utama:

1. MODEL CAR (Mobil)
   - Kolom: brand, model, capacity, price, stock, tahun, warna, dll
   - 1 mobil bisa di-booking oleh banyak user
   
2. MODEL BOOKING (Pemesanan)
   - Kolom: user_id, car_id, start_date, duration, total_price, status, dll
   - Setiap booking punya 1 user penyewa & 1 mobil
   - Status: pending → approved → completed
   
3. MODEL USER (Pengguna)
   - Kolom: name, email, password, profile
   - 1 user bisa punya banyak booking
   
4. MODEL PRODUCT (Produk - Optional)
   - Untuk produk tambahan atau sync dengan Car
   
5. MODEL CATEGORY, TAG, POST
   - Untuk kategori mobil, tag, dan blog

RELASI:
- 1 User → Many Bookings
- 1 Car → Many Bookings
- 1 Category → Many Products

Visualnya: User mesan Car → Booking dibuat → Bayar → Selesai"
```

---

## BAGIAN 4: CONTROLLERS & ROUTES (2 menit)
```
"Controllers adalah 'otak' aplikasi. Ada 7 controller utama:

1. CarController
   - show() = Tampilkan detail mobil
   - Diakses via: GET /cars/{id}

2. BookingController
   - create() = Form booking baru
   - store() = Simpan booking ke database
   - update() = Update status booking
   - Diakses via: POST /booking

3. UserController
   - profile() = Tampilkan profil user
   - rentalHistory() = Riwayat penyewaan
   - updateProfile() = Update profil
   
4. AuthController
   - login/logout = Autentikasi user
   
5. PaymentController
   - index() = Halaman pembayaran
   - store() = Proses pembayaran
   
6. ProductController
   - index() = Daftar produk
   
7. GlobalSearchController
   - Fitur pencarian

ROUTES (URL Entry Points):
- GET /customer → Halaman utama
- GET /cars/{id} → Detail mobil
- POST /booking → Booking mobil
- GET /payment → Halaman pembayaran
- GET /user/profile → Profil user"
```

---

## BAGIAN 5: WORKFLOW PEMESANAN (2 menit)
```
"Mari kita lihat workflow lengkap pemesanan mobil:

STEP 1: User akses halaman utama
→ GET /customer
→ CarController query semua mobil
→ Display di View

STEP 2: User klik salah satu mobil
→ GET /cars/{id}
→ CarController.show() ambil data mobil by ID
→ Tampilkan detail (spesifikasi, harga, availability)

STEP 3: User klik 'Pesan Sekarang'
→ Redirect ke booking form
→ User isi:
   - Nama
   - Email & kontak
   - Tanggal mulai sewa
   - Durasi (berapa hari)
   - Upload KTP & SIM
   - Pilih metode pickup/return

STEP 4: User submit booking
→ POST /booking
→ BookingController validate data
→ Check stock mobil (apakah ada yang tersedia)
→ Hitung total_price = price_mobil × duration
→ Simpan Booking di database dengan status 'pending'

STEP 5: Redirect ke payment
→ GET /payment
→ Tampilkan total yang harus dibayar
→ User input payment details

STEP 6: Proses pembayaran
→ POST /payment
→ PaymentController verifikasi pembayaran
→ Update status booking jadi 'paid' atau 'approved'

STEP 7: Selesai
→ User dapat konfirmasi via email
→ User bisa lihat riwayat penyewaan di /user/rental-history"
```

---

## BAGIAN 6: STRUKTUR FOLDER (1 menit)
```
"Struktur folder website:

app/
├─ Models/ → Semua model database
├─ Http/Controllers/ → Semua logic controller
└─ Providers/ → Konfigurasi aplikasi

routes/
└─ web.php → Semua URL routes

resources/views/ → Semua halaman HTML (Blade)

database/
├─ migrations/ → Skema database (versi kontrol untuk DB)
└─ seeders/ → Data dummy awal

config/ → File konfigurasi aplikasi

public/
├─ index.php → Entry point
├─ css/, js/ → Asset static
└─ storage/ → File upload

vendor/ → Library pihak ketiga (jangan diubah)"
```

---

## BAGIAN 7: DATABASE DIAGRAM (1.5 menit)
```
"Database terdiri dari beberapa tabel:

┌──────────┐        ┌──────────────┐        ┌──────────┐
│  users   │────1:N─│   bookings   │───N:1──│   cars   │
│----------|        |--------------|        |----------|
│ id       │        │ id           │        │ id       │
│ name     │        │ user_id (FK) │        │ brand    │
│ email    │        │ car_id (FK)  │        │ model    │
│ password │        │ start_date   │        │ price    │
│          │        │ duration     │        │ stock    │
└──────────┘        │ total_price  │        └──────────┘
                    │ status       │
                    │ payment_     │
                    │ method       │
                    └──────────────┘

1 User bisa punya banyak Booking
1 Mobil bisa di-booking banyak kali
Setiap Booking connect User ke Car

Juga ada:
- categories (kategori produk)
- products (daftar produk)
- tags & posts (untuk blog/artikel)"
```

---

## BAGIAN 8: MIGRASI DATABASE (1 menit)
```
"Database structure di-manage via migration files.

Migration adalah 'version control untuk database'.

File migrasi ada di: database/migrations/

Contoh:
- 2026_04_13_161027_create_cars_table.php
  → Membuat table 'cars'
  
- 2026_04_13_173241_create_bookings_table.php
  → Membuat table 'bookings'
  
- 2026_05_05_075819_add_profile_to_users.php
  → Menambah kolom 'profile' ke table 'users'

Keuntungan:
✓ Track perubahan database
✓ Mudah di-undo/di-rollback
✓ Konsisten di semua environment
✓ Version control friendly"
```

---

## BAGIAN 9: FITUR UTAMA (1 menit)
```
"Fitur-fitur utama aplikasi:

1. BROWSING MOBIL
   - User bisa lihat daftar mobil
   - Filter by kategori, harga, type
   - Search mobil tertentu

2. BOOKING MOBIL
   - Pilih mobil
   - Isi form (nama, email, tanggal, durasi)
   - Upload dokumen (KTP, SIM)
   - Pilih metode pickup & return

3. PEMBAYARAN
   - Hitung total (harga × hari)
   - Proses pembayaran
   - Konfirmasi pembayaran

4. AUTENTIKASI
   - Register akun baru
   - Login
   - Logout

5. USER PROFILE
   - Lihat & edit profil
   - Lihat riwayat penyewaan
   - Lihat status booking

6. ADMIN PANEL (Filament)
   - Kelola data mobil
   - Kelola booking
   - Lihat statistik
   - Manage user"
```

---

## BAGIAN 10: TECH STACK SUMMARY (30 detik)
```
"Ringkas teknologi:

PHP 8.2 + Laravel 12
    ↓
ORM Eloquent (untuk query database)
    ↓
Filament (admin panel)
    ↓
Blade Template Engine (HTML rendering)
    ↓
Vite (asset bundling - JS/CSS)
    ↓
MySQL (database)
    ↓
PHPUnit (testing)

Semuanya modern dan production-ready."
```

---

## PENUTUP (1 menit)
```
"Jadi kesimpulannya:

Website penyewaan mobil ini adalah aplikasi full-stack yang:

✓ Menggunakan pola MVC untuk struktur yang rapi
✓ Punya 7 model (User, Car, Booking, Product, Category, Tag, Post)
✓ Punya 7 controller untuk handle berbagai fitur
✓ Database terstruktur dengan relasi yang jelas
✓ Workflow booking yang lengkap (browse → booking → payment → selesai)
✓ Admin panel untuk management data

Setiap komponen (Model, Controller, View) punya tanggung jawab masing-masing, 
sehingga code ini mudah di-maintain dan di-scale.

Terima kasih."
```

---

## ⏱️ DURASI TOTAL PRESENTASI: ~13-15 menit

---

## 💡 TIPS PRESENTASI:
1. Buka file `STRUKTUR_KODE_PENJELASAN.md` sebagai referensi detail
2. Gunakan diagram/visual jika ada projector
3. Beri contoh konkret (misal: user bookmark mobil Toyota → flow apa saja)
4. Tunjuk file di VS Code saat menjelaskan
5. Jangan rush - setiap bagian penting dipahami audience
6. Siapkan 2-3 pertanyaan untuk audience di akhir
