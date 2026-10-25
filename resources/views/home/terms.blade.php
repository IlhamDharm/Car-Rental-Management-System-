<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan Sewa - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f5f7fb;
            color: #334155;
            padding-top: 90px;
        }

        .hero-section {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 50px 20px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);
            margin-bottom: 40px;
        }

        .terms-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }

        .section-title {
            color: #1e3a8a;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 8px;
        }

        .section-title i {
            color: #3b82f6;
        }

        .terms-list {
            padding-left: 20px;
            line-height: 1.8;
        }

        .terms-list li {
            margin-bottom: 10px;
        }

        .highlight-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            color: #1e40af;
        }
    </style>
</head>
<body>

    {{-- Include Navbar --}}
    @include('layouts.navbar')

    <div class="container mb-5">
        
        <!-- HERO -->
        <div class="hero-section">
            <h1 class="fw-bold mb-2"><i class="bi bi-file-earmark-text"></i> Kontrak Sewa & Ketentuan</h1>
            <p class="text-white-50 mb-0">Harap baca dengan saksama seluruh syarat dan ketentuan penyewaan kendaraan di Adam Rental</p>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="terms-card">
                    
                    <div class="highlight-box">
                        <strong>PENTING:</strong> Dengan mencentang persetujuan syarat dan ketentuan pada halaman pembayaran, Anda dianggap telah membaca, memahami, dan menyetujui seluruh butir kontrak sewa yang tertulis di bawah ini secara sah demi hukum.
                    </div>

                    <!-- SEKSI 1 -->
                    <div class="terms-section mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-person-check-fill"></i> 1. Ketentuan Pengemudi & Identitas
                        </h5>
                        <ul class="terms-list">
                            <li>Penyewa wajib memiliki **SIM A** yang masih aktif dan sah secara hukum di Indonesia.</li>
                            <li>Penyewa wajib mengunggah foto **KTP asli** dan **SIM A** yang jelas (tidak buram/terpotong) saat melakukan registrasi.</li>
                            <li>Usia minimum pengemudi adalah **18 tahun** dan maksimum adalah **65 tahun** pada saat masa sewa berlangsung.</li>
                            <li>Nama pemesan pada booking wajib sama dengan nama yang tertera pada KTP dan SIM A yang diserahkan untuk verifikasi.</li>
                        </ul>
                    </div>

                    <!-- SEKSI 2 -->
                    <div class="terms-section mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-shield-lock-fill"></i> 2. Kebijakan Jaminan & Deposit
                        </h5>
                        <ul class="terms-list">
                            <li>Penyewa diwajibkan menitipkan **KTP fisik asli** atau dokumen jaminan lain yang disepakati saat serah terima unit kendaraan.</li>
                            <li>Uang jaminan keamanan (*security deposit*) dapat diberlakukan untuk unit tertentu dan akan dikembalikan 100% setelah unit dikembalikan dalam kondisi utuh dan aman.</li>
                            <li>KTP fisik jaminan akan dikembalikan sepenuhnya secara instan setelah masa sewa berakhir dan kendaraan dicek bersama.</li>
                        </ul>
                    </div>

                    <!-- SEKSI 3 -->
                    <div class="terms-section mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-fuel-pump-fill"></i> 3. Bahan Bakar & Kebersihan
                        </h5>
                        <ul class="terms-list">
                            <li>Kebijakan bahan bakar adalah **Same to Same** (dikembalikan dengan kapasitas bahan bakar yang sama seperti saat diserahkan). Jika bahan bakar berkurang, penyewa wajib mengganti biaya BBM sesuai selisihnya.</li>
                            <li>Kendaraan diserahkan dalam keadaan bersih dan wajib dikembalikan dalam kondisi **bersih luar dan dalam**.</li>
                            <li>Jika kendaraan dikembalikan dengan kotoran ekstrem (noda lumpur tebal, muntah, bau rokok pekat), penyewa akan dikenakan denda biaya salon/pembersihan sebesar **Rp 100.000 s/d Rp 250.000**.</li>
                        </ul>
                    </div>

                    <!-- SEKSI 4 -->
                    <div class="terms-section mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-clock-fill"></i> 4. Durasi Sewa & Denda Keterlambatan
                        </h5>
                        <ul class="terms-list">
                            <li>Durasi minimal sewa dihitung per **24 jam** sejak waktu serah terima unit kendaraan.</li>
                            <li>Keterlambatan pengembalian unit (*overtime*) akan dikenakan biaya tambahan sebesar **10% per jam** dari harga sewa harian.</li>
                            <li>Keterlambatan pengembalian yang melebihi **3 jam** otomatis dihitung sebagai sewa tambahan **1 hari penuh**.</li>
                            <li>Perpanjangan masa sewa wajib dikonfirmasikan kepada Admin minimal **12 jam** sebelum masa sewa berakhir dan bergantung pada ketersediaan unit.</li>
                        </ul>
                    </div>

                    <!-- SEKSI 5 -->
                    <div class="terms-section mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-exclamation-triangle-fill"></i> 5. Kerusakan & Kecelakaan
                        </h5>
                        <ul class="terms-list">
                            <li>Penyewa bertanggung jawab penuh atas segala bentuk kerusakan ringan, sedang, maupun berat pada unit kendaraan selama masa sewa.</li>
                            <li>Untuk lecet/goresan ringan pada body kendaraan, penyewa dikenakan denda klaim asuransi (*own damage*) sebesar **Rp 300.000 per kejadian/panel**.</li>
                            <li>Jika terjadi kecelakaan parah yang mengakibatkan mobil harus masuk bengkel (*down time*), penyewa wajib membayar biaya perbaikan mandiri serta biaya ganti rugi harian selama mobil dalam masa perbaikan di bengkel.</li>
                            <li>Dilarang keras menggunakan unit kendaraan untuk kegiatan melanggar hukum (balap liar, membawa barang terlarang/narkoba, atau tindak kriminalitas). Pelanggaran hukum sepenuhnya menjadi tanggung jawab hukum pribadi penyewa.</li>
                        </ul>
                    </div>

                    <div class="text-center mt-5">
                        <button onclick="window.close();" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                            <i class="bi bi-x-circle me-1"></i> Tutup Halaman Kontrak
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
