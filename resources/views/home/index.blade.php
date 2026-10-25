<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body, html {
            height: 100vh;
            margin: 0;
            overflow: hidden; /* Mencegah scrollbar */
            background: #0f172a;
        }

        .hero-section {
            background: linear-gradient(rgba(15, 23, 42, 0.6), rgba(15, 23, 42, 0.85)), url('https://images.unsplash.com/photo-1482862549707-f63cb32c5fd9?auto=format&fit=crop&q=80&w=1920') center/cover no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 80px 20px 20px 20px; /* Space untuk navbar */
            box-sizing: border-box;
        }

        .hero-container {
            max-width: 450px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 2px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1rem;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        /* Kotak Pencarian Utama */
        .search-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 24px;
            border-radius: 24px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Menyesuaikan desain kalender Flatpickr agar menyatu dan rapi */
        .flatpickr-calendar {
            box-shadow: none !important;
            border: none !important;
            background: transparent !important;
            margin: 0 auto !important;
        }

        .flatpickr-calendar.inline {
            width: 290px !important;
        }

        .flatpickr-day {
            max-width: 36px !important;
            height: 36px !important;
            line-height: 36px !important;
        }

        /* Media Queries untuk Layar Pendek / Non-Fullscreen */
        @media (max-height: 720px) {
            .hero-section {
                padding-top: 70px;
            }
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-subtitle {
                margin-bottom: 10px;
                font-size: 0.85rem;
            }
            .search-box {
                padding: 15px;
                border-radius: 16px;
            }
            .search-box h6 {
                margin-bottom: 8px !important;
                font-size: 0.75rem !important;
            }
            .flatpickr-calendar.inline {
                transform: scale(0.9);
                margin: -10px auto !important;
            }
            .btn-submit {
                padding: 10px !important;
                font-size: 0.9rem !important;
            }
        }
    </style>
</head>
<body>
    {{-- Include Navbar --}}
    @include('layouts.navbar')

    {{-- ===== HERO & KALENDER ===== --}}
    <div class="hero-section text-center position-relative">
        <div class="hero-container position-relative z-1">
            <p class="hero-subtitle">Kapan Anda ingin memulai perjalanan?</p>
            
            <form id="searchForm" action="{{ url('/product') }}" method="GET" class="search-box shadow-lg text-center">
                
                <h6 class="fw-bold text-secondary mb-3 text-uppercase" style="letter-spacing: 1px;">Pilih Tanggal Sewa</h6>
                
                <div class="d-flex justify-content-center mb-3">
                    <div id="inline-calendar"></div>
                </div>
                
                <input type="hidden" name="start_date" id="start_date" required>
                <input type="hidden" name="end_date" id="end_date" required>
                
                <button type="submit" class="btn btn-primary btn-submit w-100 rounded-pill py-3 fw-bold fs-6 shadow-sm">
                    <i class="bi bi-search me-2"></i> Tampilkan Mobil Tersedia
                </button>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        // Inisialisasi Kalender Interaktif
        flatpickr("#inline-calendar", {
            inline: true,        
            mode: "range",       
            dateFormat: "Y-m-d",
            minDate: "today",    
            showMonths: 1,       // Menampilkan 1 bulan agar rapi di mobile
            onChange: function(selectedDates, dateStr, instance) {
                // Isi input tersembunyi hanya jika user sudah memilih TANGGAL MULAI dan TANGGAL SELESAI
                if (selectedDates.length === 2) {
                    document.getElementById('start_date').value = instance.formatDate(selectedDates[0], "Y-m-d");
                    document.getElementById('end_date').value = instance.formatDate(selectedDates[1], "Y-m-d");
                } else {
                    document.getElementById('start_date').value = "";
                    document.getElementById('end_date').value = "";
                }
            }
        });

        // Validasi: Cegah user menekan tombol cari jika belum memilih 2 tanggal
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            const start = document.getElementById('start_date').value;
            const end = document.getElementById('end_date').value;
            
            if (!start || !end) {
                e.preventDefault(); // Batalkan pengiriman form
                alert('Silakan pilih rentang tanggal (mulai dan selesai) pada kalender terlebih dahulu.');
            }
        });
    </script>
</body>
</html>