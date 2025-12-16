@extends('layouts.app')

@section('title', 'Edit Buku - Admin BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Edit Buku</h1>
        <p class="dashboard-subtitle">Update informasi buku</p>
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

            <form action="{{ route('admin.books.update', $book->id_buku) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="judul">Judul Buku *</label>
                    <input type="text" id="judul" name="judul" class="form-input" 
                           value="{{ old('judul', $book->judul) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="penulis">Penulis *</label>
                    <input type="text" id="penulis" name="penulis" class="form-input" 
                           value="{{ old('penulis', $book->penulis) }}" required>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label" for="tahun">Tahun Terbit *</label>
                        <input type="number" id="tahun" name="tahun" class="form-input" 
                               value="{{ old('tahun', $book->tahun) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kategori">Kategori *</label>
                        <select id="kategori" name="kategori" class="form-input" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id_kategori }}" 
                                        {{ old('kategori', $book->kategori) == $category->id_kategori ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="deskripsi">Deskripsi *</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-textarea" 
                              required>{{ old('deskripsi', $book->deskripsi) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="isi_buku">Isi Buku (Text Lengkap)</label>
                    <textarea id="isi_buku" name="isi_buku" class="form-textarea" 
                              style="min-height: 300px;">{{ old('isi_buku', $book->isi_buku) }}</textarea>
                    <small style="color: var(--color-grey);">Isi lengkap buku yang akan ditampilkan saat user membaca</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="cover">Cover Buku (JPG, PNG)</label>
                    @if($book->cover)
                        <div class="image-preview" style="margin-bottom: 1rem;">
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Current cover">
                        </div>
                    @endif
                    <input type="file" id="cover" name="cover" class="form-input" accept="image/*">
                    <small style="color: var(--color-grey);">Kosongkan jika tidak ingin mengubah cover. Maksimal 2MB</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="file_pdf">File PDF</label>
                    @if($book->file_pdf)
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #e9ecef;">
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                                <div style="flex: 1; min-width: 200px;">
                                    <p style="margin: 0; color: var(--color-grey); font-size: 0.875rem; font-weight: 500;">File PDF Saat Ini:</p>
                                    <p style="margin: 0.25rem 0 0 0; color: var(--color-black); font-weight: 600;">{{ basename($book->file_pdf) }}</p>
                                    <a href="{{ asset('storage/' . $book->file_pdf) }}" target="_blank" 
                                       style="color: var(--color-gold); font-size: 0.875rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; margin-top: 0.5rem;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                            <polyline points="15 3 21 3 21 9"></polyline>
                                            <line x1="10" y1="14" x2="21" y2="3"></line>
                                        </svg>
                                        Lihat PDF
                                    </a>
                                </div>
                                <div style="flex-shrink: 0;">
                                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; padding: 0.5rem; border-radius: 6px; transition: background 0.2s;">
                                        <input type="checkbox" name="delete_pdf" value="1" id="delete_pdf" 
                                               style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--color-gold);"
                                               onchange="togglePdfUpload(this)">
                                        <span style="color: #dc3545; font-weight: 500; font-size: 0.875rem;">Hapus PDF</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
                    <input type="file" id="file_pdf" name="file_pdf" class="form-input" accept=".pdf">
                    <small style="color: var(--color-grey);">Upload PDF baru atau centang "Hapus PDF" untuk menghapus file yang ada. Maksimal 10MB</small>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                    <button type="submit" class="btn-primary" style="flex: 1; min-width: 150px;">Update Buku</button>
                    <a href="{{ route('admin.books.index') }}" class="btn-secondary" style="flex: 1; min-width: 150px; text-align: center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePdfUpload(checkbox) {
    const pdfInput = document.getElementById('file_pdf');
    if (checkbox.checked) {
        pdfInput.disabled = true;
        pdfInput.value = '';
        pdfInput.style.opacity = '0.5';
        pdfInput.style.cursor = 'not-allowed';
    } else {
        pdfInput.disabled = false;
        pdfInput.style.opacity = '1';
        pdfInput.style.cursor = 'pointer';
    }
}
</script>
@endsection
