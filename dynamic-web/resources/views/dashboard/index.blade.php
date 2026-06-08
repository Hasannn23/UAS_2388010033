@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-header">
    <div class="dashboard-title">
        <h2>@if(Auth::user()?->email === 'admin@denim.com') DASBOR INVENTARIS @else KATALOG @endif</h2>
        <p>@if(Auth::user()?->email === 'admin@denim.com') Kelola koleksi denim, stok, harga, dan spesifikasi produk Anda secara real-time. @else Telusuri koleksi denim premium kami, pilih ukuran, dan cek ketersediaan stok produk secara real-time. @endif</p>
    </div>
    <div style="display: flex; gap: 1rem; align-items: center;">
        @if(!Auth::check())
            <a href="{{ route('login') }}" class="btn-neon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Masuk / Login
            </a>
        @endif
        
        @if(Auth::user()?->email === 'admin@denim.com')
        <button class="btn-copper" id="btn-open-create-modal-body">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Produk
        </button>
        @endif
    </div>
</div>

<!-- Stats Overview Grid -->
<div class="stats-grid">
    <div class="stats-card">
        <div>
            <div class="stats-label">@if(Auth::user()?->email === 'admin@denim.com') Total Produk (SKU) @else Total Koleksi @endif</div>
            <div class="stats-value">{{ $stats['total_products'] }}</div>
        </div>
        <div class="stats-desc">Model denim terdaftar</div>
    </div>
    
    @if(Auth::user()?->email === 'admin@denim.com')
    <div class="stats-card">
        <div>
            <div class="stats-label">Valuasi Stok</div>
            <div class="stats-value" style="color: var(--rivet-copper); text-shadow: 0 0 8px rgba(255, 107, 53, 0.2);">
                Rp {{ number_format($stats['total_value'], 0, ',', '.') }}
            </div>
        </div>
        <div class="stats-desc">Total modal inventaris aktif</div>
    </div>
    @else
    <div class="stats-card">
        <div>
            <div class="stats-label">Kualitas Wash</div>
            <div class="stats-value" style="color: var(--neon-blue); text-shadow: 0 0 8px var(--neon-blue-glow); font-size: 1.8rem; padding: 0.2rem 0;">
                PREMIUM
            </div>
        </div>
        <div class="stats-desc">100% Selvedge & Heavy Metal Distressed</div>
    </div>
    @endif

    @if(Auth::user()?->email === 'admin@denim.com')
    <div class="stats-card {{ $stats['low_stock_count'] > 0 ? 'alert-card' : '' }}">
        <div>
            <div class="stats-label">Stok Kritis</div>
            <div class="stats-value" style="{{ $stats['low_stock_count'] > 0 ? 'color: #bf616a; text-shadow: 0 0 10px rgba(191,97,106,0.3);' : '' }}">
                {{ $stats['low_stock_count'] }}
            </div>
        </div>
        <div class="stats-desc">{{ $stats['low_stock_count'] > 0 ? 'Segera lakukan restock!' : 'Semua stok aman' }}</div>
    </div>
    @else
    <div class="stats-card">
        <div>
            <div class="stats-label">Jaminan Ukuran</div>
            <div class="stats-value" style="color: var(--rivet-copper); text-shadow: 0 0 8px rgba(255, 107, 53, 0.2); font-size: 1.8rem; padding: 0.2rem 0;">
                LENGKAP
            </div>
        </div>
        <div class="stats-desc">Tersedia dari ukuran 28 s.d XL</div>
    </div>
    @endif

    <div class="stats-card">
        <div>
            <div class="stats-label">@if(Auth::user()?->email === 'admin@denim.com') Kategori Denim @else Ragam Fit @endif</div>
            <div class="stats-value" style="color: var(--neon-blue); text-shadow: 0 0 8px var(--neon-blue-glow);">
                {{ $stats['total_categories'] }}
            </div>
        </div>
        <div class="stats-desc">Kategori pakaian berbeda</div>
    </div>
</div>

<!-- Filter & Search Panel -->
<form action="{{ route('dashboard') }}" method="GET">
    <div class="filter-bar">
        <div class="search-box">
            <input type="text" name="search" class="form-input" placeholder="Cari jeans, wash, deskripsi..." value="{{ request('search') }}">
            <button type="submit" class="btn-metal" style="padding: 0.6rem 1.2rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>
        
        <div class="filter-controls">
            <!-- Category Filter -->
            <select name="category" class="select-metal" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            <!-- Sorting column -->
            <select name="sort_by" class="select-metal" onchange="this.form.submit()">
                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Urutkan: Nama</option>
                <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Urutkan: Harga</option>
                <option value="stock" {{ request('sort_by') == 'stock' ? 'selected' : '' }}>Urutkan: Stok</option>
            </select>

            <!-- Sorting direction -->
            <select name="sort_order" class="select-metal" onchange="this.form.submit()">
                <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Menurun</option>
                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Meningkat</option>
            </select>

            @if(request('search') || request('category') || request('sort_by') != 'created_at' || request('sort_order') != 'desc')
                <a href="{{ route('dashboard') }}" class="btn-metal" style="padding: 0.6rem 1.2rem; background: rgba(191, 97, 106, 0.1); border-color: rgba(191, 97, 106, 0.4); color: #bf616a;">
                    Reset
                </a>
            @endif
        </div>
    </div>
</form>

<!-- Catalog Grid View -->
<div class="catalog-grid">
    @if($products->isEmpty())
        <div style="grid-column: 1 / -1; padding: 4rem 2rem; text-align: center; color: var(--text-muted); background: var(--panel-dark); border: 2px solid var(--metal-border); border-radius: 10px;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 1rem; opacity: 0.5;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
            <h3>Tidak Ada Denim Ditemukan</h3>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Coba ganti filter atau tambahkan produk baru.</p>
        </div>
    @else
        @foreach($products as $product)
            <div class="catalog-card">
                <div class="catalog-image-container">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="catalog-image">
                    @else
                        <div class="catalog-image-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20.38 3.46L16 17H8L3.62 3.46a1 1 0 0 1 .95-1.31h14.86a1 1 0 0 1 .95 1.31z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="catalog-badges">
                        <span class="badge badge-denim">{{ $product->category }}</span>
                        @if($product->isLowStock(5))
                            <span class="badge badge-low-stock">Stok Menipis</span>
                        @endif
                    </div>
                </div>
                
                <div class="catalog-details">
                    <h3 class="catalog-title">{{ $product->name }}</h3>
                    <p class="catalog-wash">{{ $product->wash_type ?? 'Standard Wash' }}</p>
                    <div class="catalog-price">{{ $product->formatted_price }}</div>
                    
                    <div class="catalog-meta">
                        <div>
                            <span class="meta-label">Ukuran</span>
                            <span class="meta-value">{{ $product->size }}</span>
                        </div>
                        <div>
                            <span class="meta-label">Stok</span>
                            <span class="meta-value">{{ $product->stock }} Pcs</span>
                        </div>
                    </div>
                    
                    <div class="catalog-actions">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-neon" style="flex: 1; padding: 0.5rem; text-align: center; justify-content: center; display: flex; align-items: center; gap: 0.5rem;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            Detail
                        </a>
                    </div>
                    
                    @if(Auth::user()?->email === 'admin@denim.com')
                    <div class="catalog-actions" style="margin-top: 0.5rem;">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn-metal" style="flex: 1;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="flex: 1; display: flex;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus denim &quot;{{ $product->name }}&quot; dari sistem?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger-metal" style="width: 100%;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>

@if(Auth::user()?->email === 'admin@denim.com')
<!-- Modal Dialog for Creating Product -->
<div class="modal-overlay" id="create-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; text-transform: uppercase;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--neon-blue);">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Denim Baru
            </h3>
            <span class="alert-close" id="btn-close-create-modal" style="font-size: 1.5rem;">&times;</span>
        </div>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Produk *</label>
                    <input type="text" name="name" id="name_input" class="form-input" placeholder="Contoh: Ripped Metal Heavy Indigo" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="category" class="form-label">Kategori Denim *</label>
                        <select name="category" id="category_input" class="select-metal" style="width: 100%;" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Slim Fit">Slim Fit</option>
                            <option value="Skinny">Skinny</option>
                            <option value="Straight">Straight</option>
                            <option value="Loose Fit">Loose Fit</option>
                            <option value="Jacket">Jacket</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wash_type" class="form-label">Tipe Wash (Warna)</label>
                        <input type="text" name="wash_type" id="wash_input" class="form-input" placeholder="Contoh: Acid Wash, Raw, Stone Wash">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price" class="form-label">Harga (Rupiah) *</label>
                        <input type="number" name="price" id="price_input" class="form-input" placeholder="Contoh: 450000" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="form-label">Stok Awal *</label>
                        <input type="number" name="stock" id="stock_input" class="form-input" placeholder="Contoh: 20" min="0" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="size" class="form-label">Ukuran Tersedia *</label>
                        <input type="text" name="size" id="size_input" class="form-input" placeholder="Contoh: 28, 30, 32 atau S, M, L" required>
                    </div>
                    <div class="form-group">
                        <label for="image_url" class="form-label">URL Foto Pakaian (Dari Google/Lainnya)</label>
                        <input type="url" name="image_url" id="image_url_input" class="form-input" placeholder="https://contoh.com/gambar.jpg">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi Produk</label>
                    <textarea name="description" id="desc_input" class="form-input" placeholder="Detail produk denim..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-metal" id="btn-cancel-create-modal">Batal</button>
                <button type="submit" class="btn-neon">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection

@section('scripts')
@if(Auth::user()?->email === 'admin@denim.com')
<script>
    // Elements
    const createModal = document.getElementById('create-modal');
    const openBtnSidebar = document.getElementById('btn-open-create-modal');
    const openBtnBody = document.getElementById('btn-open-create-modal-body');
    const closeBtn = document.getElementById('btn-close-create-modal');
    const cancelBtn = document.getElementById('btn-cancel-create-modal');

    // Functions to toggle Modal
    function showModal() {
        createModal.classList.add('active');
        document.body.style.overflow = 'hidden'; // prevent bg scroll
    }

    function hideModal() {
        createModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Event listeners
    if (openBtnSidebar) openBtnSidebar.addEventListener('click', (e) => {
        e.preventDefault();
        showModal();
    });
    if (openBtnBody) openBtnBody.addEventListener('click', showModal);
    if (closeBtn) closeBtn.addEventListener('click', hideModal);
    if (cancelBtn) cancelBtn.addEventListener('click', hideModal);

    // Close on overlay click
    createModal.addEventListener('click', (e) => {
        if (e.target === createModal) {
            hideModal();
        }
    });

    // Close on ESC keypress
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && createModal.classList.contains('active')) {
            hideModal();
        }
    });
</script>
@endif
@endsection
