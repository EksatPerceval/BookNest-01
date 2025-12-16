<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BookNest - Digital Library')</title>
    
    <!-- Updated favicon reference to use the new elegant book icon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <!-- Replaced with new elegant book icon design with gold gradient bookmark -->
                <svg class="navbar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                    <defs>
                        <linearGradient id="navGoldGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#E8C547;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#D4AF37;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    
                    <!-- Book base -->
                    <rect x="16" y="12" width="32" height="40" rx="2" fill="currentColor"/>
                    
                    <!-- Book pages effect -->
                    <rect x="18" y="14" width="28" height="36" rx="1" fill="#2a2a2a"/>
                    <rect x="20" y="16" width="24" height="32" rx="1" fill="currentColor"/>
                    
                    <!-- Gold bookmark ribbon -->
                    <rect x="30" y="12" width="4" height="44" fill="url(#navGoldGradient)"/>
                    
                    <!-- Book pages lines -->
                    <line x1="24" y1="24" x2="40" y2="24" stroke="#D4AF37" stroke-width="1" opacity="0.6"/>
                    <line x1="24" y1="28" x2="38" y2="28" stroke="#D4AF37" stroke-width="1" opacity="0.4"/>
                    <line x1="24" y1="32" x2="40" y2="32" stroke="#D4AF37" stroke-width="1" opacity="0.6"/>
                    <line x1="24" y1="36" x2="36" y2="36" stroke="#D4AF37" stroke-width="1" opacity="0.4"/>
                    
                    <!-- Spine highlight -->
                    <rect x="16" y="12" width="2" height="40" rx="1" fill="#D4AF37" opacity="0.3"/>
                </svg>
                BookNest
            </a>
            
            <button class="navbar-toggle">☰</button>
            
            <ul class="navbar-menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">Katalog</a></li>
                <li><a href="{{ route('books.trending') }}" class="{{ request()->routeIs('books.trending') ? 'active' : '' }}">Trending</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a></li>
                
                @auth
                    @if(Auth::user()->isAdmin())
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                    @else
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                    <li><a href="{{ route('profile') }}">Profil</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-primary">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn-primary">Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>BookNest</h3>
                <p>Platform digital library terbaik untuk membaca dan mengelola koleksi buku elektronik Anda.</p>
            </div>
            <div class="footer-section">
                <h3>Menu</h3>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('books.index') }}">Katalog Buku</a>
                <a href="{{ route('books.trending') }}">Trending</a>
                <a href="{{ route('about') }}">Tentang Kami</a>
            </div>
            <div class="footer-section">
                <h3>Kategori</h3>
                @php
                    $footerCategories = \App\Models\Category::take(5)->get();
                @endphp
                @foreach($footerCategories as $cat)
                    <a href="{{ route('books.index', ['kategori' => $cat->id_kategori]) }}">{{ $cat->nama_kategori }}</a>
                @endforeach
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>Email: info@booknest.com</p>
                <p>Telepon: +62 123 4567 890</p>
                <p>Alamat: Bali, Indonesia</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 BookNest & PT. Berdiri Sendiri. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
