@extends('layouts.app')

@section('title', 'Tambah Buku - Admin BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Tambah Buku Baru</h1>
        <p class="dashboard-subtitle">Lengkapi form di bawah untuk menambah buku</p>
    </div>
</div>

<div class="container">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="judul">Judul Buku *</label>
                    <input type="text" id="judul" name="judul" class="form-input" 
                           value="{{ old('judul') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="penulis">Penulis *</label>
                    <input type="text" id="penulis" name="penulis" class="form-input" 
                           value="{{ old('penulis') }}" required>
                </div>

                <!-- Make grid responsive for mobile -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label" for="tahun">Tahun Terbit *</label>
                        <input type="number" id="tahun" name="tahun" class="form-input" 
                               value="{{ old('tahun', date('Y')) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kategori">Kategori *</label>
                        <select id="kategori" name="kategori" class="form-input" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id_kategori }}" 
                                        {{ old('kategori') == $category->id_kategori ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="deskripsi">Deskripsi *</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-textarea" 
                              required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="isi_buku">Isi Buku (Text Lengkap)</label>
                    <textarea id="isi_buku" name="isi_buku" class="form-textarea" 
                              style="min-height: 300px;">{{ old('isi_buku') }}</textarea>
                    <small style="color: var(--color-grey);">Isi lengkap buku yang akan ditampilkan saat user membaca</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="cover">Cover Buku (JPG, PNG)</label>
                    <input type="file" id="cover" name="cover" class="form-input" accept="image/*">
                    <small style="color: var(--color-grey);">Maksimal 2MB</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="file_pdf">File PDF (Opsional)</label>
                    <input type="file" id="file_pdf" name="file_pdf" class="form-input" accept=".pdf">
                    <small style="color: var(--color-grey);">Maksimal 10MB</small>
                </div>

                <!-- Stack buttons vertically on mobile -->
                <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                    <button type="submit" class="btn-primary" style="flex: 1; min-width: 150px;">Simpan Buku</button>
                    <a href="{{ route('admin.books.index') }}" class="btn-secondary" style="flex: 1; min-width: 150px; text-align: center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
