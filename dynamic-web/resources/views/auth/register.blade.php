@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-container">
    <div class="metal-card">
        <div class="card-title-center">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--neon-blue); filter: drop-shadow(0 0 8px var(--neon-blue)); margin-bottom: 1rem;">
                <path d="M20.38 3.46L16 17H8L3.62 3.46a1 1 0 0 1 .95-1.31h14.86a1 1 0 0 1 .95 1.31z"></path>
                <path d="M16 17v4H8v-4"></path>
                <path d="M12 2v15"></path>
            </svg>
            <h2>IRON <span>DENIM</span></h2>
            <p style="font-size: 0.75rem; color: var(--text-muted); letter-spacing: 0.1em; margin-top: 0.5rem;">CREATE ACCOUNT FOR NEW STAFF</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Masukkan nama" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="nama@denim.com" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Minimal 8 karakter" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Ulangi kata sandi" required>
            </div>

            <button type="submit" class="btn-neon" style="width: 100%; margin-top: 1rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                Daftar Akun Baru
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center; font-size: 0.85rem;">
            <span style="color: var(--text-muted);">Sudah punya akun?</span>
            <a href="{{ route('login') }}" style="margin-left: 0.5rem; font-weight: 600;">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection
