<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5f7fb;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 30px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            color: white;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .profile-info-item {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 4px solid #667eea;
        }

        .profile-info-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .profile-info-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 600;
        }

        .btn-group-custom {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary-custom:hover {
            background: #667eea;
            color: white;
            text-decoration: none;
        }



        /* NEW SIDEBAR LAYOUT STYLES */
        .profile-container {
            display: flex;
            gap: 30px;
            min-height: calc(100vh - 400px);
        }

        .sidebar-menu {
            background: white;
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            width: 280px;
            height: fit-content;
            /* Hapus position sticky dan align-self */
            z-index: 100;
        }

        .sidebar-profile {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            margin-bottom: 25px;
        }

        .sidebar-profile-photo {
            width: 140px;
            height: 140px;
            margin: 0 auto 15px;
            position: relative;
            display: inline-block;
        }

        .sidebar-profile-photo img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid #0066cc;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.2);
        }

        .sidebar-profile-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 5px;
        }

        .sidebar-profile-email {
            font-size: 0.9rem;
            color: #6c757d;
            word-break: break-word;
        }

        .sidebar-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu-item {
            margin: 0;
            padding: 0;
        }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: #212529;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .sidebar-menu-link:hover {
            background: #f0f0f0;
            color: #0066cc;
            transform: translateX(5px);
        }

        .sidebar-menu-link.active {
            background: #0066cc;
            color: white;
        }

        .sidebar-menu-link i {
            font-size: 1.2rem;
            min-width: 20px;
        }

        .content-area {
            flex: 1;
        }

        .profile-content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-tab-header {
            background: #0066cc;
            color: white;
            padding: 20px 30px;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .profile-content-inner {
            padding: 40px 30px;
        }

        .profile-row {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .profile-left-column {
            text-align: center;
            flex-shrink: 0;
        }

        .profile-main-photo {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            border-radius: 50%;
            border: 3px solid #0066cc;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.2);
        }

        .profile-name-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 8px;
        }

        .profile-email-display {
            font-size: 0.95rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .profile-right-column {
            flex: 1;
        }

        .profile-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-info-box {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #0066cc;
        }

        .profile-info-box-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .profile-info-box-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 600;
        }

        .profile-bio-section {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #0066cc;
            margin-bottom: 30px;
        }

        .profile-bio-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .profile-bio-value {
            font-size: 1rem;
            color: #212529;
            line-height: 1.5;
        }

        .profile-action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-profile-action {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-profile-edit {
            background: #0066cc;
            color: white;
        }

        .btn-profile-edit:hover {
            background: #0052a3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 102, 204, 0.3);
            color: white;
        }

        @media (max-width: 1024px) {
            .profile-container {
                flex-direction: column;
            }

            .sidebar-menu {
                width: 100%;
                position: static;
            }

            .profile-row {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-right-column {
                width: 100%;
            }

            .profile-info-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .profile-info {
                grid-template-columns: 1fr;
            }

            .profile-card {
                padding: 20px;
            }

            .btn-group-custom {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                text-align: center;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .profile-content-inner {
                padding: 20px;
            }

            .profile-tab-header {
                padding: 15px 20px;
            }

            #editProfileModal {
                overflow-y: auto !important;
            }

            #editProfileModal .modal-dialog {
                max-height: calc(100vh - 60px) !important;
                margin-top: 30px !important;
                margin-bottom: 30px !important;
            }

            #editProfileModal .modal-content {
                max-height: 100% !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
            }

            #editProfileModal .modal-body {
                overflow-y: auto !important;
                flex: 1 1 auto !important;
            }

            body.modal-open {
                overflow: hidden !important;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    @include('layouts.navbar')
    <!-- Hero -->
    <div class="container mb-4">
        <div class="hero-section text-white text-center shadow-sm" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)),
            url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
            border-radius: 20px; padding: 60px 20px;">

            <h1 class="fw-bold">Profil Saya</h1>
            <p class="text-white-50">Kelola akun dan informasi pribadi kamu</p>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container mb-5">
        <div class="profile-container">
            <!-- SIDEBAR -->
            <div class="sidebar-menu">
                <!-- SIDEBAR PROFILE -->
                <div class="sidebar-profile">
                    <div class="sidebar-profile-photo">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . $user->name }}"
                            alt="{{ $user->name }}">
                    </div>
                    <div class="sidebar-profile-name">{{ $user->name }}</div>
                    <div class="sidebar-profile-email">{{ $user->email }}</div>

                    @if(!empty($user->alamat) && !empty($user->ktp_file) && !empty($user->sim_file))
                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="bi bi-patch-check-fill me-1"></i>
                            Akun Terverifikasi</span>
                    @else
                        <span class="badge bg-secondary rounded-pill px-3 py-2"><i class="bi bi-info-circle-fill me-1"></i>
                            Belum Terverifikasi</span>
                    @endif
                </div>

                <!-- SIDEBAR MENU -->
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.profile') }}" class="sidebar-menu-link active">
                            <i class="bi bi-person-fill"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.rental-history') }}" class="sidebar-menu-link">
                            <i class="bi bi-clock-history"></i>
                            <span>Riwayat Sewa</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- CONTENT AREA -->
            <div class="content-area">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(empty($user->alamat) || empty($user->ktp_file) || empty($user->sim_file))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert"
                        style="border-radius: 10px;">
                        <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-warning"></i>
                        <div>
                            <strong>Profil Belum Lengkap!</strong><br>
                            Harap lengkapi Alamat, KTP, dan SIM Anda agar dapat melakukan transaksi penyewaan mobil.
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="profile-content-card">
                    <div class="profile-tab-header">
                        Informasi Detail Profil
                    </div>

                    <div class="profile-content-inner">
                        <div class="profile-row">


                            <div class="profile-right-column">
                                <div class="profile-info-row">
                                    <div class="profile-info-box">
                                        <div class="profile-info-box-label">Total Booking</div>
                                        <div class="profile-info-box-value">{{ $user->bookings->count() ?? 0 }}</div>
                                    </div>

                                    <div class="profile-info-box">
                                        <div class="profile-info-box-label">Bergabung Sejak</div>
                                        <div class="profile-info-box-value">{{ $user->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-bio-section">
                                    <div class="profile-bio-label">Alamat Lengkap</div>
                                    <div class="profile-bio-value">
                                        @if(!empty($user->alamat))
                                            {{ $user->alamat }}
                                        @else
                                            <span class="text-danger fst-italic"><i class="bi bi-x-circle me-1"></i> Belum
                                                diisi</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="profile-info-row" style="margin-top: -15px;">
                                    <div class="profile-info-box">
                                        <div class="profile-info-box-label">Dokumen KTP</div>
                                        <div class="profile-info-box-value fs-6 mt-1">
                                            @if(!empty($user->ktp_file))
                                                <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>
                                                    Terupload</span>
                                                <a href="{{ asset('storage/' . $user->ktp_file) }}" target="_blank"
                                                    class="badge bg-primary ms-2 text-decoration-none">Lihat</a>
                                            @else
                                                <span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i>
                                                    Kosong</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="profile-info-box">
                                        <div class="profile-info-box-label">Dokumen SIM A</div>
                                        <div class="profile-info-box-value fs-6 mt-1">
                                            @if(!empty($user->sim_file))
                                                <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>
                                                    Terupload</span>
                                                <a href="{{ asset('storage/' . $user->sim_file) }}" target="_blank"
                                                    class="badge bg-primary ms-2 text-decoration-none">Lihat</a>
                                            @else
                                                <span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i>
                                                    Kosong</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-bio-section">
                                    <div class="profile-bio-label">Bio / Catatan</div>
                                    <div class="profile-bio-value">
                                        @if(!empty($user->bio))
                                            {{ $user->bio }}
                                        @else
                                            <span class="text-muted fst-italic">Belum ada bio</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="profile-action-buttons mt-4">
                                    <button class="btn-profile-action btn-profile-edit w-100" data-bs-toggle="modal"
                                        data-bs-target="#editProfileModal">
                                        <i class="bi bi-pencil-square me-2"></i>
                                        @if(empty($user->alamat) || empty($user->ktp_file) || empty($user->sim_file))
                                            Lengkapi Data Sekarang
                                        @else
                                            Edit Profil
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- FOOTER SECTION -->
    @include('layouts.footer')


    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- MODAL TENTANG KAlas-->
    <div class="modal fade" id="aboutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tentang Kami</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold mb-3">Visi Kami</h6>
                    <p>Menjadi platform penyewaan kendaraan nomor satu di Indonesia dengan memberikan layanan terbaik
                        dan terpercaya.</p>

                    <h6 class="fw-bold mb-3 mt-4">Misi Kami</h6>
                    <ul>
                        <li>Menyediakan kendaraan berkualitas tinggi dengan harga terjangkau</li>
                        <li>Memberikan layanan pelanggan yang responsif dan profesional</li>
                        <li>Memastikan pengalaman sewa yang aman dan nyaman</li>
                        <li>Inovasi berkelanjutan dalam teknologi dan layanan</li>
                    </ul>

                    <h6 class="fw-bold mb-3 mt-4">Mengapa Memilih Kami?</h6>
                    <ul>
                        <li>✅ Armada kendaraan terlengkap dan terawat</li>
                        <li>✅ Harga kompetitif dengan berbagai paket</li>
                        <li>✅ Proses booking mudah dan cepat</li>
                        <li>✅ Asuransi komprehensif tersedia</li>
                        <li>✅ Customer support 24/7</li>
                        <li>✅ Lokasi pickup di berbagai kota</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel"><i class="bi bi-pencil-square me-2"></i>Lengkapi
                        / Ubah Data Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ auth()->user()->name }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="photo" class="form-label fw-bold">Foto Profil</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                <small class="text-muted">Format: JPG, JPEG, PNG (Maks 2MB)</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label fw-bold">Bio / Catatan Singkat</label>
                            <textarea class="form-control" id="bio" name="bio" rows="2"
                                placeholder="Ceritakan sedikit tentang Anda...">{{ auth()->user()->bio }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required
                                placeholder="Alamat sesuai KTP...">{{ auth()->user()->alamat }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ktp_file" class="form-label fw-bold">Upload KTP (Untuk Verifikasi
                                    Rental)</label>
                                <input type="file" class="form-control" id="ktp_file" name="ktp_file" accept="image/*">
                                @if(auth()->user()->ktp_file)
                                    <small class="text-success"><i class="bi bi-check-circle-fill"></i> KTP Sudah
                                        Terupload</small>
                                @else
                                    <small class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> KTP Belum
                                        Diupload</small>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sim_file" class="form-label fw-bold">Upload SIM A</label>
                                <input type="file" class="form-control" id="sim_file" name="sim_file" accept="image/*">
                                @if(auth()->user()->sim_file)
                                    <small class="text-success"><i class="bi bi-check-circle-fill"></i> SIM Sudah
                                        Terupload</small>
                                @else
                                    <small class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> SIM Belum
                                        Diupload</small>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>