@extends('layouts.app')

@section('title', 'Home - BookNest')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <h1>Jelajahi Dunia <span class="gold-text">Literasi Digital</span></h1>
    <p>Ribuan buku berkualitas dalam genggaman Anda. Baca kapan saja, di mana saja.</p>
    
    <div class="hero-buttons">
        <a href="{{ route('books.index') }}" class="btn-primary">Jelajahi Katalog</a>
        @guest
            <a href="{{ route('register') }}" class="btn-secondary">Daftar Gratis</a>
        @endguest
    </div>
</section>

<!-- Search Bar -->
<div class="search-container">
    <form action="{{ route('books.index') }}" method="GET" class="search-box">
        <input type="text" name="search" class="search-input" 
               placeholder="Cari judul buku atau penulis..." 
               value="{{ request('search') }}">
        
        <select name="kategori" class="search-select">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id_kategori }}" 
                        {{ request('kategori') == $category->id_kategori ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
        
        <button type="submit" class="btn-primary">Cari</button>
    </form>
</div>

<!-- Latest Books -->
<div class="container">
    <h2 class="section-title">Buku <span class="gold-text">Terbaru</span></h2>
    
    <div class="books-grid">
        @forelse($books as $book)
            <a href="{{ route('books.show', $book->id_buku) }}" class="book-card">
                {{-- Fixed cover image to show uploaded covers instead of placeholder --}}
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" 
                         alt="Cover buku {{ $book->judul }}" 
                         class="book-cover">
                @else
                    <img src="https://replicate.delivery/xezq/c1AEp6tvrjJPPVUeEc7z9AYC1MXwNKRtle1ngEjzusiqZ2vVA/tmpxe3xbbry.jpeg urlencode($book->judul) }}" 
                         alt="Cover buku {{ $book->judul }}" 
                         class="book-cover">
                @endif
                
                <div class="book-info">
                    <span class="book-category">{{ $book->category->nama_kategori }}</span>
                    <h3 class="book-title">{{ $book->judul }}</h3>
                    <p class="book-author">{{ $book->penulis }}</p>
                    
                    <div class="book-meta">
                        <span class="book-year">{{ $book->tahun }}</span>
                        <span class="book-views">{{ $book->views }} views</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <h3>Belum ada buku</h3>
                <p>Buku akan muncul di sini</p>
            </div>
        @endforelse
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('books.index') }}" class="btn-primary">Lihat Semua Buku</a>
    </div>
</div>

<!-- Trending Books -->
<div class="container">
    <h2 class="section-title">Buku <span class="gold-text">Trending</span></h2>
    
    <div class="books-grid">
        @foreach($trendingBooks as $book)
            <a href="{{ route('books.show', $book->id_buku) }}" class="book-card">
                {{-- Fixed cover image to show uploaded covers instead of placeholder --}}
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" 
                         alt="Cover buku {{ $book->judul }}" 
                         class="book-cover">
                @else
                    <img src="https://replicate.delivery/xezq/c1AEp6tvrjJPPVUeEc7z9AYC1MXwNKRtle1ngEjzusiqZ2vVA/tmpxe3xbbry.jpeg urlencode($book->judul) }}" 
                         alt="Cover buku {{ $book->judul }}" 
                         class="book-cover">
                @endif
                
                <div class="book-info">
                    <span class="book-category">{{ $book->category->nama_kategori }}</span>
                    <h3 class="book-title">{{ $book->judul }}</h3>
                    <p class="book-author">{{ $book->penulis }}</p>
                    
                    <div class="book-meta">
                        <span class="book-year">{{ $book->tahun }}</span>
                        <span class="book-views">{{ $book->views }} views</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('books.trending') }}" class="btn-primary">Lihat Semua Trending</a>
    </div>
</div>
@endsection
