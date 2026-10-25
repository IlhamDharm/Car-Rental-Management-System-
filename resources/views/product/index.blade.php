<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rental Mobil</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            padding-top: 90px;
        }

        .hero {
            background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
            height: 300px;
            border-radius: 15px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .search-box {
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .card img {
            height: 180px;
            object-fit: cover;
        }

        .badge-save {
            background: #d4f5e9;
            color: green;
        }

        .card-img-hover {
            overflow: hidden;
            border-radius: 8px;
        }

        .card-img-hover img {
            transition: transform 0.3s ease;
        }

        .card-img-hover:hover img {
            transform: scale(1.1);
        }
    </style>
    <!-- NAVBAR -->
    @include('layouts.navbar')

</head>

<body class="bg-light">

    <div class="container py-4">

        <!-- ALERT ERROR -->
        @if ($errors->any() || session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>⚠️ Perhatian!</strong>
                {{ session('error') ?? $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- HERO -->
        <div class="hero mb-4">
            <h1 class="fw-bold">Adam Rental</h1>
            <p>Rental Mobil Terpercaya se Kota Malang dan Surabaya</p>

            <!-- SEARCH -->
            <form method="GET" class="search-box w-75">
                <select name="location" class="form-select">
                    <option value="">Pilih Lokasi</option>

                    @foreach ($locations as $location)
                        <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="min_price" class="form-control" placeholder="Min Harga">
                <input type="number" name="max_price" class="form-control" placeholder="Max Harga">

                <select name="sort" class="form-select">
                    <option value="">Sort</option>
                    <option value="cheapest">Termurah</option>
                    <option value="expensive">Termahal</option>
                </select>

                <button class="btn btn-dark px-4 rounded-pill">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- FILTER CATEGORY -->
        <div class="mb-4 d-flex gap-2">

            <a href="{{ url('/product') }}" class="btn btn-sm {{ !request('type') ? 'btn-dark' : 'btn-outline-dark' }}">
                All
            </a>

            @foreach($types as $type)
                <a href="?type={{ urlencode($type) }}"
                    class="btn btn-sm {{ request('type') == $type ? 'btn-dark' : 'btn-outline-dark' }}">
                    {{ $type }}
                </a>
            @endforeach

        </div>

        <!--  LIST MOBIL -->
        <div class="row g-4">
            @forelse($products as $product)
                @php
                    $productImage = collect($product->images ?? [])->filter()->first() ?? $product->image;
                @endphp
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0">

                                <div class="card-img-hover">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ $productImage ? asset('storage/' . $productImage) : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=800' }}" class="card-img-top" alt="{{ $product->name }}">
                                    </a>
                                </div>

                                <div class="card-body">

                                    <h6 class="fw-bold">{{ $product->name }}</h6>

                                    <small class="text-muted">
                                        {{ $product->type }} {{ $product->location }}
                                    </small>

                                    <div class="mt-2">

                                        <div class="d-flex align-items-center gap-1">
                                            <strong class="fs-6 mb-0">
                                                Rp {{ number_format($product->price) }}
                                            </strong>
                                            <small class="text-muted mb-0">/ hari</small>
                                        </div>

                                    </div>


                                    <!-- BUTTON BOOKING -->
                                    <div class="d-grid mt-3">
                                        <a href="{{ route('payment.index', [
                    'product_id' => $product->id,
                    'start_date' => request('start_date'),
                    'end_date' => request('end_date')
                ]) }}" class="btn btn-primary btn-sm">
                                            Booking Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
            @empty
                <p>Tidak ada mobil ditemukan.</p>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-4">
            {{ $products->withQueryString()->links() }}
        </div>

    </div>
    <!-- Bootstrap JS (WAJIB untuk dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>