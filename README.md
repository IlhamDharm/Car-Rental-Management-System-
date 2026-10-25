# Adam Rental — Car Rental Management System

Aplikasi web manajemen rental mobil yang membantu pelanggan mencari kendaraan, melakukan booking, mengunggah konfirmasi pembayaran, dan memantau status penyewaan. Admin dapat mengelola armada, pengguna, booking, pembayaran, serta operasional rental melalui panel administrasi.

> Proyek ini dikembangkan untuk kebutuhan **Project-Based Learning (PBL) Semester 4** di **Politeknik Negeri Malang**.

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur](#fitur)
- [Teknologi](#teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi Database](#konfigurasi-database)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Panel Admin](#panel-admin)
- [Struktur Proyek](#struktur-proyek)
- [Pengujian](#pengujian)
- [Dokumentasi](#dokumentasi)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## Tentang Proyek

Adam Rental dibangun untuk mendigitalisasi proses penyewaan kendaraan dalam satu platform. Sistem memiliki dua sisi utama:

- **Pelanggan** dapat melihat katalog kendaraan, mencari mobil berdasarkan informasi tertentu, melakukan booking berdasarkan tanggal, mengunggah dokumen dan bukti pembayaran, serta melihat riwayat rental.
- **Admin** dapat mengelola data kendaraan, pengguna, transaksi booking, verifikasi pembayaran, dan status operasional rental melalui Filament Admin Panel.

Aplikasi menggunakan arsitektur **Model-View-Controller (MVC)** dari Laravel dengan autentikasi, verifikasi email, validasi data, relasi database, dan pencegahan bentrok jadwal booking.

## Fitur

### Fitur Pelanggan

- Registrasi dan login pengguna.
- Verifikasi email.
- Pengunggahan dokumen KTP dan SIM saat registrasi.
- Katalog kendaraan dan halaman detail kendaraan.
- Pencarian global untuk kendaraan dan halaman aplikasi.
- Filter ketersediaan kendaraan berdasarkan tanggal rental.
- Booking kendaraan dengan informasi kontak, tanggal, lokasi, dan metode pengambilan/pengembalian.
- Perhitungan total harga rental.
- Pemilihan metode pembayaran.
- Pengunggahan konfirmasi pembayaran.
- Riwayat booking dan rental.
- Pengelolaan profil pengguna.
- Tampilan responsif untuk perangkat desktop maupun mobile.

### Fitur Admin

- Dashboard ringkasan operasional rental.
- CRUD data kendaraan atau produk rental.
- CRUD dan pengelolaan data pengguna.
- Pengelolaan booking dan status pembayaran.
- Pembaruan status operasional rental.
- Pemantauan unit yang sedang disewa.
- Perhitungan total harga booking secara otomatis.
- Pengelolaan data melalui Filament Admin Panel.

### Aturan Bisnis Utama

- Pengguna harus login dan memverifikasi email sebelum mengakses fitur booking dan pembayaran.
- Kendaraan yang memiliki booking terkonfirmasi pada rentang tanggal yang bertabrakan tidak ditampilkan sebagai tersedia.
- Total harga dihitung berdasarkan harga kendaraan dan durasi rental.
- Status kendaraan dapat diperbarui otomatis berdasarkan status booking yang sedang berjalan.
- Data pengguna, kendaraan, dan booking memiliki relasi melalui Eloquent ORM.

## Teknologi

| Komponen | Teknologi |
| --- | --- |
| Bahasa pemrograman | PHP 8.3, JavaScript |
| Backend | Laravel 12 |
| Admin panel | Filament 5 |
| Template | Blade |
| Frontend tooling | Vite 7 |
| Styling | Tailwind CSS 4 dan Bootstrap pada halaman pengguna |
| Database default | SQLite |
| Database alternatif | MySQL, MariaDB, PostgreSQL, SQL Server |
| Dependency manager | Composer dan npm |
| Testing | PHPUnit melalui Laravel Test Runner |

## Persyaratan Sistem

Pastikan perangkat telah memiliki:

- PHP **8.3 atau lebih baru**.
- Composer.
- Node.js dan npm.
- Ekstensi PHP `intl` dan `zip`.
- Database SQLite untuk konfigurasi lokal, atau database lain yang didukung Laravel.
- Git (opsional, untuk mengambil source code dari repository).

## Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/IlhamDharm/Car-Rental-Management-System-.git
   cd Car-Rental-Management-System-
   ```

2. Install dependency PHP:

   ```bash
   composer install
   ```

3. Salin file konfigurasi environment:

   ```bash
   cp .env.example .env
   ```

   Pada Windows PowerShell, gunakan:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Buat application key:

   ```bash
   php artisan key:generate
   ```

5. Install dependency frontend:

   ```bash
   npm install
   ```

6. Buat symbolic link untuk file storage publik:

   ```bash
   php artisan storage:link
   ```

7. Jalankan migration database:

   ```bash
   php artisan migrate
   ```

Jika ingin menjalankan seluruh proses setup bawaan proyek, tersedia perintah:

```bash
composer run setup
```

Perintah tersebut menjalankan instalasi Composer, membuat `.env`, membuat application key, menjalankan migration, meng-install dependency npm, dan melakukan build aset frontend.

## Konfigurasi Database

Konfigurasi default pada `.env.example` menggunakan SQLite:

```env
DB_CONNECTION=sqlite
```

Pastikan file database tersedia sebelum menjalankan migration. Pada Windows PowerShell, file SQLite dapat dibuat dengan:

```powershell
New-Item database/database.sqlite -ItemType File
```

Atau gunakan database server dengan mengubah konfigurasi `.env`, misalnya PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=adam_rental
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

Setelah mengubah konfigurasi environment, jalankan:

```bash
php artisan config:clear
php artisan migrate
```

## Menjalankan Aplikasi

### Mode Development

Untuk menjalankan server Laravel:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui `http://127.0.0.1:8000`.

Pada terminal lain, jalankan Vite untuk memuat aset frontend secara real-time:

```bash
npm run dev
```

Atau jalankan seluruh proses development melalui script Composer:

```bash
composer run dev
```

Script tersebut menjalankan server Laravel, queue listener, Laravel Pail, dan Vite secara bersamaan.

### Build Production

Untuk membuat build aset frontend:

```bash
npm run build
```

## Panel Admin

Panel administrasi menggunakan Filament. Setelah aplikasi berjalan, panel dapat diakses melalui:

```text
http://127.0.0.1:8000/admin
```

Akun admin perlu tersedia di tabel `users` dengan role yang sesuai. Pengelolaan user, kendaraan, dan booking dilakukan melalui resource Filament yang berada di:

```text
app/Filament/Resources
```

Jangan memasukkan password, dokumen identitas, atau kredensial database ke dalam repository. Gunakan file `.env` untuk konfigurasi lokal dan pastikan file tersebut tidak di-commit.

## Struktur Proyek

```text
app/
├── Filament/              # Resource dan widget panel admin
├── Http/Controllers/      # Controller aplikasi
├── Models/                # Model Eloquent
└── Providers/             # Service provider

database/
├── migrations/            # Struktur tabel database
├── factories/             # Factory untuk testing
└── seeders/               # Data awal database

resources/
├── views/                 # Blade views untuk pelanggan
└── css, js                # Aset frontend

routes/
└── web.php                # Route aplikasi web

public/                    # Entry point dan aset publik
storage/                   # File upload dan log aplikasi
tests/                     # Unit test dan feature test
```

## Pengujian

Jalankan test suite dengan perintah:

```bash
php artisan test
```

Atau gunakan script Composer:

```bash
composer run test
```

## Dokumentasi

Penjelasan lebih rinci mengenai arsitektur, skema database, relasi tabel, dan logika fitur tersedia pada:

- [`DOCUMENTATION.md`](DOCUMENTATION.md) — dokumentasi teknis sistem.
- [`STRUKTUR_KODE_PENJELASAN.md`](STRUKTUR_KODE_PENJELASAN.md) — penjelasan struktur kode.
- [`SCRIPT_PRESENTASI_SINGKAT.md`](SCRIPT_PRESENTASI_SINGKAT.md) — ringkasan materi presentasi.

## Kontribusi

Kontribusi dapat dilakukan melalui alur berikut:

1. Fork repository.
2. Buat branch fitur baru:

   ```bash
   git checkout -b feature/nama-fitur
   ```

3. Lakukan perubahan dan tambahkan test yang relevan.
4. Pastikan test dan build berjalan dengan baik.
5. Buat pull request dengan deskripsi perubahan yang jelas.

## Lisensi

Proyek ini dibuat untuk kebutuhan edukasi dalam program Project-Based Learning di Politeknik Negeri Malang. Framework Laravel yang digunakan dalam proyek ini tersedia di bawah [MIT License](https://opensource.org/licenses/MIT).
