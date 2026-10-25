<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Detail Mobil</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            color: #333;
            padding-top: 90px;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
                url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&q=80&w=2000')
                center/cover;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-section h1 {
            font-weight: 700;
            font-size: 2.5rem;
        }

        .car-image-container img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .car-specs {
            display: flex;
            justify-content: space-between;
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            text-align: center;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .car-specs .spec-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .car-specs .spec-item i {
            font-size: 1.5rem;
            color: #000;
        }

        .car-specs .spec-item b {
            color: #1e293b;
            font-size: 0.95rem;
        }

        .warning-box {
            background-color: #fffbea;
            border: 1px solid #fceca1;
            padding: 15px;
            border-radius: 8px;
            font-size: 0.8rem;
            color: #d97706;
            margin-bottom: 20px;
        }

        .section-card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 15px;
            border-bottom: 2px solid #10b981;
            padding-bottom: 10px;
            color: #1e293b;
        }

        .car-name {
            font-weight: 700;
            font-size: 1.5rem;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .car-subtitle {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .car-description {
            font-size: 0.9rem;
            line-height: 1.6;
            color: #555;
        }

        .price-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        .price-label {
            font-size: 0.85rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .price-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .price-period {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .feature-item {
            background: #f0fdf4;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #10b981;
        }

        .feature-item i {
            font-size: 1rem;
        }

        .btn-booking {
            background-color: #10b981;
            border: none;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 6px;
            font-size: 1rem;
            transition: 0.3s;
        }

        .btn-booking:hover {
            background-color: #059669;
            color: white;
            text-decoration: none;
        }

        .availability-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .availability-badge.available {
            background-color: #d1fae5;
            color: #10b981;
        }

        .availability-badge.unavailable {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .feature-list {
                grid-template-columns: 1fr;
            }

            .car-specs {
                flex-wrap: wrap;
            }

            .car-specs .spec-item {
                flex: 0 0 48%;
            }

            .price-amount {
                font-size: 1.8rem;
            }
        }
    </style>
    <!-- NAVBAR -->
    @include('layouts.navbar')
</head>

<body class="bg-light">

    @php
        $productImages = collect($product->images ?? [])->filter();

        if ($productImages->isEmpty() && $product->image) {
            $productImages = collect([$product->image]);
        }
    @endphp

    <div class="hero-section">
        <h1 class="fw-bold">Detail Kendaraan</h1>
    </div>

    <div class="container py-5">
        <form>
            <div class="row g-4">
                <!-- LEFT COLUMN - CAR IMAGE -->
                <div class="col-lg-6">
                    @if ($productImages->isNotEmpty())
                        <div id="carouselCar" class="carousel slide car-image-container mb-3" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($productImages as $index => $image)
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="Foto {{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            @if ($productImages->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCar"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselCar"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="car-image-container mb-3">
                            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1200" alt="{{ $product->name }}">
                        </div>
                    @endif

                    <!-- SPECS -->
                    <div class="car-specs">
                        <div class="spec-item">
                            <i class="bi bi-car-front"></i>
                            <span>Tipe<br><b>{{ $product->type ?? 'Auto' }}</b></span>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-fuel-pump"></i>
                            <span>Bahan Bakar<br><b>{{ $product->fuel_type ?? 'Bensin' }}</b></span>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-people"></i>
                            <span>Kapasitas<br><b>{{ $product->capacity ?? '4' }} Kursi</b></span>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-gear"></i>
                            <span>Transmisi<br><b>{{ $product->transmission ?? 'Auto' }}</b></span>
                        </div>
                    </div>

                    <!-- WARNING BOX -->
                    <div class="warning-box">
                        <strong><i class="bi bi-exclamation-triangle"></i> PERINGATAN</strong><br>
                        MOHON SELALU LAKUKAN PENGECEKAN KENDARAAN SAAT SERAH TERIMA. KAMI TIDAK MENERIMA KOMPLAIN JIKA
                        KENDARAAN SUDAH BERPINDAH TANGAN.
                    </div>

                    <!-- INFO CARD -->
                    <div class="section-card">
                        <h4 class="car-name">{{ $product->name }}</h4>
                        <p class="car-subtitle">
                            <i class="bi bi-tag"></i> {{ $product->brand }} {{ $product->model }}
                        </p>
                        <p class="car-description">{{ $product->description }}</p>
                        <small class="text-muted d-block mt-2">* Gambar unit di aplikasi hanya ilustrasi, untuk real
                            picture bisa hubungi customer service kami.</small>
                    </div>
                </div>

                <!-- RIGHT COLUMN - DETAILS -->
                <div class="col-lg-6">
                    <!-- PRICE SECTION -->
                    <div class="price-section">
                        <div class="price-label">Harga Sewa</div>
                        <div class="price-amount">Rp {{ number_format($product->price) }}</div>
                        <div class="price-period">per hari</div>
                    </div>

                    <!-- AVAILABILITY -->
                    @if ($product->stock > 0)
                        <span class="availability-badge available">
                            <i class="bi bi-check-circle"></i> Tersedia ({{ $product->stock }} unit)
                        </span>
                    @else
                        <span class="availability-badge unavailable">
                            <i class="bi bi-x-circle"></i> Tidak Tersedia
                        </span>
                    @endif

                    <!-- DETAIL SPECS CARD -->
                    <div class="section-card">
                        <h5 class="section-title">Spesifikasi Teknis</h5>

                        @if ($product->tahun || $product->warna || $product->kapasitas_mesin || $product->plat_nomor || $product->transmission || $product->fuel_type)
                            <div class="row g-3">
                                @if ($product->tahun)
                                    <div class="col-6">
                                        <div class="small text-muted">Tahun Produksi</div>
                                        <div class="fw-bold">{{ $product->tahun }}</div>
                                    </div>
                                @endif

                                @if ($product->warna)
                                    <div class="col-6">
                                        <div class="small text-muted">Warna</div>
                                        <div class="fw-bold">{{ $product->warna }}</div>
                                    </div>
                                @endif

                                @if ($product->kapasitas_mesin)
                                    <div class="col-6">
                                        <div class="small text-muted">Kapasitas Mesin</div>
                                        <div class="fw-bold">{{ $product->kapasitas_mesin }} CC</div>
                                    </div>
                                @endif

                                @if ($product->capacity)
                                    <div class="col-6">
                                        <div class="small text-muted">Kapasitas Penumpang</div>
                                        <div class="fw-bold">{{ $product->capacity }} Orang</div>
                                    </div>
                                @endif

                                @if ($product->plat_nomor)
                                    <div class="col-12">
                                        <div class="small text-muted">Plat Nomor</div>
                                        <div class="fw-bold">{{ $product->plat_nomor }}</div>
                                    </div>
                                @endif

                                @if ($product->transmission)
                                    <div class="col-6">
                                        <div class="small text-muted">Transmisi</div>
                                        <div class="fw-bold">{{ $product->transmission }}</div>
                                    </div>
                                @endif

                                @if ($product->fuel_type)
                                    <div class="col-6">
                                        <div class="small text-muted">Bahan Bakar</div>
                                        <div class="fw-bold">{{ $product->fuel_type }}</div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="alert alert-info small">
                                Data spesifikasi detail belum tersedia.
                            </div>
                        @endif
                    </div>

                    <!-- FITUR CARD -->
                    @if ($product->fitur && count($product->fitur) > 0)
                        <div class="section-card">
                            <h5 class="section-title">Fitur & Fasilitas</h5>
                            <div class="feature-list">
                                @foreach ($product->fitur as $fitur)
                                    <div class="feature-item">
                                        <i class="bi bi-check"></i>
                                        <span>{{ $fitur }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- KONDISI CARD -->
                    @if ($product->kondisi)
                        <div class="section-card">
                            <h5 class="section-title">Kondisi Kendaraan</h5>
                            <p class="small">{{ $product->kondisi }}</p>
                        </div>
                    @endif

                    <!-- BOOKING BUTTON -->
                    @if ($product->stock > 0)
                        <div class="d-grid gap-2">
                            <a href="{{ route('payment.index', ['product_id' => $product->id]) }}"
                                class="btn btn-booking btn-lg">
                                <i class="bi bi-calendar-check"></i> LANJUT KE PEMBAYARAN
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning text-center">
                            <i class="bi bi-info-circle"></i> Mobil ini tidak tersedia. Hubungi kami untuk informasi lebih
                            lanjut.
                        </div>
                    @endif

                    <!-- LOCATION INFO -->
                    <div class="section-card mt-3">
                        <h5 class="section-title">Lokasi Pengambilan</h5>
                        <p class="small">
                            <i class="bi bi-geo-alt"></i> <strong>{{ $product->location }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>