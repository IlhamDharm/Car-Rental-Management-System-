
<link rel="stylesheet" href="{{ asset('css/global-animations.css') }}">
<script src="{{ asset('js/global-transitions.js') }}"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 fixed-top py-2">
<div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/home') }}">
            <i class="bi bi-car-front fs-4 text-primary"></i> Adam Rental
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse align-items-center" id="navbarNav">

            <!-- SEARCH TENGAH -->
            <form action="{{ url('/search') }}" method="GET" class="d-flex mx-auto my-3 my-lg-0 border rounded-pill shadow-sm bg-light" style="width: 100%; max-width: 500px; padding: 2px;">
                <input class="form-control bg-transparent px-3" type="search" name="q" value="{{ request('q') }}"
                    placeholder="Cari produk, halaman, atau bantuan..." aria-label="Search" style="box-shadow: none !important; border: 0 !important; background-color: transparent !important; font-size: 0.9rem;">
                <button class="btn btn-primary rounded-pill px-4 d-flex align-items-center" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <ul class="navbar-nav gap-3 align-items-start align-items-lg-center mt-2 mt-lg-0 ms-auto">

                <!-- BERANDA -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') || request()->is('home') ? 'active fw-bold' : '' }}" href="{{ url('/') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <i class="bi bi-house-door"></i>
                            <span>Beranda</span>
                        </span>
                    </a>
                </li>

                <!-- PRODUCT -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('product*') ? 'active fw-bold' : '' }}" href="{{ url('/product') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <i class="bi bi-car-front"></i>
                            <span>Product</span>
                        </span>
                    </a>
                </li>


                {{-- About Us --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about*') ? 'active fw-bold' : '' }}" href="{{ route('about') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <i class="bi bi-info-circle"></i>
                            <span>About Us</span>
                        </span>
                    </a>
                </li>

                {{-- LOGIN --}}
                @if (!Auth::check())

                    <li class="nav-item">
                        <a class="btn btn-primary text-white px-4 py-2 rounded-pill d-inline-flex align-items-center gap-2 shadow-sm" href="{{ route('login') }}" style="font-weight: 500; font-size: 0.9rem;">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login</span>
                        </a>
                    </li>

                @elseif(Auth::user()->role === 'user')

                    <!-- LOGIN SEBAGAI USER -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="padding-bottom: 0 !important; margin-bottom: 0 !important;">
                            <i class="bi bi-person-circle fs-4 text-primary"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="border-radius: 12px; margin-top: 10px;">

                            <!-- NAMA USER -->
                            <li class="dropdown-item-text fw-semibold text-secondary">
                                👤 {{ Auth::user()->name }}
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- MENU TAMBAHAN -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('user.profile') }}">
                                    <i class="bi bi-person"></i> Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('user.rental-history') }}">
                                    <i class="bi bi-clock-history"></i> Riwayat Sewa
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- LOGOUT -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item d-flex align-items-center gap-2 text-danger w-100 border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>