<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kendaraan - Adam Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; color: #333; }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&q=80&w=2000') center/cover;
            height: 250px; display: flex; align-items: center; justify-content: center; color: white; text-align: center;
        }
        .car-image-container img { width: 100%; border-radius: 8px; object-fit: cover; }
        .car-specs { display: flex; justify-content: space-between; background: white; padding: 15px; border-radius: 8px; border: 1px solid #e0e0e0; text-align: center; font-size: 0.85rem; }
        .car-specs .spec-item { display: flex; flex-direction: column; align-items: center; gap: 5px; }
        .car-specs .spec-item i { font-size: 1.2rem; color: #555; }
        .warning-box { background-color: #fffbea; border: 1px solid #fceca1; padding: 15px; border-radius: 8px; font-size: 0.8rem; color: #d97706; margin-bottom: 20px; }
        .section-card { background: white; border-radius: 8px; border: 1px solid #e0e0e0; padding: 20px; margin-bottom: 20px; }
        .section-title { font-weight: 600; font-size: 1rem; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .form-label { font-size: 0.85rem; font-weight: 500; }
        .form-control, .form-select { font-size: 0.9rem; border-radius: 6px; }
        .btn-green { background-color: #10b981; border-color: #10b981; color: white; font-weight: 600; transition: 0.3s; }
        .btn-green:hover:not(:disabled) { background-color: #059669; border-color: #059669; color: white; }
        .btn-green:disabled { background-color: #9ca3af; border-color: #9ca3af; cursor: not-allowed; }
        .price-summary { background-color: #e2e8f0; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 20px; }
        .price-summary h4 { font-weight: 700; margin: 0; color: #1e293b; }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="hero-section">
        <h1 class="fw-bold">Konfirmasi Booking</h1>
    </div>

    <div class="container py-5">
        
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payment.store') }}" method="POST" id="bookingForm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" id="product_price" value="{{ $product->price }}">

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="car-image-container mb-3">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $product->name }}">
                    </div>

                    <div class="car-specs mb-3">
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

                    <div class="warning-box">
                        <strong>PERINGATAN</strong><br>
                        MOHON SELALU LAKUKAN PENGECEKAN KENDARAAN SAAT SERAH TERIMA. KAMI TIDAK MENERIMA KOMPLAIN JIKA KENDARAAN SUDAH BERPINDAH TANGAN.
                    </div>

                    <div class="section-card">
                        <h4 class="fw-bold mb-1">{{ $product->name }}</h4>
                        <p class="text-muted small mb-3">{{ $product->brand }} {{ $product->model }}</p>
                        
                        <div class="small">
                            <p>{{ $product->description }}</p>
                            <p>* Gambar unit di aplikasi hanya ilustrasi, untuk real picture bisa hubungi customer service kami.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    
                    <div class="price-summary">
                        <div class="text-muted small mb-1">Total Harga</div>
                        <div class="small mb-1">Lokasi - {{ $product->location ?? 'Malang' }}</div>
                        <div class="small fw-semibold mb-2" id="date-summary">-</div>
                        <h4 id="display-total-price">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                    </div>

                    @php
                        $isProfileComplete = auth()->user()->ktp_file && auth()->user()->sim_file;
                    @endphp

                    <div class="section-card">
                        <div class="section-title">Kelengkapan Identitas</div>
                        @if($isProfileComplete)
                            <div class="alert alert-success d-flex align-items-center mb-0 p-3">
                                <i class="bi bi-check-circle-fill me-3 fs-3"></i>
                                <div>
                                    <strong>Data Tersimpan!</strong><br>
                                    <span class="small">Data KTP dan SIM Anda sudah terverifikasi dari profil.</span>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger d-flex align-items-center mb-0 p-3">
                                <i class="bi bi-exclamation-triangle-fill me-3 fs-3"></i>
                                <div class="w-100">
                                    <strong>Data Belum Lengkap!</strong><br>
                                    <span class="small">Anda belum melengkapi dokumen di profil.</span>
                                    <a href="{{ route('user.profile') }}" class="btn btn-sm btn-danger mt-2 w-100">Lengkapi Profil Sekarang</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="section-card">
                        <div class="section-title">Data Pemesan</div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor telepon / WA</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">+62</span>
                                <input type="text" class="form-control border-start-0" name="customer_contact" value="{{ old('customer_contact') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat Anda" required>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-title">Detail Sewa Mobil</div>
                        
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                value="{{ old('start_date', $startDate ?? now()->format('Y-m-d')) }}" 
                                min="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                value="{{ old('end_date', $endDate ?? now()->addDay()->format('Y-m-d')) }}" 
                                min="{{ now()->format('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi Mobil</label>
                            <input type="text" class="form-control" name="pickup_location" value="{{ old('pickup_location', $product->location) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pengambilan Mobil</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pickup_method" id="pickup_1" value="Ambil Sendiri" checked>
                                    <label class="form-check-label small" for="pickup_1">Ambil Sendiri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pickup_method" id="pickup_2" value="Diantar">
                                    <label class="form-check-label small" for="pickup_2">Diantar (Biaya Tambahan)</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pengembalian Mobil</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="return_method" id="return_1" value="Kembalikan Sendiri" checked>
                                    <label class="form-check-label small" for="return_1">Kembalikan Sendiri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="return_method" id="return_2" value="Diambil">
                                    <label class="form-check-label small" for="return_2">Diambil (Biaya Tambahan)</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Anda tahu Adam Rental darimana?</label>
                            <select class="form-select" name="source_info">
                                <option value="">Pilih Sumber</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Tiktok">Tiktok</option>
                                <option value="Teman">Teman</option>
                                <option value="Google">Google</option>
                            </select>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-title">Detail Pembayaran & Kontrak</div>
                        
                        <div class="d-flex justify-content-between mb-3 small">
                            <span id="price-calculation-text">Harga (1 hari)</span>
                            <span id="price-calculation-value">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-success">Pilih Metode Pembayaran</label>
                            <select class="form-select" name="payment_method" required>
                                <option value="transfer">Transfer Bank</option>
                                <option value="e_wallet">E-Wallet (OVO/GoPay/Dana)</option>
                                <option value="cash">Bayar Tunai</option>
                            </select>
                        </div>

                        <hr>
                        
                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total Harga</span>
                            <span id="final-total-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>

                        <div class="form-check bg-light border p-3 rounded mb-3">
                            <input class="form-check-input ms-0 me-2 border-secondary" type="checkbox" id="agree_terms" name="agree_terms" required>
                            <label class="form-check-label small fw-semibold text-dark" for="agree_terms" style="margin-left: 0.25rem;">
                                Saya telah membaca, mengerti, dan menyetujui seluruh <a href="{{ route('terms') }}" target="_blank" class="text-primary text-decoration-none">Syarat & Ketentuan (Kontrak Sewa)</a>.
                            </label>
                        </div>
                    </div>

                    <button type="submit" id="btn-submit-booking" class="btn btn-green btn-lg w-100 mb-2" disabled>
                        @if(!$isProfileComplete) Lengkapi Profil Dulu @else Pesan sekarang @endif
                    </button>
                    <p class="text-center text-muted" style="font-size: 0.75rem;">Diperlukan uang jaminan yang akan dikembalikan saat masa sewa berakhir.</p>

                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const productPrice = parseInt(document.getElementById('product_price').value);
            
            // Logika Persetujuan Kontrak Sewa (Checkbox)
            const agreeCheckbox = document.getElementById('agree_terms');
            const submitBtn = document.getElementById('btn-submit-booking');
            const isProfileComplete = {{ $isProfileComplete ? 'true' : 'false' }};

            if (agreeCheckbox && submitBtn) {
                agreeCheckbox.addEventListener('change', function() {
                    // Tombol hanya bisa ditekan jika profil (KTP/SIM) lengkap DAN checkbox dicentang
                    if (isProfileComplete) {
                        submitBtn.disabled = !this.checked;
                    }
                });
            }

            // Logika Penghitungan Harga
            function calculateTotal() {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                
                let days = 1;
                if (!isNaN(start.getTime()) && !isNaN(end.getTime())) {
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    days = diffDays > 0 ? diffDays : 1;
                }
                
                const total = productPrice * days;
                const formattedTotal = 'Rp ' + total.toLocaleString('id-ID');
                
                document.getElementById('display-total-price').textContent = formattedTotal;
                document.getElementById('final-total-price').textContent = formattedTotal;
                document.getElementById('price-calculation-text').textContent = `Harga (${days} hari)`;
                document.getElementById('price-calculation-value').textContent = formattedTotal;
                
                if (!isNaN(start.getTime()) && !isNaN(end.getTime())) {
                    const options = { day: 'numeric', month: 'short', year: 'numeric' };
                    document.getElementById('date-summary').textContent = 
                        start.toLocaleDateString('id-ID', options) + ' - ' + end.toLocaleDateString('id-ID', options);
                }
            }
            
            startDateInput.addEventListener('change', calculateTotal);
            endDateInput.addEventListener('change', calculateTotal);
            
            calculateTotal();
        });
    </script>
</body>
</html>