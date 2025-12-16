@extends('layouts.app')

@section('title', 'Tentang Kami - BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Tentang <span class="gold-text">BookNest</span></h1>
        <p class="dashboard-subtitle">Platform digital library terbaik untuk Anda</p>
    </div>
</div>

<div class="container">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); margin-bottom: 3rem;">
            <h2 style="margin-bottom: 1.5rem; color: var(--color-gold);">Visi Kami</h2>
            <p style="line-height: 1.8; color: var(--color-grey-dark); margin-bottom: 2rem;">
                BookNest hadir dengan visi untuk menjadi platform digital library terdepan di Indonesia. 
                Kami percaya bahwa setiap orang berhak mendapatkan akses mudah ke berbagai koleksi buku 
                berkualitas untuk meningkatkan pengetahuan dan wawasan mereka.
            </p>

            <h2 style="margin-bottom: 1.5rem; color: var(--color-gold);">Misi Kami</h2>
            <ul style="line-height: 2; color: var(--color-grey-dark); padding-left: 1.5rem; margin-bottom: 2rem;">
                <li>Menyediakan akses mudah dan cepat ke ribuan koleksi buku digital</li>
                <li>Mendorong budaya literasi di kalangan masyarakat Indonesia</li>
                <li>Memberikan pengalaman membaca yang nyaman dan menyenangkan</li>
                <li>Membangun komunitas pembaca yang aktif dan berbagi pengetahuan</li>
            </ul>

            <h2 style="margin-bottom: 1.5rem; color: var(--color-gold);">Fitur Unggulan</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div style="padding: 1.5rem; background: var(--color-grey-light); border-radius: 8px;">
                    <h4 style="margin-bottom: 0.5rem; color: var(--color-black);">Koleksi Lengkap</h4>
                    <p style="color: var(--color-grey); font-size: 0.9rem;">Ribuan buku dari berbagai kategori</p>
                </div>
                <div style="padding: 1.5rem; background: var(--color-grey-light); border-radius: 8px;">
                    <h4 style="margin-bottom: 0.5rem; color: var(--color-black);">Responsive Design</h4>
                    <p style="color: var(--color-grey); font-size: 0.9rem;">Akses dari desktop dan mobile</p>
                </div>
                <div style="padding: 1.5rem; background: var(--color-grey-light); border-radius: 8px;">
                    <h4 style="margin-bottom: 0.5rem; color: var(--color-black);">Favorit & Dashboard</h4>
                    <p style="color: var(--color-grey); font-size: 0.9rem;">Kelola koleksi favorit Anda</p>
                </div>
                <div style="padding: 1.5rem; background: var(--color-grey-light); border-radius: 8px;">
                    <h4 style="margin-bottom: 0.5rem; color: var(--color-black);">Pencarian Canggih</h4>
                    <p style="color: var(--color-grey); font-size: 0.9rem;">Temukan buku dengan mudah</p>
                </div>
            </div>

            <h2 style="margin-bottom: 1.5rem; color: var(--color-gold);">Hubungi Kami</h2>
            <p style="line-height: 1.8; color: var(--color-grey-dark);">
                Email: info@booknest.com<br>
                Telepon: +62 123 4567 890<br>
                Alamat: Bali, Indonesia
            </p>
        </div>
    </div>
</div>
@endsection
