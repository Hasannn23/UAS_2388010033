@extends('layouts.app')

@section('title', 'Detail Denim - ' . $product->name)

@section('content')
<div class="dashboard-header">
    <div class="dashboard-title">
        <h2>DETAIL PRODUK</h2>
        <p>Informasi lengkap mengenai produk <strong>{{ $product->name }}</strong>.</p>
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
    <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
        <!-- Gambar Produk -->
        <div style="flex: 1; min-width: 250px;">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 8px; border: 2px solid var(--metal-border); object-fit: cover;">
            @else
                <div style="width: 100%; padding-top: 100%; position: relative; background: rgba(0,0,0,0.2); border-radius: 8px; border: 2px dashed var(--metal-border);">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: var(--text-muted); text-align: center;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 0.5rem;">
                            <path d="M20.38 3.46L16 17H8L3.62 3.46a1 1 0 0 1 .95-1.31h14.86a1 1 0 0 1 .95 1.31z"></path>
                        </svg>
                        <p>Tidak ada gambar</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Info Produk -->
        <div style="flex: 2; min-width: 300px;">
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.5rem; color: var(--neon-blue); text-shadow: 0 0 8px var(--neon-blue-glow); margin-bottom: 0.5rem;">{{ $product->name }}</h3>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <span class="badge badge-denim" style="font-size: 0.8rem; padding: 0.2rem 0.6rem;">{{ $product->category }}</span>
                    @if($product->isLowStock(5))
                        <span class="badge badge-low-stock" style="font-size: 0.8rem; padding: 0.2rem 0.6rem;">Stok Menipis</span>
                    @endif
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Harga</span>
                    <div style="font-size: 1.25rem; color: var(--rivet-copper); font-weight: bold; margin-top: 0.2rem;">{{ $product->formatted_price }}</div>
                </div>
                <div>
                    <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Stok Tersedia</span>
                    <div style="font-size: 1.1rem; color: var(--text-light); margin-top: 0.2rem;">{{ $product->stock }} Pcs</div>
                </div>
                <div>
                    <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Ukuran</span>
                    <div style="font-size: 1.1rem; color: var(--text-light); margin-top: 0.2rem;">{{ $product->size }}</div>
                </div>
                <div>
                    <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Tipe Wash</span>
                    <div style="font-size: 1.1rem; color: var(--text-light); margin-top: 0.2rem;">{{ $product->wash_type ?? '-' }}</div>
                </div>
            </div>

            <div>
                <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Deskripsi Lengkap</span>
                <div style="margin-top: 0.5rem; color: var(--text-light); line-height: 1.6; background: rgba(0,0,0,0.2); padding: 1rem; border-radius: 8px; border: 1px solid var(--metal-border);">
                    {!! nl2br(e($product->description ?? 'Tidak ada deskripsi tersedia.')) !!}
                </div>
            </div>

            @if(Auth::user()?->email === 'admin@denim.com')
            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <a href="{{ route('products.edit', $product->id) }}" class="btn-metal" style="flex: 1; text-align: center; justify-content: center; display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    Edit Produk
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
