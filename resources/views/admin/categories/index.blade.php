@extends('layouts.app')

@section('title', 'Kelola Kategori - Admin BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Kelola Kategori</h1>
        <p class="dashboard-subtitle">Tambah dan hapus kategori buku</p>
    </div>
</div>

<div class="container">
    {{-- Make grid responsive - stack on mobile --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <!-- Add Category Form -->
        <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); height: fit-content;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.2rem;">Tambah Kategori Baru</h3>
            
            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="nama_kategori">Nama Kategori *</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" 
                           class="form-input" value="{{ old('nama_kategori') }}" required>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;">
                    Tambah Kategori
                </button>
            </form>
        </div>

        <!-- Categories List -->
        <div>
            <h2 class="section-title">Daftar <span class="gold-text">Kategori</span></h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Table with horizontal scroll for mobile --}}
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id_kategori }}</td>
                                <td><strong>{{ $category->nama_kategori }}</strong></td>
                                <td>{{ $category->books_count }}</td>
                                <td class="table-actions">
                                    <form action="{{ route('admin.categories.destroy', $category->id_kategori) }}" 
                                          method="POST" style="display: inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 2rem; color: var(--color-grey);">
                                    Belum ada kategori
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($categories->hasPages())
                <div class="pagination">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
