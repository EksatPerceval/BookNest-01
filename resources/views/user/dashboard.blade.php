@extends('layouts.app')

@section('title', 'Dashboard - BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Dashboard Saya</h1>
        <p class="dashboard-subtitle">Selamat datang, {{ Auth::user()->nama }}!</p>
    </div>
</div>

<div class="container">
    <h2 class="section-title">Buku <span class="gold-text">Favorit</span> Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="books-grid">
        @forelse($favoriteBooks as $book)
            <a href="{{ route('books.show', $book->id_buku) }}" class="book-card">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" 
                         alt="Cover buku {{ $book->judul }}" 
                         class="book-cover">
                @else
                    <img src="https://replicate.delivery/xezq/t07i3hU18FrSOhkGdXzah9K6qiRXcLIs1uLtRBQR7fMkc63KA/tmprd2y8p2p.jpeg urlencode($book->judul) }}" 
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
            <div class="empty-state" style="grid-column: 1 / -1;">
                <h3>Belum ada buku favorit</h3>
                <p>Mulai tambahkan buku ke favorit Anda dari katalog</p>
                <a href="{{ route('books.index') }}" class="btn-primary" style="margin-top: 1rem;">
                    Jelajahi Katalog
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
