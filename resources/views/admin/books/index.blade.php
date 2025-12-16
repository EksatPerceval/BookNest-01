@extends('layouts.app')

@section('title', 'Kelola Buku - Admin BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Kelola Buku</h1>
        <p class="dashboard-subtitle">Tambah, edit, dan hapus buku</p>
    </div>
</div>

<div class="container">
    {{-- Admin actions already responsive with flex-wrap --}}
    <div class="admin-actions">
        <h2 class="section-title">Daftar <span class="gold-text">Buku</span></h2>
        <a href="{{ route('admin.books.create') }}" class="btn-primary">+ Tambah Buku Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table container with horizontal scroll for mobile --}}
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Views</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->id_buku }}</td>
                        <td><strong>{{ $book->judul }}</strong></td>
                        <td>{{ $book->penulis }}</td>
                        <td>{{ $book->category->nama_kategori }}</td>
                        <td>{{ $book->tahun }}</td>
                        <td>{{ $book->views }}</td>
                        <td class="table-actions">
                            <a href="{{ route('books.show', $book->id_buku) }}" 
                               class="btn-sm btn-edit" target="_blank">Lihat</a>
                            <a href="{{ route('admin.books.edit', $book->id_buku) }}" 
                               class="btn-sm btn-edit">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book->id_buku) }}" 
                                  method="POST" style="display: inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: var(--color-grey);">
                            Belum ada buku
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($books->hasPages())
        <div class="pagination">
            {{ $books->links() }}
        </div>
    @endif
</div>
@endsection
