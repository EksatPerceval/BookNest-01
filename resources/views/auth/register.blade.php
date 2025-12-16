@extends('layouts.app')

@section('title', 'Register - BookNest')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h2>Buat Akun Baru</h2>
        <p>Daftar untuk mulai membaca di BookNest</p>

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-input" 
                       value="{{ old('nama') }}" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" 
                       value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="form-input" required>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1rem;">
                Daftar
            </button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a>
        </div>
    </div>
</div>
@endsection
