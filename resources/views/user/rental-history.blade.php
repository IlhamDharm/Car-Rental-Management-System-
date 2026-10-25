<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background: #f5f7fb; }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
            color: white; padding: 60px 20px; margin-bottom: 30px; border-radius: 20px; text-align: center; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        .rental-card {
            background: white; border-radius: 15px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #667eea; transition: all 0.3s ease;
        }
        .rental-card:hover { transform: translateY(-3px); box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12); }
        .rental-details { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px; mt-3; }
        .detail-item { padding: 15px; background: #f8f9fa; border-radius: 10px; border-left: 3px solid #667eea; }
        .detail-label { font-size: 0.85rem; color: #6c757d; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 5px; font-weight: 600; }
        .detail-value { font-size: 1.1rem; color: #212529; font-weight: 600; }
        .detail-value.price { color: #667eea; font-size: 1.3rem; }
        .empty-state { text-align: center; padding: 60px 20px; background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08); }
        .btn-custom { padding: 10px 20px; border-radius: 10px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: none; cursor: pointer; font-size: 0.9rem; }
        .btn-primary-custom { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-secondary-custom { background: white; color: #667eea; border: 2px solid #667eea; }
    </style>
</head>
<body>

    @include('layouts.navbar')

    <div class="container mb-4 mt-5 pt-4">
        <div class="hero-section">
            <h1 class="fw-bold"><i class="bi bi-clock-history"></i> Riwayat Booking</h1>
            <p class="text-white-50 mb-0">Kelola dan lihat detail semua penyewaan Anda</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">

                @if ($bookings->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-inbox" style="font-size: 60px; color: #ddd;"></i>
                        <h3 class="fw-bold mt-3 mb-2">Belum Ada Riwayat Sewa</h3>
                        <p class="text-muted mb-4">Anda belum melakukan penyewaan mobil. Mulai sewa mobil favorit Anda sekarang!</p>
                        <a href="{{ url('/product') }}" class="btn-custom btn-primary-custom">
                            <i class="bi bi-car-front"></i> Sewa Mobil Sekarang
                        </a>
                    </div>
                @else
                    @foreach ($bookings as $booking)
                        <div class="rental-card">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                <div>
                                    <div class="fs-4 fw-bold text-dark mb-1">
                                        <i class="bi bi-car-front text-primary"></i> 
                                        {{ $booking->product->brand ?? 'N/A' }} {{ $booking->product->model ?? '' }}
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar-event"></i> Tanggal Order: {{ $booking->created_at->format('d M Y') }}
                                    </div>
                                </div>
                                
                                <div>
                                    @php
                                        $statusColor = match($booking->rental_status) {
                                            'Menunggu Konfirmasi' => 'bg-warning text-dark',
                                            'Telah Dikonfirmasi' => 'bg-primary text-white',
                                            'Pengembalian Dalam Proses' => 'bg-info text-dark',
                                            'Pengembalian Berhasil' => 'bg-success text-white',
                                            'Dibatalkan' => 'bg-danger text-white',
                                            default => 'bg-secondary text-white'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusColor }} px-3 py-2 rounded-pill fs-6 shadow-sm">
                                        {{ $booking->rental_status }}
                                    </span>
                                </div>
                            </div>

                            <hr>

                            <div class="rental-details">
                                <div class="detail-item">
                                    <div class="detail-label"><i class="bi bi-calendar2-event"></i> Durasi Sewa</div>
                                    <div class="detail-value">{{ $booking->duration }} Hari</div>
                                    <div class="small text-muted mt-1">{{ $booking->start_date->format('d M') }} s/d {{ $booking->end_date->format('d M Y') }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label"><i class="bi bi-geo-alt"></i> Pengambilan</div>
                                    <div class="detail-value">{{ $booking->pickup_method }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label"><i class="bi bi-credit-card"></i> Pembayaran</div>
                                    <div class="detail-value text-uppercase">{{ $booking->payment_method }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label"><i class="bi bi-cash"></i> Total Harga</div>
                                    <div class="detail-value price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            @if($booking->video_sebelum || $booking->video_sesudah)
                            <div class="mt-3 bg-light p-3 rounded border">
                                <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-camera-video"></i> Dokumentasi Kendaraan (Admin)</h6>
                                <div class="row g-2">
                                    @if($booking->video_sebelum)
                                        <div class="col-md-6">
                                            <a href="{{ asset('storage/' . $booking->video_sebelum) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                                <i class="bi bi-play-circle"></i> Lihat Video Sebelum Rental
                                            </a>
                                        </div>
                                    @endif
                                    @if($booking->video_sesudah)
                                        <div class="col-md-6">
                                            <a href="{{ asset('storage/' . $booking->video_sesudah) }}" target="_blank" class="btn btn-outline-success btn-sm w-100">
                                                <i class="bi bi-play-circle"></i> Lihat Video Sesudah Rental
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                        </div>
                    @endforeach

                    <div class="mt-4">
                        <a href="{{ route('user.profile') }}" class="btn-custom btn-secondary-custom">
                            <i class="bi bi-arrow-left"></i> Kembali ke Profil
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>