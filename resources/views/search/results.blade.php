<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-light: rgba(13, 110, 253, 0.08);
            --bg-color: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --card-shadow: 0 10px 30px rgba(30, 41, 59, 0.04);
            --hover-shadow: 0 15px 35px rgba(13, 110, 253, 0.1);
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-dark);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            padding-top: 90px;
        }

        /* Search Hero Card */
        .search-hero {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 24px;
            padding: 40px;
            color: white;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
            position: relative;
            overflow: hidden;
        }

        .search-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .search-hero h3 {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        /* Product Cards */
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            border-radius: 20px !important;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            border-color: rgba(13, 110, 253, 0.2) !important;
        }

        /* Navigation elements list items */
        .element-card {
            transition: all 0.2s ease;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            border-radius: 16px !important;
        }

        .element-card:hover {
            transform: scale(1.02);
            box-shadow: var(--hover-shadow);
            border-color: rgba(13, 110, 253, 0.2) !important;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        /* Tabs and Filters */
        .tab-btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.2s ease;
            color: var(--text-muted);
            border: 1px solid transparent;
        }

        .tab-btn.active {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        .tab-btn:hover:not(.active) {
            background-color: rgba(13, 110, 253, 0.05);
            color: var(--primary-color);
        }

        /* Help Alert */
        .help-card {
            border-radius: 18px;
            background: white;
            border-left: 5px solid #0dcaf0 !important;
            box-shadow: var(--card-shadow);
        }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
            background: white;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
        }
    </style>
</head>
<body>  
@include('layouts.navbar') 

<div class="container mb-5">
    <!-- Hero Section -->
    <div class="search-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Hasil Pencarian</span>
                <h3 class="mb-2">Menampilkan hasil untuk "{{ $keyword }}"</h3>
                <p class="text-white-50 mb-0">Ditemukan {{ $products->count() }} produk yang cocok dan {{ count($matchedElements) }} tautan halaman website.</p>
            </div>
            <div class="col-lg-4 mt-3 mt-lg-0">
                <form action="{{ url('/search') }}" method="GET" class="input-group">
                    <input type="text" name="q" value="{{ $keyword }}" class="form-control border-0 bg-white bg-opacity-10 text-white rounded-start-pill px-4 py-3" placeholder="Cari produk atau halaman..." style="backdrop-filter: blur(10px);">
                    <button class="btn btn-primary rounded-end-pill px-4" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="row">
        <!-- Sidebar Navigation & Help -->
        <div class="col-lg-4 mb-4 order-lg-1">
            <!-- Sidebar Card: Navigasi Website -->
            <div class="card border-0 shadow-sm p-4 rounded-4 mb-4 bg-white">
                <h5 class="fw-bold mb-3 text-dark d-flex align-items-center">
                    <i class="bi bi-compass text-primary me-2"></i> Navigasi Website
                </h5>
                <p class="text-muted small mb-4">Halaman atau fitur website yang berhubungan dengan kata kunci pencarian Anda.</p>

                @if(count($matchedElements) > 0)
                    <div class="d-flex flex-column gap-3">
                        @foreach($matchedElements as $element)
                            <div class="card element-card border-0 p-3 shadow-none bg-light">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-box flex-shrink-0">
                                        <i class="bi {{ $element['icon'] }} fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.95rem;">{{ $element['title'] }}</h6>
                                        <p class="text-muted mb-0 text-truncate-2 small">{{ $element['description'] }}</p>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <a href="{{ $element['url'] }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                        Buka <i class="bi bi-arrow-right-short ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 bg-light rounded-4 border border-dashed">
                        <i class="bi bi-compass text-muted fs-3"></i>
                        <p class="text-muted small mt-2 mb-0">Tidak ada halaman yang cocok.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar Card: Bantuan / Tips -->
            @if(count($helpTopics) > 0)
                <div class="card help-card border-0 p-4 rounded-4 mb-4">
                    <h5 class="fw-bold mb-3 text-info d-flex align-items-center">
                        <i class="bi bi-lightbulb-fill me-2"></i> Tips & Bantuan
                    </h5>
                    <ul class="ps-3 mb-0 text-secondary small">
                        @foreach($helpTopics as $help)
                            <li class="mb-2">{{ $help }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Products Grid -->
        <div class="col-lg-8 order-lg-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0 d-flex align-items-center">
                    <i class="bi bi-box-seam-fill text-primary me-2"></i> Produk Terkait
                </h5>
                <span class="badge bg-light text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold">{{ $products->count() }} Mobil Ditemukan</span>
            </div>

            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-6 col-sm-12">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white">
                                <div class="position-relative">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height: 200px;">
                                            <i class="bi bi-image fs-1 text-secondary"></i>
                                        </div>
                                    @endif
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-dark rounded-pill px-3 py-2 fs-7" style="font-size: 0.75rem;">
                                        {{ $product->type }}
                                    </span>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-dark mb-0">{{ $product->name }}</h5>
                                        <span class="badge bg-secondary ms-2" style="font-size: 0.7rem;">SKU: {{ $product->sku }}</span>
                                    </div>
                                    <p class="text-muted small mb-3"><i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $product->location }}</p>
                                    
                                    <p class="text-muted small mb-3 text-truncate-2">{{ Str::limit($product->description, 90) }}</p>

                                    <!-- Specs Grid -->
                                    <div class="row g-2 mb-4 bg-light p-3 rounded-3 text-center">
                                        <div class="col-4">
                                            <small class="text-muted d-block" style="font-size: 0.65rem;">Transmisi</small>
                                            <span class="fw-semibold text-dark" style="font-size: 0.8rem;"><i class="bi bi-gear text-primary me-1"></i>{{ $product->transmission }}</span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block" style="font-size: 0.65rem;">Kapasitas</small>
                                            <span class="fw-semibold text-dark" style="font-size: 0.8rem;"><i class="bi bi-people text-primary me-1"></i>{{ $product->capacity }} seat</span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block" style="font-size: 0.65rem;">Bahan Bakar</small>
                                            <span class="fw-semibold text-dark text-truncate d-block" style="font-size: 0.8rem;" title="{{ $product->fuel_type }}"><i class="bi bi-fuel-pump text-primary me-1"></i>{{ $product->fuel_type }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Price & Booking -->
                                    <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                        <div>
                                            <small class="text-muted d-block" style="font-size: 0.7rem;">Harga Sewa</small>
                                            <span class="fs-5 fw-bold text-success">Rp {{ number_format($product->price, 0, ',', '.') }}<span class="fs-7 fw-normal text-muted" style="font-size: 0.75rem;">/hari</span></span>
                                        </div>
                                        <a href="{{ route('payment.index', ['product_id' => $product->id]) }}" class="btn btn-primary rounded-pill px-3 py-2 fw-semibold" style="font-size: 0.85rem;">
                                            Booking Now <i class="bi bi-arrow-right-short ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state text-center border">
                    <span class="display-3 d-block mb-3">🧐</span>
                    <h4 class="fw-bold text-dark">Tidak Ada Produk yang Cocok</h4>
                    <p class="text-muted max-width-500 mx-auto mb-4">Kami tidak dapat menemukan produk sewa mobil yang cocok dengan "{{ $keyword }}". Coba kata kunci lain seperti "Toyota", "Surabaya", "Manual", atau "Bensin".</p>
                    <a href="{{ url('/product') }}" class="btn btn-outline-primary rounded-pill px-4">
                        Lihat Semua Produk
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
