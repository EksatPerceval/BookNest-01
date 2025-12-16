@extends('layouts.app')

@section('title', $book->judul . ' - BookNest')

@section('content')
<div class="book-detail">
    <div class="book-detail-container">
        <div>
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" 
                     alt="Cover buku {{ $book->judul }}" 
                     class="book-detail-cover">
            @else
                <img src="https://replicate.delivery/xezq/icPCJr4eeDtDiEv2HGEwxOwKqdfSEPWGiTkZ7mgrYAtIypfWB/tmpap18yxsx.jpeg urlencode($book->judul) }}" 
                     alt="Cover buku {{ $book->judul }}" 
                     class="book-detail-cover">
            @endif
        </div>

        <div class="book-detail-info">
            <span class="book-category">{{ $book->category->nama_kategori }}</span>
            <h1>{{ $book->judul }}</h1>

            <div class="book-detail-meta">
                <div class="book-detail-meta-item">
                    <span class="book-detail-meta-label">Penulis</span>
                    <span class="book-detail-meta-value">{{ $book->penulis }}</span>
                </div>
                <div class="book-detail-meta-item">
                    <span class="book-detail-meta-label">Tahun Terbit</span>
                    <span class="book-detail-meta-value">{{ $book->tahun }}</span>
                </div>
                <div class="book-detail-meta-item">
                    <span class="book-detail-meta-label">Dibaca</span>
                    <span class="book-detail-meta-value">{{ $book->views }} kali</span>
                </div>
            </div>

            <h3 style="margin-top: 2rem; margin-bottom: 1rem; font-size: 1.2rem;">Deskripsi</h3>
            <p class="book-description">{{ $book->deskripsi }}</p>

            <div class="book-actions">
                <a href="{{ route('books.read', $book->id_buku) }}" class="btn-primary">
                    Baca Buku
                </a>

                @auth
                    <button class="favorite-btn {{ $book->isFavoritedBy(Auth::id()) ? 'active' : '' }}" 
                            data-book-id="{{ $book->id_buku }}">
                        {{ $book->isFavoritedBy(Auth::id()) ? '★ Hapus dari Favorit' : '☆ Tambah ke Favorit' }}
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary">
                        Login untuk Favorit
                    </a>
                @endauth

                @if($book->file_pdf)
                    <a href="{{ asset('storage/' . $book->file_pdf) }}" 
                       class="btn-secondary" download>
                        Download PDF
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Books -->
    @if($relatedBooks->count() > 0)
        <div style="margin-top: 4rem;">
            <h2 class="section-title">Buku <span class="gold-text">Terkait</span></h2>
            
            <div class="books-grid">
                @foreach($relatedBooks as $relatedBook)
                    <a href="{{ route('books.show', $relatedBook->id_buku) }}" class="book-card">
                        @if($relatedBook->cover)
                            <img src="{{ asset('storage/' . $relatedBook->cover) }}" 
                                 alt="Cover buku {{ $relatedBook->judul }}" 
                                 class="book-cover">
                        @else
                            <img src="https://replicate.delivery/xezq/nlI2xqZmCdqeNyWwtpBP0eOGNnAs7tzwt4gwL99CVd4D50vVA/tmpdrwr0iro.jpeg urlencode($relatedBook->judul) }}" 
                                 alt="Cover buku {{ $relatedBook->judul }}" 
                                 class="book-cover">
                        @endif
                        
                        <div class="book-info">
                            <span class="book-category">{{ $relatedBook->category->nama_kategori }}</span>
                            <h3 class="book-title">{{ $relatedBook->judul }}</h3>
                            <p class="book-author">{{ $relatedBook->penulis }}</p>
                            
                            <div class="book-meta">
                                <span class="book-year">{{ $relatedBook->tahun }}</span>
                                <span class="book-views">{{ $relatedBook->views }} views</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
