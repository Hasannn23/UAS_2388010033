<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Iron Denim Dashboard') | Premium Denim Inventory</title>
    <!-- Custom styling -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>

    <div class="dashboard-wrapper">
        @auth
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--neon-blue); filter: drop-shadow(0 0 5px var(--neon-blue)); margin-bottom: 0.5rem;">
                    <path d="M20.38 3.46L16 17H8L3.62 3.46a1 1 0 0 1 .95-1.31h14.86a1 1 0 0 1 .95 1.31z"></path>
                    <path d="M16 17v4H8v-4"></path>
                    <path d="M12 2v15"></path>
                </svg>
                IRON DENIM
                <span>INVENTORY SYS</span>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="9"></rect>
                            <rect x="14" y="3" width="7" height="5"></rect>
                            <rect x="14" y="12" width="7" height="9"></rect>
                            <rect x="3" y="16" width="7" height="5"></rect>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-link" id="btn-open-create-modal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Tambah Denim</span>
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-user">
                <div class="user-info">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
                <form action="{{ route('logout') }}" method="POST" style="margin-top: 0.8rem;">
                    @csrf
                    <button type="submit" class="btn-metal" style="width: 100%; padding: 0.5rem;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        &nbsp; Log Out
                    </button>
                </form>
            </div>
        </aside>
        @endauth

        <!-- Main Workspace Content -->
        <main class="main-content" style="{{ !Auth::check() ? 'margin-left: 0; width: 100%;' : '' }}">
            
            <!-- Global Flash Notifications -->
            @if(session('success'))
                <div class="alert alert-success" id="global-alert">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <span class="alert-close" onclick="document.getElementById('global-alert').style.display='none'">&times;</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" id="global-alert-err">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <span class="alert-close" onclick="document.getElementById('global-alert-err').style.display='none'">&times;</span>
                </div>
            @endif

            @yield('content')
            
        </main>
    </div>

    <!-- Script triggers -->
    <script>
        // Auto fade alerts
        setTimeout(() => {
            const successAlert = document.getElementById('global-alert');
            const errorAlert = document.getElementById('global-alert-err');
            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s ease';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.style.display = 'none', 500);
            }
            if (errorAlert) {
                errorAlert.style.transition = 'opacity 0.5s ease';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.style.display = 'none', 500);
            }
        }, 5000);
    </script>
    @yield('scripts')
</body>
</html>
