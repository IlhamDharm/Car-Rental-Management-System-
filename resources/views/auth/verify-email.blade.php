<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Verifikasi Akun - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/global-animations.css') }}">
    <script src="{{ asset('js/global-transitions.js') }}"></script>

    <style>
        body {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 80px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
        }

        .navbar-brand {
            color: #2563eb !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .verify-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .verify-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .verify-icon {
            font-size: 4.5rem;
            margin-bottom: 20px;
        }

        .icon-pending {
            color: #f59e0b;
            animation: pulse 2s infinite;
        }

        .icon-rejected {
            color: #ef4444;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .verify-header h2 {
            color: #212529;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .verify-body {
            color: #4b5563;
            font-size: 1.05rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-action {
            width: 100%;
            padding: 12px;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .btn-pending:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(217, 119, 6, 0.4);
            color: white;
        }

        .btn-rejected {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .btn-rejected:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(220, 38, 38, 0.4);
            color: white;
        }

        .btn-logout {
            background: transparent;
            border: 2px solid #e5e7eb;
            color: #4b5563;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-logout:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
            color: #1f2937;
        }

        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 25px;
            text-align: left;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    @include('layouts.navbar')

    <!-- VERIFY CONTAINER -->
    <div class="verify-container">
        <div class="verify-card">

            @php
                $status = Auth::user()->verification_status ?? 'pending';
            @endphp

            @if ($status === 'pending')
                <!-- PENDING STATUS -->
                <div class="verify-icon icon-pending">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div class="verify-header">
                    <h2>Akun Sedang Ditinjau</h2>
                </div>

                <div class="verify-body">
                    <p>Terima kasih telah mendaftar! Dokumen KTP, SIM A, dan alamat Anda saat ini sedang diperiksa secara manual oleh Admin kami.</p>
                    <p class="text-muted small">Proses verifikasi ini biasanya membutuhkan waktu beberapa menit. Anda dapat melihat status verifikasi Anda setelah akun Anda disetujui atau ditolak.</p>
                </div>

                <!-- REFRESH BUTTON -->
                <a href="{{ url('/email/verify') }}" class="btn-action btn-pending">
                    <i class="bi bi-arrow-clockwise"></i> Perbarui Status Halaman
                </a>
            @elseif ($status === 'rejected')
                <!-- REJECTED STATUS -->
                <div class="verify-icon icon-rejected">
                    <i class="bi bi-x-circle-fill"></i>
                </div>

                <div class="verify-header">
                    <h2>Verifikasi Ditolak</h2>
                </div>

                <div class="verify-body">
                    <p class="text-danger font-weight-bold">Mohon maaf, dokumen atau data profil yang Anda unggah tidak memenuhi syarat kami.</p>
                    <p class="text-muted small">Silakan periksa kotak masuk email Anda (<strong>{{ Auth::user()->email }}</strong>) untuk melihat detail alasan penolakan dan cara mengajukan verifikasi ulang.</p>
                </div>

                <a href="mailto:admin@adamrental.com" class="btn-action btn-rejected">
                    <i class="bi bi-envelope-fill"></i> Hubungi Dukungan Admin
                </a>
            @endif

            <!-- LOGOUT FORM -->
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar (Logout)
                </button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
