<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="24/7 NHAM — Food, Drinks & More" />

    <title>@yield('page-title', '24/7 NHAM')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
           GLOBAL
        ========================================================= */
        :root {
            --green-dark: #166534;
            --green-base: #16a34a;
            --green-light: #22c55e;
            --green-pale: #f0fdf4;
            --green-border: #bbf7d0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #fafafa;
            color: #1e293b;
        }

        /* =========================================================
           NAVBAR
        ========================================================= */
        .navbar-nham {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            padding: 0;
        }

        .navbar-nham .container {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 9px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--green-dark) !important;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: var(--green-base);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .9rem;
            flex-shrink: 0;
        }

        .navbar-nham .nav-link {
            color: #475569 !important;
            font-size: .87rem;
            font-weight: 500;
            padding: 6px 12px !important;
            border-radius: 8px;
            transition: all .18s;
        }

        .navbar-nham .nav-link:hover,
        .navbar-nham .nav-link.active {
            color: var(--green-base) !important;
            background: var(--green-pale);
        }

        /* =========================================================
           DROPDOWN
        ========================================================= */
        .navbar-nham .dropdown-menu {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
            padding: 6px;
        }

        .navbar-nham .dropdown-item {
            border-radius: 8px;
            font-size: .86rem;
            padding: 7px 12px;
            color: #374151;
        }

        .navbar-nham .dropdown-item:hover {
            background: var(--green-pale);
            color: var(--green-base);
        }

        /* =========================================================
           NAVBAR SEARCH
        ========================================================= */
        .navbar-search-wrapper {
            position: relative;
            width: 300px;
            z-index: 1050;
        }

        .navbar-search {
            width: 100%;
            height: 40px;
            display: flex;
            align-items: center;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            transition: all .18s ease;
        }

        .navbar-search:focus-within {
            border-color: var(--green-base);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, .10);
        }

        .navbar-search-icon {
            padding-left: 12px;
            color: #94a3b8;
            font-size: 15px;
            flex-shrink: 0;
        }

        .navbar-search-input {
            width: 100%;
            height: 100%;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            padding: 0 9px;
            font-size: .82rem;
            color: #1e293b;
            background: transparent;
        }

        .navbar-search-input::placeholder {
            color: #94a3b8;
        }

        .navbar-search-button {
            height: 100%;
            border: none;
            background: var(--green-base);
            color: #fff;
            padding: 0 13px;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .18s;
        }

        .navbar-search-button:hover {
            background: var(--green-dark);
        }

        /* =========================================================
           AUTO SEARCH DROPDOWN
        ========================================================= */
        .navbar-search-results {
            display: none;
            position: absolute;
            top: calc(100% + 7px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .12);
            overflow: hidden;
            max-height: 380px;
            overflow-y: auto;
            z-index: 9999;
        }

        .navbar-search-results.show {
            display: block;
        }

        .navbar-search-result {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 12px;
            color: #1e293b;
            text-decoration: none;
            border-bottom: 1px solid #f1f5f9;
            transition: background .15s ease;
            cursor: pointer;
        }

        .navbar-search-result:last-child {
            border-bottom: none;
        }

        .navbar-search-result:hover {
            background: var(--green-pale);
        }

        .navbar-search-result-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--green-pale);
            color: var(--green-base);
            border-radius: 8px;
        }

        .navbar-search-result-info {
            min-width: 0;
            flex: 1;
        }

        .navbar-search-result-title {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .navbar-search-result-price {
            display: block;
            margin-top: 2px;
            font-size: .74rem;
            font-weight: 600;
            color: var(--green-base);
        }

        .navbar-search-loading,
        .navbar-search-empty {
            padding: 18px;
            text-align: center;
            color: #64748b;
            font-size: .8rem;
        }

        .navbar-search-empty i {
            display: block;
            margin-bottom: 6px;
            font-size: 20px;
            color: #94a3b8;
        }

        /* =========================================================
           CART & AUTH
        ========================================================= */
        .cart-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 7px 14px;
            background: #fff;
            color: #1e293b;
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .18s;
            position: relative;
            white-space: nowrap;
        }

        .cart-btn:hover {
            border-color: var(--green-base);
            color: var(--green-base);
            background: var(--green-pale);
        }

        .cart-count {
            background: var(--green-base);
            color: #fff;
            font-size: .68rem;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-nav-login {
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            padding: 6px 14px;
            font-size: .84rem;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            transition: all .18s;
        }

        .btn-nav-login:hover {
            border-color: var(--green-base);
            color: var(--green-base);
        }

        .btn-nav-logout {
            border: 1.5px solid #ef4444;
            border-radius: 9px;
            padding: 6px 14px;
            font-size: .84rem;
            font-weight: 600;
            color: #ef4444;
            text-decoration: none;
            background: transparent;
            transition: all .18s;
        }

        .btn-nav-logout:hover {
            background: #ef4444;
            color: #fff;
            border-color: #dc2626;
        }

        .btn-nav-dash {
            background: var(--green-base);
            color: #fff !important;
            border-radius: 9px;
            padding: 6px 14px;
            font-size: .84rem;
            font-weight: 600;
            text-decoration: none;
            transition: background .18s;
        }

        .btn-nav-dash:hover {
            background: var(--green-dark);
        }

        /* =========================================================
           HERO & CATEGORIES
        ========================================================= */
        .hero-strip {
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-base) 100%);
            color: #fff;
            padding: 56px 0 48px;
            margin-bottom: 0;
        }

        .hero-strip h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .hero-strip p {
            font-size: 1rem;
            opacity: .85;
            margin-bottom: 22px;
        }

        .hero-search {
            display: flex;
            gap: 0;
            max-width: 480px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .15);
        }

        .hero-search input {
            flex: 1;
            border: none;
            outline: none;
            padding: 13px 18px;
            font-size: .9rem;
            color: #1e293b;
        }

        .hero-search button {
            background: var(--green-base);
            color: #fff;
            border: none;
            padding: 13px 20px;
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .18s;
        }

        .hero-search button:hover {
            background: var(--green-dark);
        }

        .cat-pill-row {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 0;
        }

        .cat-pill-scroll {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .cat-pill-scroll::-webkit-scrollbar {
            display: none;
        }

        .cat-pill {
            white-space: nowrap;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1.5px solid #e2e8f0;
            font-size: .8rem;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            transition: all .18s;
            flex-shrink: 0;
        }

        .cat-pill:hover,
        .cat-pill.active {
            background: var(--green-base);
            color: #fff;
            border-color: var(--green-base);
        }

        /* =========================================================
           PRODUCT CARD
        ========================================================= */
        .product-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform .2s, box-shadow .2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .09);
        }

        .product-card .card-img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            background: #f8fafc;
        }

        .product-card .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s;
        }

        .product-card:hover .card-img-wrap img {
            transform: scale(1.04);
        }

        .product-card .card-body {
            padding: 16px 18px;
            flex: 1;
        }

        .product-card .product-name {
            font-size: .9rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .product-card .product-desc {
            font-size: .78rem;
            color: #64748b;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .product-card .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--green-base);
        }

        .product-card .card-footer-actions {
            padding: 12px 18px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 8px;
        }

        .btn-view-product {
            flex: 1;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            padding: 8px;
            font-size: .8rem;
            font-weight: 600;
            color: #475569;
            text-align: center;
            text-decoration: none;
            transition: all .18s;
        }

        .btn-view-product:hover {
            border-color: var(--green-base);
            color: var(--green-base);
        }

        .btn-add-cart {
            flex: 2;
            background: var(--green-base);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 8px;
            font-size: .8rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background .18s;
        }

        .btn-add-cart:hover {
            background: var(--green-dark);
            color: #fff;
        }

        /* =========================================================
           SECTION & EMPTY STATE
        ========================================================= */
        .section-header {
            padding: 32px 0 20px;
        }

        .section-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .section-header p {
            font-size: .85rem;
            color: #64748b;
            margin: 4px 0 0;
        }

        .empty-state {
            text-align: center;
            padding: 64px 24px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 16px;
            opacity: .4;
        }

        .empty-state h5 {
            font-weight: 700;
            color: #475569;
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: .85rem;
        }

        /* =========================================================
           FOOTER & UTILS
        ========================================================= */
        .footer-nham {
            background: var(--green-dark);
            color: rgba(255, 255, 255, .75);
            padding: 40px 0 24px;
            margin-top: 64px;
        }

        .footer-brand {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
        }

        .footer-tagline {
            font-size: .8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, .6);
            text-decoration: none;
            font-size: .82rem;
            transition: color .18s;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .1);
            margin-top: 28px;
            padding-top: 18px;
            font-size: .78rem;
            text-align: center;
        }

        .alert-success {
            background: var(--green-pale);
            border-color: var(--green-border);
            color: var(--green-dark);
        }

        .pagination .page-link {
            border-radius: 8px !important;
            border-color: #e2e8f0;
            color: #475569;
            font-size: .83rem;
        }

        .pagination .page-item.active .page-link {
            background: var(--green-base);
            border-color: var(--green-base);
        }

        .pagination {
            gap: 4px;
        }

        /* =========================================================
           RESPONSIVE NAVBAR SEARCH
        ========================================================= */
        @media (max-width: 1199.98px) {
            .navbar-search-wrapper {
                width: 240px;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-search-wrapper {
                width: 100%;
                margin-top: 12px;
                margin-bottom: 10px;
            }

            .navbar-search-results {
                width: 100%;
            }

            .navbar-search {
                height: 42px;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-search-button {
                padding: 0 11px;
            }

            .navbar-search-input {
                font-size: .8rem;
            }

            .cart-btn {
                padding: 7px 11px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- =========================================================
         NAVBAR
    ========================================================= -->
    <nav class="navbar navbar-expand-lg navbar-nham sticky-top">
        <div class="container">

            <!-- BRAND -->
            <a class="navbar-brand-custom" href="{{ url('/') }}">
                <div class="brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                24/7 NHAM
            </a>

            <!-- MOBILE TOGGLE -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">

                <!-- NAVIGATION -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') || request()->is('list') ? 'active' : '' }}"
                            href="{{ url('/list') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('list') ? 'active' : '' }}" href="{{ url('/list') }}">
                            Products
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('frontend*') ? 'active' : '' }}"
                            href="{{ url('/frontend') }}">
                            Categories
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Shop
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('/list') }}">
                                    <i class="fas fa-th-large me-2 text-success"></i> All Products
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/list?category=drink') }}">
                                    <i class="fas fa-glass-water me-2 text-info"></i> Drinks
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/list?category=food') }}">
                                    <i class="fas fa-utensils me-2 text-warning"></i> Food
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/list?category=beer') }}">
                                    <i class="fas fa-beer-mug-empty me-2 text-warning"></i> Beer
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/list?category=sea-food') }}">
                                    <i class="fas fa-fish me-2 text-primary"></i> Sea Food
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/list?category=ice-cream') }}">
                                    <i class="fas fa-ice-cream me-2 text-danger"></i> Ice Cream
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- RIGHT SIDE ACTIONS -->
                <div class="d-flex align-items-center gap-2">

                    <!-- NAVBAR SEARCH -->
                    <div class="navbar-search-wrapper">
                        <form action="{{ url('/search') }}" method="GET" id="navbarSearchForm" autocomplete="off">
                            <div class="navbar-search">
                                <i class="bi bi-search navbar-search-icon"></i>
                                <input type="text" name="title" id="navbarSearchInput" class="navbar-search-input"
                                    value="{{ request('title') }}" placeholder="Search product title..."
                                    autocomplete="off">
                                <button type="submit" class="navbar-search-button">
                                    Search
                                </button>
                            </div>
                        </form>

                        <!-- AUTO SEARCH RESULTS DROPDOWN -->
                        <div id="navbarSearchResults" class="navbar-search-results"></div>
                    </div>

                    <!-- CART -->
                    <a href="{{ route('cart') }}" class="cart-btn">
                        <i class="bi bi-cart-fill"></i>
                        Cart
                        @php $cartCount = count((array) session('cart')); @endphp
                        @if($cartCount > 0)
                            <span class="cart-count">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- LOGIN / LOGOUT -->
                    @guest
                        <a href="{{ route('login') }}" class="btn-nav-login">
                            Login
                        </a>
                    @else
                        <a href="{{ route('logout') }}" class="btn-nav-logout">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Logout
                        </a>
                    @endguest

                </div>
            </div>
        </div>
    </nav>

    <!-- =========================================================
         FLASH MESSAGE
    ========================================================= -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert">
            <div class="container">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- =========================================================
         PAGE CONTENT
    ========================================================= -->
    @yield('content')

    <!-- =========================================================
         FOOTER
    ========================================================= -->
    <footer class="footer-nham">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="footer-brand">
                        <i class="fas fa-store me-2"></i> 24/7 NHAM
                    </div>
                    <p class="footer-tagline">Your go-to store for food, drinks & more.</p>
                </div>

                <div class="col-md-4">
                    <div class="text-white mb-2" style="font-size:.85rem; font-weight:600">Shop</div>
                    <div class="footer-links d-flex flex-column gap-1">
                        <a href="{{ url('/list') }}">All Products</a>
                        <a href="{{ url('/frontend') }}">Browse Categories</a>
                        <a href="{{ url('/search') }}">Search</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="text-white mb-2" style="font-size:.85rem; font-weight:600">Account</div>
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

    <!-- =========================================================
         JAVASCRIPT
    ========================================================= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('navbarSearchInput');
            const searchResults = document.getElementById('navbarSearchResults');
            const searchForm = document.getElementById('navbarSearchForm');

            if (!searchInput || !searchResults) return;

            let searchTimer = null;

            function escapeHtml(value) {
                const div = document.createElement('div');
                div.textContent = value ?? '';
                return div.innerHTML;
            }

            function closeSearchResults() {
                searchResults.classList.remove('show');
            }

            function showSearchResults() {
                searchResults.classList.add('show');
            }

            /* =====================================================
               INPUT EVENT
            ===================================================== */
            searchInput.addEventListener('input', function () {
                const keyword = this.value.trim();
                clearTimeout(searchTimer);

                if (keyword.length === 0) {
                    searchResults.innerHTML = '';
                    closeSearchResults();
                    return;
                }

                if (keyword.length < 2) {
                    searchResults.innerHTML = `
                        <div class="navbar-search-empty">
                            <i class="bi bi-search"></i>
                            Type at least 2 characters
                        </div>`;
                    showSearchResults();
                    return;
                }

                searchResults.innerHTML = `
                    <div class="navbar-search-loading">
                        <i class="bi bi-arrow-repeat me-1"></i>
                        Searching products...
                    </div>`;
                showSearchResults();

                searchTimer = setTimeout(function () {
                    const url = `{{ url('/navbar-search') }}?title=${encodeURIComponent(keyword)}`;

                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Search request failed');
                        return response.json();
                    })
                    .then(products => {
                        searchResults.innerHTML = '';

                        if (!products.length) {
                            searchResults.innerHTML = `
                                <div class="navbar-search-empty">
                                    <i class="bi bi-search"></i>
                                    No product found for <strong>"${escapeHtml(keyword)}"</strong>
                                </div>`;
                            showSearchResults();
                            return;
                        }

                        products.forEach(product => {
                            const result = document.createElement('div');
                            result.className = 'navbar-search-result';
                            result.setAttribute('data-title', product.title);

                            let priceHtml = '';
                            if (product.price !== null && product.price !== undefined && product.price !== '') {
                                priceHtml = `<span class="navbar-search-result-price">$${escapeHtml(product.price)}</span>`;
                            }

                            result.innerHTML = `
                                <div class="navbar-search-result-icon">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="navbar-search-result-info">
                                    <span class="navbar-search-result-title">${escapeHtml(product.title)}</span>
                                    ${priceHtml}
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            `;

                            searchResults.appendChild(result);
                        });

                        showSearchResults();
                    })
                    .catch(error => {
                        console.error(error);
                        searchResults.innerHTML = `
                            <div class="navbar-search-empty text-danger">
                                <i class="bi bi-exclamation-circle"></i>
                                Unable to search products.
                            </div>`;
                        showSearchResults();
                    });
                }, 300);
            });

            /* =====================================================
               FOCUS & BLUR
            ===================================================== */
            searchInput.addEventListener('focus', function () {
                if (this.value.trim().length >= 2 && searchResults.innerHTML.trim() !== '') {
                    showSearchResults();
                }
            });

            document.addEventListener('click', function (event) {
                const wrapper = document.querySelector('.navbar-search-wrapper');
                if (wrapper && !wrapper.contains(event.target)) {
                    closeSearchResults();
                }
            });

            /* =====================================================
               AUTO-FILL SEARCH INPUT ON RESULT CLICK
            ===================================================== */
            searchResults.addEventListener('click', function (event) {
                const resultItem = event.target.closest('.navbar-search-result');
                if (resultItem) {
                    const productTitle = resultItem.getAttribute('data-title');
                    if (productTitle) {
                        searchInput.value = productTitle;
                        closeSearchResults();
                        // Submit form automatically upon selection
                        searchForm.submit(); 
                    }
                }
            });

            /* =====================================================
               FORM SUBMIT
            ===================================================== */
            searchForm.addEventListener('submit', function (event) {
                const keyword = searchInput.value.trim();
                if (keyword.length === 0) {
                    event.preventDefault();
                    searchInput.focus();
                    return;
                }
                closeSearchResults();
            });
        });
    </script>

    @stack('scripts')
</body>

</html>