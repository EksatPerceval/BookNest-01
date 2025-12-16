@extends('layouts.app')

@section('title', 'Baca: ' . $book->judul . ' - BookNest')

@section('content')
<div class="read-container">
    <div class="read-header">
        <span class="book-category">{{ $book->category->nama_kategori }}</span>
        <h1>{{ $book->judul }}</h1>
        <p style="color: var(--color-grey); font-size: 1.1rem;">
            oleh {{ $book->penulis }} • {{ $book->tahun }}
        </p>
    </div>

    <div class="read-content">
        @if($book->isi_buku)
            {!! nl2br(e($book->isi_buku)) !!}
        @else
            <div class="empty-state">
                <h3>Konten buku belum tersedia</h3>
                <p>Silakan hubungi administrator untuk menambahkan konten buku ini.</p>
            </div>
        @endif
    </div>

    <div style="text-align: center; margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--color-border);">
        <a href="{{ route('books.show', $book->id_buku) }}" class="btn-secondary">
            Kembali ke Detail Buku
        </a>
        
        @if($book->file_pdf)
            <a href="{{ asset('storage/' . $book->file_pdf) }}" 
               class="btn-primary" download>
                Download PDF
            </a>
        @endif
    </div>
</div>
@endsection
