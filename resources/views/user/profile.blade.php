@extends('layouts.app')

@section('title', 'Profil - BookNest')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1 class="dashboard-title">Profil Saya</h1>
        <p class="dashboard-subtitle">Kelola informasi akun Anda</p>
    </div>
</div>

<div class="container">
    <div style="max-width: 600px; margin: 0 auto;">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Update Profile -->
        <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.3rem;">Informasi Profil</h3>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-input" 
                           value="{{ Auth::user()->nama }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-input" 
                           value="{{ Auth::user()->email }}" required>
                </div>

                <button type="submit" class="btn-primary">Update Profil</button>
            </form>
        </div>

        <!-- Change Password -->
        <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.3rem;">Ubah Password</h3>
            
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label" for="current_password">Password Lama</label>
                    <input type="password" id="current_password" name="current_password" 
                           class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password Baru</label>
                    <input type="password" id="password" name="password" 
                           class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="form-input" required>
                </div>

                <button type="submit" class="btn-primary">Ubah Password</button>
            </form>
        </div>

        {{-- Added delete account section --}}
        <!-- Delete Account -->
        <div style="background: #fff5f5; padding: 2rem; border-radius: 12px; border: 2px solid #ff4444;">
            <h3 style="margin-bottom: 1rem; font-size: 1.3rem; color: #dc2626;">Hapus Akun</h3>
            <p style="margin-bottom: 1.5rem; color: #666;">
                Perhatian: Tindakan ini tidak dapat dibatalkan. Semua data Anda termasuk buku favorit akan dihapus secara permanen.
            </p>
            
            <button type="button" onclick="confirmDeleteAccount()" class="btn-danger">
                Hapus Akun Saya
            </button>
        </div>
    </div>
</div>

{{-- Added delete account confirmation modal --}}
<!-- Delete Account Modal -->
<div id="deleteAccountModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; padding: 2rem; border-radius: 12px; max-width: 500px; width: 90%; margin: 0 auto;">
        <h3 style="margin-bottom: 1rem; color: #dc2626;">Konfirmasi Hapus Akun</h3>
        <p style="margin-bottom: 1.5rem; color: #666;">
            Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.
        </p>
        
        <form action="{{ route('profile.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            
            <div class="form-group">
                <label class="form-label" for="confirm_password">Masukkan password Anda untuk konfirmasi:</label>
                <input type="password" id="confirm_password" name="password" class="form-input" required>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="button" onclick="closeDeleteModal()" class="btn-secondary">Batal</button>
                <button type="submit" class="btn-danger">Ya, Hapus Akun</button>
            </div>
        </form>
    </div>
</div>

<script>
function confirmDeleteAccount() {
    document.getElementById('deleteAccountModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteAccountModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('deleteAccountModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
