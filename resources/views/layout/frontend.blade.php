<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="24/7 NHAM — Food, Drinks & More" />
    <title>@yield('page-title', '24/7 NHAM')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --green-dark:  #166534;
            --green-base:  #16a34a;
            --green-light: #22c55e;
            --green-pale:  #f0fdf4;
            --green-border:#bbf7d0;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #fafafa;
            color: #1e293b;
        }

        /* ── Navbar ─────────────────────────────── */
        .navbar-nham {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
            padding: 0 0;
        }
        .navbar-nham .container { padding-top: 10px; padding-bottom: 10px; }
        .navbar-brand-custom {
            display: flex; align-items: center; gap: 9px;
            font-weight: 700; font-size: 1.1rem;
            color: var(--green-dark) !important;
            text-decoration: none;
        }
        .brand-icon {
            width: 32px; height: 32px;
            background: var(--green-base);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: .9rem; flex-shrink: 0;
        }
        .navbar-nham .nav-link {
            color: #475569 !important;
            font-size: .87rem; font-weight: 500;
            padding: 6px 12px !important;
            border-radius: 8px;
            transition: all .18s;
        }
        .navbar-nham .nav-link:hover,
        .navbar-nham .nav-link.active { color: var(--green-base) !important; background: var(--green-pale); }
        .navbar-nham .dropdown-menu {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,.08);
            padding: 6px;
        }
        .navbar-nham .dropdown-item {
            border-radius: 8px; font-size: .86rem;
            padding: 7px 12px; color: #374151;
        }
        .navbar-nham .dropdown-item:hover { background: var(--green-pale); color: var(--green-base); }

        /* Cart badge button */
        .cart-btn {
            display: inline-flex; align-items: center; gap: 7px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 7px 14px;
            background: #fff;
            color: #1e293b;
            font-size: .85rem; font-weight: 600;
            text-decoration: none;
            transition: all .18s;
            position: relative;
        }
        .cart-btn:hover { border-color: var(--green-base); color: var(--green-base); background: var(--green-pale); }
        .cart-count {
            background: var(--green-base); color: #fff;
            font-size: .68rem; font-weight: 700;
            width: 18px; height: 18px;
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
        }

        /* Auth actions in nav */
        .btn-nav-login {
            border: 1.5px solid #e2e8f0;
            border-radius: 9px; padding: 6px 14px;
            font-size: .84rem; font-weight: 600;
            color: #475569; text-decoration: none;
            transition: all .18s;
        }
        .btn-nav-login:hover { border-color: var(--green-base); color: var(--green-base); }
        .btn-nav-dash {
            background: var(--green-base); color: #fff !important;
            border-radius: 9px; padding: 6px 14px;
            font-size: .84rem; font-weight: 600;
            text-decoration: none;
            transition: background .18s;
        }
        .btn-nav-dash:hover { background: var(--green-dark); }

        /* ── Hero banner ─────────────────────────── */
        .hero-strip {
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-base) 100%);
            color: #fff;
            padding: 56px 0 48px;
            margin-bottom: 0;
        }
        .hero-strip h1 { font-size: 2.2rem; font-weight: 800; margin-bottom: 10px; }
        .hero-strip p  { font-size: 1rem; opacity: .85; margin-bottom: 22px; }
        .hero-search {
            display: flex; gap: 0;
            max-width: 480px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,.15);
        }
        .hero-search input {
            flex: 1; border: none; outline: none;
            padding: 13px 18px; font-size: .9rem; color: #1e293b;
        }
        .hero-search button {
            background: var(--green-base); color: #fff;
            border: none; padding: 13px 20px;
            font-size: .88rem; font-weight: 600; cursor: pointer;
            transition: background .18s;
        }
        .hero-search button:hover { background: var(--green-dark); }

        /* ── Category pills (below hero) ─────────── */
        .cat-pill-row {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 0;
        }
        .cat-pill-scroll {
            display: flex; gap: 8px; overflow-x: auto;
            scrollbar-width: none; -ms-overflow-style: none;
        }
        .cat-pill-scroll::-webkit-scrollbar { display: none; }
        .cat-pill {
            white-space: nowrap;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1.5px solid #e2e8f0;
            font-size: .8rem; font-weight: 600;
            color: #475569; text-decoration: none;
            transition: all .18s; flex-shrink: 0;
        }
        .cat-pill:hover,
        .cat-pill.active {
            background: var(--green-base); color: #fff; border-color: var(--green-base);
        }

        /* ── Product card ────────────────────────── */
        .product-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
            overflow: hidden;
            height: 100%;
            display: flex; flex-direction: column;
            transition: transform .2s, box-shadow .2s;
        }
        .product-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,.09); }
        .product-card .card-img-wrap {
            position: relative; overflow: hidden;
            aspect-ratio: 4/3; background: #f8fafc;
        }
        .product-card .card-img-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform .3s;
        }
        .product-card:hover .card-img-wrap img { transform: scale(1.04); }
        .product-card .card-body { padding: 16px 18px; flex: 1; }
        .product-card .product-name { font-size: .9rem; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
        .product-card .product-desc { font-size: .78rem; color: #64748b; margin-bottom: 10px; line-height: 1.5; }
        .product-card .product-price { font-size: 1.1rem; font-weight: 700; color: var(--green-base); }
        .product-card .card-footer-actions {
            padding: 12px 18px;
            border-top: 1px solid #f1f5f9;
            display: flex; gap: 8px;
        }
        .btn-view-product {
            flex: 1;
            border: 1.5px solid #e2e8f0; border-radius: 9px;
            padding: 8px; font-size: .8rem; font-weight: 600;
            color: #475569; text-align: center; text-decoration: none;
            transition: all .18s;
        }
        .btn-view-product:hover { border-color: var(--green-base); color: var(--green-base); }
        .btn-add-cart {
            flex: 2;
            background: var(--green-base); color: #fff;
            border: none; border-radius: 9px;
            padding: 8px; font-size: .8rem; font-weight: 600;
            text-align: center; text-decoration: none;
            cursor: pointer; transition: background .18s;
        }
        .btn-add-cart:hover { background: var(--green-dark); color: #fff; }

        /* ── Section header ─────────────────────── */
        .section-header { padding: 32px 0 20px; }
        .section-header h2 { font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0; }
        .section-header p  { font-size: .85rem; color: #64748b; margin: 4px 0 0; }

        /* ── Empty state ────────────────────────── */
        .empty-state {
            text-align: center; padding: 64px 24px; color: #94a3b8;
        }
        .empty-state i { font-size: 3rem; margin-bottom: 16px; opacity: .4; }
        .empty-state h5 { font-weight: 700; color: #475569; margin-bottom: 6px; }
        .empty-state p  { font-size: .85rem; }

        /* ── Footer ─────────────────────────────── */
        .footer-nham {
            background: var(--green-dark);
            color: rgba(255,255,255,.75);
            padding: 40px 0 24px;
            margin-top: 64px;
        }
        .footer-brand { font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 6px; }
        .footer-tagline { font-size: .8rem; }
        .footer-links a {
            color: rgba(255,255,255,.6); text-decoration: none;
            font-size: .82rem; transition: color .18s;
        }
        .footer-links a:hover { color: #fff; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.1);
            margin-top: 28px; padding-top: 18px;
            font-size: .78rem; text-align: center;
        }

        /* ── Alert override ─────────────────────── */
        .alert-success { background: var(--green-pale); border-color: var(--green-border); color: var(--green-dark); }

        /* ── Pagination ─────────────────────────── */
        .pagination .page-link { border-radius: 8px !important; border-color: #e2e8f0; color: #475569; font-size: .83rem; }
        .pagination .page-item.active .page-link { background: var(--green-base); border-color: var(--green-base); }
        .pagination { gap: 4px; }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-nham sticky-top">
        <div class="container">
            <a class="navbar-brand-custom" href="{{ url('/') }}">
                <div class="brand-icon"><i class="fas fa-store"></i></div>
                24/7 NHAM
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') || request()->is('list') ? 'active' : '' }}"
                           href="{{ url('/list') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('list') ? 'active' : '' }}"
                           href="{{ url('/list') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('search') ? 'active' : '' }}"
                           href="{{ url('/search') }}">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('frontend*') ? 'active' : '' }}"
                           href="{{ url('/frontend') }}">Categories</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                           data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/list') }}">
                                <i class="fas fa-th-large me-2 text-success"></i>All Products</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item" href="{{ url('/list?category=drink') }}">
                                <i class="fas fa-glass-water me-2 text-info"></i>Drinks</a></li>
                            <li><a class="dropdown-item" href="{{ url('/list?category=food') }}">
                                <i class="fas fa-utensils me-2 text-warning"></i>Food</a></li>
                            <li><a class="dropdown-item" href="{{ url('/list?category=beer') }}">
                                <i class="fas fa-beer-mug-empty me-2 text-warning"></i>Beer</a></li>
                            <li><a class="dropdown-item" href="{{ url('/list?category=sea-food') }}">
                                <i class="fas fa-fish me-2 text-primary"></i>Sea Food</a></li>
                            <li><a class="dropdown-item" href="{{ url('/list?category=ice-cream') }}">
                                <i class="fas fa-ice-cream me-2 text-danger"></i>Ice Cream</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <!-- Cart -->
                    <a href="{{ route('cart') }}" class="cart-btn">
                        <i class="bi bi-cart-fill"></i>
                        Cart
                        @php $cartCount = count((array) session('cart')); @endphp
                        @if($cartCount > 0)
                            <span class="cart-count">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- Auth -->
                    @guest
                        <a href="{{ route('login') }}" class="btn-nav-login">Login</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert">
            <div class="container">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Page content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer-nham">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="footer-brand">
                        <i class="fas fa-store me-2"></i>24/7 NHAM
                    </div>
                    <p class="footer-tagline">Your go-to store for food, drinks & more.</p>
                </div>
                <div class="col-md-4">
                    <div class="fw-600 text-white mb-2" style="font-size:.85rem; font-weight:600">Shop</div>
                    <div class="footer-links d-flex flex-column gap-1">
                        <a href="{{ url('/list') }}">All Products</a>
                        <a href="{{ url('/frontend') }}">Browse Categories</a>
                        <a href="{{ url('/search') }}">Search</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fw-600 text-white mb-2" style="font-size:.85rem; font-weight:600">Account</div>
                    <div class="footer-links d-flex flex-column gap-1">
                        @guest
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @else
                            <a href="{{ route('logout') }}">Logout</a>
                        @endguest
                        <a href="{{ route('cart') }}">My Cart</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} 24/7 NHAM. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- jQuery (required by cart AJAX) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>