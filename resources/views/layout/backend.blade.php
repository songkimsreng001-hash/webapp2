<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('page-title', '24/7 NHAM Admin')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --green-dark:   #1a4731;
            --green-mid:    #166534;
            --green-base:   #16a34a;
            --green-light:  #22c55e;
            --green-pale:   #dcfce7;
            --green-accent: #15803d;
            --sidebar-w:    260px;
            --topbar-h:     64px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0fdf4;
            margin: 0;
            color: #1e293b;
        }

        /* ── Sidebar ──────────────────────────────── */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--green-dark);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform .3s ease;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 24px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-logo .logo-icon {
            width: 36px; height: 36px;
            background: var(--green-base);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff;
        }
        .sidebar-logo span {
            font-size: 1.15rem; font-weight: 700; color: #fff; letter-spacing: .3px;
        }

        .sidebar-section-label {
            font-size: .65rem; font-weight: 600; letter-spacing: .1em;
            color: rgba(255,255,255,.35);
            padding: 20px 24px 6px;
            text-transform: uppercase;
        }

        .sidebar-nav { flex: 1; overflow-y: auto; padding: 8px 12px; }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 4px; }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: rgba(255,255,255,.7);
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            transition: all .18s;
            margin-bottom: 2px;
        }
        .nav-item-link:hover { background: rgba(255,255,255,.08); color: #fff; }
        .nav-item-link.active {
            background: var(--green-base);
            color: #fff;
            box-shadow: 0 4px 12px rgba(22,163,74,.35);
        }
        .nav-item-link .nav-icon {
            width: 20px; text-align: center; font-size: .9rem;
        }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-avatar {
            width: 34px; height: 34px;
            background: var(--green-base);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; color: #fff; font-weight: 600;
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name { font-size: .82rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-role { font-size: .72rem; color: rgba(255,255,255,.45); }

        /* ── Topbar ───────────────────────────────── */
        #topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            z-index: 900;
        }

        #topbar .search-wrap {
            flex: 1;
            max-width: 380px;
            position: relative;
        }
        #topbar .search-wrap i {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: .85rem;
        }
        #topbar .search-wrap input {
            width: 100%;
            padding: 8px 14px 8px 34px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: .85rem;
            background: #f8fafc;
            outline: none;
            transition: border-color .2s;
        }
        #topbar .search-wrap input:focus { border-color: var(--green-base); background: #fff; }

        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 8px; }
        .topbar-icon-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            color: #64748b; font-size: .9rem;
            cursor: pointer; transition: all .18s;
            text-decoration: none;
        }
        .topbar-icon-btn:hover { background: var(--green-pale); border-color: var(--green-base); color: var(--green-base); }

        .topbar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 5px 12px 5px 5px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            cursor: pointer;
        }
        .topbar-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--green-base), var(--green-dark));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem; color: #fff; font-weight: 600;
        }
        .topbar-user-name { font-size: .82rem; font-weight: 600; color: #1e293b; }
        .topbar-user-email { font-size: .72rem; color: #94a3b8; }

        /* ── Main content ─────────────────────────── */
        #main-content {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
        }

        .page-inner { padding: 28px; }

        /* ── Sidebar toggle (mobile) ─────────────── */
        #sidebarToggle {
            display: none;
            background: none; border: none;
            font-size: 1.3rem; color: #64748b;
            cursor: pointer; padding: 4px;
        }

        @media (max-width: 991px) {
            #sidebarToggle { display: block; }
            #sidebar { transform: translateX(calc(-1 * var(--sidebar-w))); }
            #sidebar.open { transform: translateX(0); }
            #topbar { left: 0; }
            #main-content { margin-left: 0; }
            .sidebar-overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,.4); z-index: 999;
            }
            .sidebar-overlay.open { display: block; }
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon"><i class="fas fa-store"></i></div>
            <span>24/7 NHAM</span>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-label">Menu</div>
            <a href="{{ route('dashboard') }}" class="nav-item-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-th-large"></i></span> Dashboard
            </a>
            <a href="{{ route('product.index') }}" class="nav-item-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-box-open"></i></span> Products
            </a>
            <a href="{{ route('category.list') }}" class="nav-item-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-tags"></i></span> Categories
            </a>
            <a href="{{ route('book.index') }}" class="nav-item-link {{ request()->routeIs('book.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-book"></i></span> Books
            </a>
            <a href="{{ route('admin.order') }}" class="nav-item-link {{ request()->routeIs('admin.order') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-shopping-cart"></i></span> Orders
            </a>

            <div class="sidebar-section-label">General</div>
            <a href="{{ route('profile.edit', auth()->user()->id ?? 0) }}" class="nav-item-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-user-circle"></i></span> Profile
            </a>
            <a href="{{ route('form.password') }}" class="nav-item-link {{ request()->routeIs('form.password') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-key"></i></span> Change Password
            </a>
            <a href="{{ route('logout') }}" class="nav-item-link">
                <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span> Logout
            </a>
        </nav>

        <div class="sidebar-footer">
            @auth
            <div class="sidebar-user">
                <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                    <div class="sidebar-user-role">Administrator</div>
                </div>
            </div>
            @endauth
        </div>
    </aside>

    <!-- Topbar -->
    <header id="topbar">
        <button id="sidebarToggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>

        <div class="search-wrap">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search products, orders…" />
        </div>

        <div class="topbar-actions">
            <a href="{{ url('/') }}" class="topbar-icon-btn" title="Visit Store">
                <i class="fas fa-store"></i>
            </a>
            <a href="{{ route('admin.order') }}" class="topbar-icon-btn" title="Orders">
                <i class="fas fa-bell"></i>
            </a>
            @auth
            <div class="topbar-user dropdown">
                <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <div class="topbar-user-name">{{ Auth::user()->name }}</div>
                    <div class="topbar-user-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            @endauth
        </div>
    </header>

    <!-- Main content -->
    <main id="main-content">
        <div class="page-inner">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
        }
    </script>
    @stack('scripts')
</body>
</html>