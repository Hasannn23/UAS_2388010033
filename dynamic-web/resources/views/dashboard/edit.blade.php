@extends('layouts.app')

@section('title', 'Ubah Denim - ' . $product->name)

@section('content')
<div class="dashboard-header">
    <div class="dashboard-title">
        <h2>UBAH DATA DENIM</h2>
        <p>Perbarui informasi ketersediaan, harga, atau spesifikasi untuk <strong>{{ $product->name }}</strong>.</p>
    </div>
    <div>
        <a href="{{ route('dashboard') }}" class="btn-metal">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Dasbor
        </a>
    </div>
</div>

<div class="metal-card" style="max-width: 800px; margin: 0 auto; width: 100%;">
    <div class="card-title-center" style="margin-bottom: 1.5rem; text-align: left;">
        <h3 style="font-size: 1.25rem;">Formulir Pembaruan Inventaris</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.3rem;">Harap isi kolom bertanda bintang (*) dengan data yang valid.</p>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="form-label">Nama Produk Denim *</label>
            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category" class="form-label">Kategori Denim *</label>
                <select name="category" id="category" class="select-metal" style="width: 100%;" required>
                    <option value="Slim Fit" {{ old('category', $product->category) == 'Slim Fit' ? 'selected' : '' }}>Slim Fit</option>
                    <option value="Skinny" {{ old('category', $product->category) == 'Skinny' ? 'selected' : '' }}>Skinny</option>
                    <option value="Straight" {{ old('category', $product->category) == 'Straight' ? 'selected' : '' }}>Straight</option>
                    <option value="Loose Fit" {{ old('category', $product->category) == 'Loose Fit' ? 'selected' : '' }}>Loose Fit</option>
                    <option value="Jacket" {{ old('category', $product->category) == 'Jacket' ? 'selected' : '' }}>Jacket</option>
                </select>
                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="wash_type" class="form-label">Tipe Wash (Warna)</label>
                <input type="text" name="wash_type" id="wash_type" class="form-input" value="{{ old('wash_type', $product->wash_type) }}">
                @error('wash_type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="price" class="form-label">Harga (Rupiah) *</label>
                <input type="number" name="price" id="price" class="form-input" value="{{ old('price', intval($product->price)) }}" min="0" required>
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="stock" class="form-label">Stok Tersedia *</label>
                <input type="number" name="stock" id="stock" class="form-input" value="{{ old('stock', $product->stock) }}" min="0" required>
                @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="size" class="form-label">Ukuran Tersedia *</label>
                <input type="text" name="size" id="size" class="form-input" value="{{ old('size', $product->size) }}" required>
                @error('size')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="image_url" class="form-label">URL Foto Pakaian (Dari Google/Lainnya)</label>
                <input type="url" name="image_url" id="image_url" class="form-input" value="{{ old('image_url', $product->image_url) }}" placeholder="https://contoh.com/gambar.jpg">
                @error('image_url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if($product->image_url)
            <div class="form-group" style="background: rgba(0,0,0,0.2); padding: 1rem; border-radius: 8px; border: 1px dashed var(--metal-border); display: flex; align-items: center; gap: 1.5rem; margin-top: -0.5rem;">
                <div>
                    <span class="form-label" style="margin-bottom: 0.5rem;">Foto Produk Saat Ini:</span>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 6px; border: 1.5px solid var(--metal-border);">
                </div>
                <div style="font-size: 0.85rem; color: var(--text-muted);">
                    Gambar di atas sedang digunakan. Memasukkan URL baru akan menggantikan gambar ini secara otomatis.
                </div>
            </div>
        @endif

        <div class="form-group" style="margin-top: 1.5rem;">
            <label for="description" class="form-label">Deskripsi Lengkap</label>
            <textarea name="description" id="description" class="form-input" style="min-height: 120px;">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid rgba(59, 66, 82, 0.4); padding-top: 1.5rem; margin-top: 2rem;">
            <a href="{{ route('dashboard') }}" class="btn-metal">Batal</a>
            <button type="submit" class="btn-neon">Perbarui Denim</button>
        </div>
    </form>
</div>
@endsection
