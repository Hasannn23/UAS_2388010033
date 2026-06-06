@extends('layouts.app')

@section('title', 'Login')

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
            <p style="font-size: 0.75rem; color: var(--text-muted); letter-spacing: 0.1em; margin-top: 0.5rem;">SIGN IN TO ACCESS DASHBOARD</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="admin@denim.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="••••••••" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                <label class="input-checkbox">
                    <input type="checkbox" name="remember">
                    <span style="font-size: 0.85rem; color: var(--text-muted);">Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="btn-neon" style="width: 100%; margin-top: 1rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Masuk Sistem
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center; font-size: 0.85rem;">
            <span style="color: var(--text-muted);">Belum punya akun?</span>
            <a href="{{ route('register') }}" style="margin-left: 0.5rem; font-weight: 600;">Daftar Sekarang</a>
        </div>
        
        <div style="margin-top: 1.5rem; text-align: center; border-top: 1px dashed var(--metal-border); padding-top: 1rem;">
            <p style="font-size: 0.75rem; color: var(--text-muted);">Akun Demo Default:</p>
            <p style="font-size: 0.8rem; color: var(--neon-blue); font-family: var(--font-heading); margin-top: 0.2rem;">admin@denim.com / admin123</p>
        </div>
    </div>
</div>
@endsection
