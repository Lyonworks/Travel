<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Booking Travel & Wisata') | Nusantara Travel</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary: #5050F4;
            --primary-hover: #3b3bc5;
            --dark-blue: #1A1A2E;
            --light-bg: #F8F9FA;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            color: #333;
        }
        /* Custom Colors */
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            border-radius: 8px;
            font-weight: 500;
            padding: 10px 24px;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        /* Minimalist UI */
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            background: #fff;
        }
        .navbar-brand { font-weight: 700; color: var(--dark-blue) !important; }
        .navbar-brand span { color: var(--primary); }
        .nav-link { font-weight: 500; color: #555; }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            transition: transform 0.3s ease;
        }
        .card:hover { transform: translateY(-5px); }
        .hero-section {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary) 100%);
            color: white;
            padding: 80px 0;
            border-radius: 0 0 40px 40px;
            margin-bottom: -50px;
        }
        .footer { background: var(--dark-blue); color: #fff; padding: 40px 0 20px; margin-top: 80px; }
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('travel.index') }}">Travel Antar Kota</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('rental.index') }}">Carter Mobil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tour.index') }}">Paket Wisata</a></li>
                </ul>
                <div class="d-flex">
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary me-2">Dashboard Saya</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
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
            <p class="text-muted mb-0">© {{ date('Y') }} Nusantara Travel. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
