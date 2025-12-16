@extends('layouts.app')

@section('title', isset($trending) ? 'Trending Books - BookNest' : 'Katalog Buku - BookNest')

@section('content')
<!-- Page Header -->
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">{{ isset($trending) ? 'Buku Trending' : 'Katalog Buku' }}</h1>
        <p class="dashboard-subtitle">
            {{ isset($trending) ? 'Buku paling populer dan banyak dibaca' : 'Temukan buku favorit Anda' }}
        </p>
    </div>
</div>

<!-- Search & Filter -->
<div class="search-container">
    <form action="{{ isset($trending) ? route('books.trending') : route('books.index') }}" method="GET" class="search-box">
        <input type="text" name="search" class="search-input" 
               placeholder="Cari judul buku atau penulis..." 
               value="{{ request('search') }}"
               autocomplete="off">
        
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
        
        @if(request('search') || request('kategori'))
            <a href="{{ isset($trending) ? route('books.trending') : route('books.index') }}" 
               class="btn-secondary">Reset</a>
        @endif
    </form>
</div>

<!-- Books Grid -->
<div class="container">
    @if(request('search') || request('kategori'))
        <div style="background: var(--color-dark-grey); padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            <p style="color: var(--color-grey); margin: 0;">
                @if(request('search'))
                    Hasil pencarian untuk: <strong style="color: var(--color-gold);">"{{ request('search') }}"</strong>
                @endif
                @if(request('kategori'))
                    @php
                        $selectedCategory = $categories->firstWhere('id_kategori', request('kategori'));
                    @endphp
                    @if($selectedCategory)
                        dalam kategori: <strong style="color: var(--color-gold);">{{ $selectedCategory->nama_kategori }}</strong>
                    @endif
                @endif
                - Ditemukan <strong style="color: var(--color-gold);">{{ $books->total() }}</strong> buku
            </p>
        </div>
    @endif

    <div class="books-grid">
        @forelse($books as $book)
            <a href="{{ route('books.show', $book->id_buku) }}" class="book-card">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" 
                         alt="Cover buku {{ $book->judul }}" 
                         class="book-cover"
                         onerror="this.src='https://placehold.co/300x400/1a1a1a/d4af37?text={{ urlencode($book->judul) }}'">
                @else
                    <img src="https://placehold.co/300x400/1a1a1a/d4af37?text={{ urlencode($book->judul) }}" 
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
            <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: var(--color-dark-grey); border-radius: 12px;">
                <h3 style="color: var(--color-gold); font-size: 1.5rem; margin-bottom: 1rem;">Tidak ada buku ditemukan</h3>
                <p style="color: var(--color-grey); margin-bottom: 2rem;">
                    @if(request('search') || request('kategori'))
                        Coba gunakan kata kunci lain atau ubah filter pencarian
                    @else
                        Belum ada buku dalam kategori ini
                    @endif
                </p>
                @if(request('search') || request('kategori'))
                    <a href="{{ isset($trending) ? route('books.trending') : route('books.index') }}" class="btn-primary">Lihat Semua Buku</a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($books->hasPages())
        <div class="pagination">
            {{ $books->links() }}
        </div>
    @endif
</div>
@endsection
