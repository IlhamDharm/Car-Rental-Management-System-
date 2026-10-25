<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f5f7fb;
            color: #334155;
            padding-top: 90px;
        }

        .hero-section {
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&q=80&w=1920') center/cover no-repeat;
            color: white;
            padding: 80px 20px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            margin-bottom: 40px;
        }

        .about-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }

        .section-title {
            color: #1e3a8a;
            font-weight: 800;
            font-size: 1.75rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 4px;
            background-color: #3b82f6;
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }

        .section-title-center {
            text-align: center;
        }

        .section-title-center::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .about-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #475569;
        }

        .value-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-color: #3b82f6;
        }

        .value-icon {
            font-size: 2.5rem;
            color: #3b82f6;
            margin-bottom: 15px;
        }

        .value-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.15rem;
            margin-bottom: 10px;
        }

        .value-desc {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    {{-- Include Navbar --}}
    @include('layouts.navbar')

    <div class="container mb-5">
        
        <!-- HERO -->
        <div class="hero-section">
            <h1 class="display-4 fw-bold mb-3"><i class="bi bi-info-circle-fill"></i> Tentang Adam Rental</h1>
            <p class="fs-5 text-white-50 mb-0">Solusi persewaan mobil terpercaya dan profesional untuk segala perjalanan Anda</p>
        </div>

        <!-- VISION & MISSION -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="about-card h-100">
                    <h3 class="section-title"><i class="bi bi-eye-fill"></i> Visi Kami</h3>
                    <p class="about-text">
                        Menjadi perusahaan transportasi dan jasa rental mobil nomor satu yang paling dipercaya dan diandalkan di Indonesia, dengan menyediakan pelayanan terbaik, armada prima, serta inovasi teknologi yang memudahkan mobilitas masyarakat secara aman dan efisien.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-card h-100">
                    <h3 class="section-title"><i class="bi bi-bullseye"></i> Misi Kami</h3>
                    <p class="about-text">
                        Menyediakan armada kendaraan yang selalu dalam kondisi prima, bersih, dan aman. Memberikan pelayanan yang ramah, cepat, dan profesional kepada setiap pelanggan. Menyediakan solusi transportasi dengan harga yang kompetitif, transparan, dan terjangkau untuk semua kalangan masyarakat.
                    </p>
                </div>
            </div>
        </div>

        <!-- HISTORY & EXPLANATION -->
        <div class="about-card mb-5">
            <h3 class="section-title"><i class="bi bi-clock-history"></i> Sejarah & Nilai Kami</h3>
            <p class="about-text">
                Didirikan sejak tahun 2020 di Kota Malang, **Adam Rental** lahir dengan komitmen sederhana: memberikan kemudahan sewa kendaraan dengan proses yang transparan, aman, dan tanpa kendala. Seiring berjalannya waktu, kami telah memperluas area pelayanan hingga ke Kota Surabaya dengan puluhan armada kendaraan yang siap melayani kebutuhan harian, mingguan, maupun bulanan.
            </p>
            <p class="about-text">
                Kami sangat memprioritaskan keamanan pelanggan. Oleh karena itu, seluruh armada kendaraan kami selalu melalui pemeriksaan rutin dan berkala sebelum diserahterimakan kepada penyewa. Dengan memadukan integrasi verifikasi dokumen digital dan manajemen admin yang responsif, kami menjamin perjalanan Anda akan berjalan dengan tenang dan menyenangkan.
            </p>
        </div>

        <!-- CORE VALUES -->
        <h3 class="section-title section-title-center mb-4"><i class="bi bi-gem"></i> Nilai Utama Kami</h3>
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-shield-fill-check"></i></div>
                    <div class="value-title">Keamanan Utama</div>
                    <div class="value-desc">Seluruh kendaraan dipastikan lulus uji kelayakan operasional dan kebersihan menyeluruh sebelum digunakan.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-wallet2"></i></div>
                    <div class="value-title">Harga Terbaik</div>
                    <div class="value-desc">Harga sewa bersaing dan sangat transparan, tanpa adanya biaya tersembunyi yang merugikan pelanggan.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-headset"></i></div>
                    <div class="value-title">Layanan 24/7</div>
                    <div class="value-desc">Tim layanan pelanggan kami siap membantu Anda kapan saja untuk memastikan kelancaran perjalanan Anda.</div>
                </div>
            </div>
        </div>

    </div>

    <!-- FOOTER SECTION -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
