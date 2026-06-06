<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Booking Travel & Wisata') | Nusantara Travel</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-paper-plane me-2 text-primary"></i>Nusantara<span>Travel</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('travel.*') ? 'active' : '' }}" href="{{ route('travel.index') }}">Travel Antar Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('carter.*') ? 'active' : '' }}" href="{{ route('carter.index') }}">Carter Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tour.*') ? 'active' : '' }}" href="{{ route('tour.index') }}">Paket Wisata</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="btn btn-nav-profile me-2 d-flex align-items-center px-3" style="border-radius: 50px;">
                            @if(auth()->user()->avatar)
                                <img src="{{ filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle me-2" style="width: 28px; height: 28px; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=5050F4&color=ffffff&size=60" class="rounded-circle me-2" style="width: 28px; height: 28px; object-fit: cover;">
                            @endif
                            <span class="fw-bold" style="font-size: 0.9rem;">{{ auth()->user()->name }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2" style="border-radius: 50px;">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary" style="border-radius: 50px;">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container text-center">
            <h5 class="mb-3">Jelajahi Keindahan Nusantara</h5>
            <p class="mb-0">© {{ date('Y') }} Nusantara Travel. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
