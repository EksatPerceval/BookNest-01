@extends('layouts.app')

@section('title', 'Admin Dashboard - BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Admin Dashboard</h1>
        <p class="dashboard-subtitle">Kelola perpustakaan digital BookNest</p>
    </div>
</div>

<div class="container">
    <!-- Stats -->
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-value">{{ $totalBooks }}</div>
            <div class="stat-label">Total Buku</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalCategories }}</div>
            <div class="stat-label">Kategori</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div style="margin-bottom: 3rem;">
        <h2 class="section-title">Quick <span class="gold-text">Actions</span></h2>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('admin.books.create') }}" class="btn-primary" style="flex: 1; min-width: 200px; text-align: center;">+ Tambah Buku Baru</a>
            <a href="{{ route('admin.books.index') }}" class="btn-secondary" style="flex: 1; min-width: 150px; text-align: center;">Kelola Buku</a>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary" style="flex: 1; min-width: 150px; text-align: center;">Kelola Kategori</a>
        </div>
    </div>

    <!-- Recent Books -->
    <h2 class="section-title">Buku <span class="gold-text">Terbaru</span></h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Views</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBooks as $book)
                    <tr>
                        <td><strong>{{ $book->judul }}</strong></td>
                        <td>{{ $book->penulis }}</td>
                        <td>{{ $book->category->nama_kategori }}</td>
                        <td>{{ $book->tahun }}</td>
                        <td>{{ $book->views }}</td>
                        <td class="table-actions">
                            <a href="{{ route('books.show', $book->id_buku) }}" 
                               class="btn-sm btn-edit">Lihat</a>
                            <a href="{{ route('admin.books.edit', $book->id_buku) }}" 
                               class="btn-sm btn-edit">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: var(--color-grey);">
                            Belum ada buku
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
