<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('page-title', '24/7 NHAM Admin')</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        rel="stylesheet"
    >

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>

        :root {
            --green-dark: #1a4731;
            --green-mid: #166534;
            --green-base: #16a34a;
            --green-light: #22c55e;
            --green-pale: #dcfce7;
            --green-accent: #15803d;

            --sidebar-w: 260px;
            --topbar-h: 64px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0fdf4;
            color: #1e293b;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: var(--sidebar-w);
            height: 100vh;

            background: var(--green-dark);

            display: flex;
            flex-direction: column;

            z-index: 1050;

            transform: translateX(0);
            transition: transform .3s ease;
        }

        .sidebar-logo {
            min-height: var(--topbar-h);

            display: flex;
            align-items: center;

            gap: 10px;

            padding: 14px 20px;

            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-logo .logo-icon {
            width: 36px;
            height: 36px;

            flex-shrink: 0;

            background: var(--green-base);

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
            color: #fff;
        }

        .sidebar-logo span {
            font-size: 1.15rem;
            font-weight: 700;

            color: #fff;

            letter-spacing: .3px;
        }

        .sidebar-toggle {
            margin-left: auto;

            width: 34px;
            height: 34px;

            border: none;
            border-radius: 8px;

            background: rgba(255, 255, 255, .08);

            color: #fff;

            cursor: pointer;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 1rem;
            line-height: 1;

            transition: all .18s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, .15);
            transform: scale(1.05);
        }

        .sidebar-search {
            padding: 12px 16px 14px;

            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-search-form {
            position: relative;
            display: block;
        }

        .sidebar-search-icon {
            position: absolute;

            left: 12px;
            top: 50%;

            transform: translateY(-50%);

            color: rgba(255, 255, 255, .6);

            font-size: .82rem;

            pointer-events: none;

            z-index: 2;
        }

        .sidebar-search input {
            width: 100%;

            border: 1px solid rgba(255, 255, 255, .12);

            background: rgba(255, 255, 255, .06);

            color: #fff;

            border-radius: 10px;

            padding: 10px 42px 10px 34px;

            font-size: .82rem;

            outline: none;

            transition: all .2s ease;
        }

        .sidebar-search input::placeholder {
            color: rgba(255, 255, 255, .55);
        }

        .sidebar-search input:focus {
            border-color: rgba(255, 255, 255, .35);

            background: rgba(255, 255, 255, .08);

            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.08);
        }

        .sidebar-search-clear {
            position: absolute;

            right: 7px;
            top: 50%;

            transform: translateY(-50%);

            width: 28px;
            height: 28px;

            border: none;
            border-radius: 7px;

            background: rgba(255, 255, 255, .10);

            color: rgba(255, 255, 255, .75);

            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: .75rem;

            transition: all .18s ease;
        }

        .sidebar-search-clear:hover {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .sidebar-search-empty {
            padding: 10px 8px 0;

            color: rgba(255, 255, 255, .55);

            font-size: .75rem;

            text-align: center;
        }

        .sidebar-section-label {
            font-size: .65rem;

            font-weight: 600;

            letter-spacing: .1em;

            color: rgba(255, 255, 255, .35);

            padding: 20px 24px 6px;

            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;

            overflow-y: auto;

            padding: 8px 12px;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .15);

            border-radius: 4px;
        }

        .nav-item-link {
            width: 100%;

            display: flex;
            align-items: center;

            gap: 12px;

            padding: 10px 14px;

            margin-bottom: 2px;

            border-radius: 10px;

            color: rgba(255, 255, 255, .7);

            text-decoration: none;

            font-size: .875rem;

            font-weight: 500;

            transition: all .18s;
        }

        .nav-item-link:hover {
            background: rgba(255, 255, 255, .08);

            color: #fff;
        }

        .nav-item-link.active {
            background: var(--green-base);

            color: #fff;

            box-shadow: 0 4px 12px rgba(22, 163, 74, .35);
        }

        .nav-item-link .nav-icon {
            width: 20px;

            flex-shrink: 0;

            text-align: center;

            font-size: .9rem;
        }

        .logout-form {
            margin: 0;
            padding: 0;
        }

        .logout-button {
            background: transparent;

            border: none;

            text-align: left;

            cursor: pointer;
        }

        .sidebar-footer {
            padding: 16px 20px;

            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-user {
            display: flex;
            align-items: center;

            gap: 10px;
        }

        .sidebar-avatar {
            width: 34px;
            height: 34px;

            flex-shrink: 0;

            background: var(--green-base);

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: .85rem;

            color: #fff;

            font-weight: 600;
        }

        .sidebar-user-info {
            flex: 1;

            min-width: 0;
        }

        .sidebar-user-name {
            font-size: .82rem;

            font-weight: 600;

            color: #fff;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: .72rem;

            color: rgba(255, 255, 255, .45);
        }

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

            z-index: 1000;
        }

        #sidebarToggle {
            display: none;

            width: 38px;
            height: 38px;

            border: 1.5px solid #e2e8f0;

            border-radius: 10px;

            background: #fff;

            color: #64748b;

            cursor: pointer;

            font-size: 1rem;

            line-height: 1;

            align-items: center;
            justify-content: center;

            transition: all .18s ease;
        }

        #sidebarToggle:hover {
            background: var(--green-pale);

            border-color: var(--green-base);

            color: var(--green-base);

            transform: scale(1.03);
        }

        .search-wrap {
            position: relative;

            width: 100%;

            max-width: 420px;
        }

        .search-wrap .search-icon {
            position: absolute;

            left: 13px;

            top: 50%;

            transform: translateY(-50%);

            color: #94a3b8;

            font-size: .85rem;

            pointer-events: none;
        }

        .search-wrap input {
            width: 100%;

            padding: 9px 42px 9px 36px;

            border: 1.5px solid #e2e8f0;

            border-radius: 10px;

            font-size: .85rem;

            background: #f8fafc;

            outline: none;

            transition: all .2s;
        }

        .search-wrap input:focus {
            border-color: var(--green-base);

            background: #fff;

            box-shadow: 0 0 0 3px rgba(22, 163, 74, .08);
        }

        .search-button {
            position: absolute;

            right: 5px;

            top: 50%;

            transform: translateY(-50%);

            width: 32px;
            height: 32px;

            border: none;

            border-radius: 7px;

            background: var(--green-base);

            color: #fff;

            cursor: pointer;
        }

        .search-button:hover {
            background: var(--green-accent);
        }

        .topbar-actions {
            margin-left: auto;

            display: flex;

            align-items: center;

            gap: 8px;
        }

        .topbar-icon-btn {
            width: 38px;
            height: 38px;

            border-radius: 10px;

            border: 1.5px solid #e2e8f0;

            background: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #64748b;

            font-size: .9rem;

            cursor: pointer;

            transition: all .18s;

            text-decoration: none;
        }

        .topbar-icon-btn:hover {
            background: var(--green-pale);

            border-color: var(--green-base);

            color: var(--green-base);
        }

        .topbar-user {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 5px 12px 5px 5px;

            border-radius: 12px;

            border: 1.5px solid #e2e8f0;

            cursor: pointer;

            background: #fff;
        }

        .topbar-user:hover {
            border-color: var(--green-base);
        }

        .topbar-avatar {
            width: 32px;
            height: 32px;

            background: linear-gradient(
                135deg,
                var(--green-base),
                var(--green-dark)
            );

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: .8rem;

            color: #fff;

            font-weight: 600;
        }

        .topbar-user-name {
            font-size: .82rem;

            font-weight: 600;

            color: #1e293b;
        }

        .topbar-user-email {
            font-size: .72rem;

            color: #94a3b8;
        }

        #main-content {
            margin-left: var(--sidebar-w);

            padding-top: var(--topbar-h);

            min-height: 100vh;
        }

        .page-inner {
            padding: 28px;
        }

        .sidebar-overlay {
            display: none;

            position: fixed;

            inset: 0;

            background: rgba(0, 0, 0, .4);

            z-index: 1040;

            cursor: pointer;
        }

        .sidebar-overlay.open {
            display: block;
        }

        @media (max-width: 991px) {

            #sidebar {
                transform: translateX(calc(-1 * var(--sidebar-w)));
            }

            #sidebar.open {
                transform: translateX(0);
            }

            #topbar {
                left: 0;

                padding: 0 16px;
            }

            #sidebarToggle {
                display: flex;

                flex-shrink: 0;
            }

            .sidebar-toggle {
                display: flex;
            }

            #main-content {
                margin-left: 0;
            }

            .search-wrap {
                max-width: none;
            }
        }


        @media (max-width: 767px) {

            #topbar {
                gap: 8px;
            }

            .search-wrap {
                max-width: none;
            }

            .topbar-user-info {
                display: none;
            }

            .topbar-user {
                padding: 4px;
            }

            .topbar-icon-btn {
                width: 36px;
                height: 36px;
            }

            .page-inner {
                padding: 18px;
            }
        }


        @media (max-width: 575px) {

            .topbar-actions {
                gap: 5px;
            }

            .topbar-icon-btn.visit-store {
                display: none;
            }

            .search-wrap input {
                padding-left: 34px;
            }

            .page-inner {
                padding: 15px;
            }
        }

    </style>

    @stack('styles')

</head>


<body>

    <div
        class="sidebar-overlay"
        id="sidebarOverlay">
    </div>

    <aside id="sidebar">

        <div class="sidebar-logo">

            <div class="logo-icon">
                <i class="fas fa-store"></i>
            </div>

            <span>24/7 NHAM</span>

            <button
                type="button"
                class="sidebar-toggle"
                id="sidebarCloseButton"
                aria-label="Close sidebar"
                title="Close sidebar">

                <i class="fas fa-chevron-left"></i>

            </button>

        </div>

        <div class="sidebar-search">

            <div class="sidebar-search-form">

                <span class="sidebar-search-icon">
                    <i class="fas fa-search"></i>
                </span>

                <input
                    type="text"
                    id="sidebarSearch"
                    placeholder="Search menu..."
                    autocomplete="off"
                    aria-label="Search sidebar menu">

                <button
                    type="button"
                    id="clearSidebarSearch"
                    class="sidebar-search-clear"
                    title="Clear search"
                    style="display:none;">

                    <i class="fas fa-times"></i>

                </button>

            </div>


            <div
                id="sidebarSearchEmpty"
                class="sidebar-search-empty"
                style="display:none;">

                No menu found

            </div>

        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-label">
                Menu
            </div>


            <!-- Dashboard -->

            <a
                href="{{ route('dashboard') }}"
                class="nav-item-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fas fa-th-large"></i>
                </span>

                <span>Dashboard</span>

            </a>


            <!-- Products -->

            <a
                href="{{ route('product.index') }}"
                class="nav-item-link {{ request()->routeIs('product.*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fas fa-box-open"></i>
                </span>

                <span>Products</span>

            </a>


            <!-- Categories -->

            <a
                href="{{ route('category.list') }}"
                class="nav-item-link {{ request()->routeIs('category.*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fas fa-tags"></i>
                </span>

                <span>Categories</span>

            </a>


            <!-- Books -->

            <a
                href="{{ route('book.index') }}"
                class="nav-item-link {{ request()->routeIs('book.*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fas fa-book"></i>
                </span>

                <span>Books</span>

            </a>


            <!-- Orders -->

            <a
                href="{{ route('admin.order') }}"
                class="nav-item-link {{ request()->routeIs('admin.order*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fas fa-shopping-cart"></i>
                </span>

                <span>Orders</span>

            </a>

            <div class="sidebar-section-label">
                General
            </div>


            <!-- Profile -->

            @auth

                <a
                    href="{{ route('profile.edit', auth()->user()->id) }}"
                    class="nav-item-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                    <span class="nav-icon">
                        <i class="fas fa-user-circle"></i>
                    </span>

                    <span>Profile</span>

                </a>

            @endauth


            <!-- Change Password -->

            <a
                href="{{ route('form.password') }}"
                class="nav-item-link {{ request()->routeIs('form.password') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fas fa-key"></i>
                </span>

                <span>Change Password</span>

            </a>


            <!-- Logout -->

            @auth

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form">

                    @csrf

                    <button
                        type="submit"
                        class="nav-item-link logout-button">

                        <span class="nav-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>

                        <span>Logout</span>

                    </button>

                </form>

            @endauth


        </nav>

        <div class="sidebar-footer">

            @auth

                <div class="sidebar-user">

                    <div class="sidebar-avatar">

                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}

                    </div>


                    <div class="sidebar-user-info">

                        <div class="sidebar-user-name">

                            {{ Auth::user()->name ?? 'User' }}

                        </div>

                        <div class="sidebar-user-role">

                            Administrator

                        </div>

                    </div>

                </div>

            @endauth

        </div>


    </aside>

    <header id="topbar">

        <button
            type="button"
            id="sidebarToggle"
            aria-label="Open sidebar"
            title="Open sidebar">

            <i class="fas fa-bars"></i>

        </button>
        <form
            action="{{ route('product.index') }}"
            method="GET"
            class="search-wrap">

            <i class="fas fa-search search-icon"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search products..."
                autocomplete="off">

            <button
                type="submit"
                class="search-button"
                title="Search">

                <i class="fas fa-search"></i>

            </button>

        </form>

        <div class="topbar-actions">


            <!-- Visit Store -->

            <a
                href="{{ url('/') }}"
                class="topbar-icon-btn visit-store"
                title="Visit Store">

                <i class="fas fa-store"></i>

            </a>


            <!-- Orders -->

            <a
                href="{{ route('admin.order') }}"
                class="topbar-icon-btn"
                title="Orders">

                <i class="fas fa-bell"></i>

            </a>


            <!-- User -->

            @auth

                <div class="topbar-user">

                    <div class="topbar-avatar">

                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}

                    </div>


                    <div class="topbar-user-info">

                        <div class="topbar-user-name">

                            {{ Auth::user()->name ?? 'User' }}

                        </div>

                        <div class="topbar-user-email">

                            {{ Auth::user()->email ?? '' }}

                        </div>

                    </div>

                </div>

            @endauth


        </div>


    </header>

    <main id="main-content">

        <div class="page-inner">
            @if(session('success'))

                <div
                    class="alert alert-success alert-dismissible fade show mb-4"
                    role="alert">

                    <i class="fas fa-check-circle me-2"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            @if($errors->any())

                <div
                    class="alert alert-danger alert-dismissible fade show mb-4"
                    role="alert">

                    <i class="fas fa-exclamation-circle me-2"></i>

                    {{ $errors->first() }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            @yield('content')


        </div>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const sidebar =
                document.getElementById('sidebar');

            const overlay =
                document.getElementById('sidebarOverlay');

            const sidebarToggle =
                document.getElementById('sidebarToggle');

            const sidebarCloseButton =
                document.getElementById('sidebarCloseButton');

            const sidebarSearch =
                document.getElementById('sidebarSearch');

            const clearSidebarSearch =
                document.getElementById('clearSidebarSearch');

            const sidebarSearchEmpty =
                document.getElementById('sidebarSearchEmpty');


            function openSidebar() {

                if (!sidebar) {
                    return;
                }

                sidebar.classList.add('open');

                if (overlay) {
                    overlay.classList.add('open');
                }

                document.body.classList.add('sidebar-open');

            }

            function closeSidebar() {

                if (!sidebar) {
                    return;
                }

                sidebar.classList.remove('open');

                if (overlay) {
                    overlay.classList.remove('open');
                }

                document.body.classList.remove('sidebar-open');

            }

            function toggleSidebar() {

                if (!sidebar) {
                    return;
                }

                if (sidebar.classList.contains('open')) {

                    closeSidebar();

                } else {

                    openSidebar();

                }

            }

            if (sidebarToggle) {

                sidebarToggle.addEventListener('click', function (event) {

                    event.preventDefault();

                    toggleSidebar();

                });

            }

            if (sidebarCloseButton) {

                sidebarCloseButton.addEventListener('click', function (event) {

                    event.preventDefault();

                    closeSidebar();

                });

            }

            if (overlay) {

                overlay.addEventListener('click', function () {

                    closeSidebar();

                });

            }

            if (sidebarSearch) {


                const menuLinks =
                    Array.from(
                        document.querySelectorAll(
                            '.sidebar-nav .nav-item-link'
                        )
                    );


                sidebarSearch.addEventListener('input', function () {


                    const searchText =
                        this.value.trim().toLowerCase();


                    let visibleCount = 0;

                    menuLinks.forEach(function (link) {


                        const titleElement =
                            link.querySelector(
                                'span:not(.nav-icon)'
                            );


                        const title =
                            titleElement
                                ? titleElement.textContent
                                    .trim()
                                    .toLowerCase()
                                : link.textContent
                                    .trim()
                                    .toLowerCase();


                        const logoutForm =
                            link.closest('.logout-form');


                        if (
                            searchText === '' ||
                            title.includes(searchText)
                        ) {


                            link.style.display = 'flex';


                            if (logoutForm) {

                                logoutForm.style.display =
                                    'block';

                            }


                            visibleCount++;


                        } else {


                            link.style.display = 'none';


                            if (logoutForm) {

                                logoutForm.style.display =
                                    'none';

                            }

                        }

                    });

                    document
                        .querySelectorAll(
                            '.sidebar-section-label'
                        )
                        .forEach(function (section) {


                            if (searchText === '') {

                                section.style.display =
                                    'block';

                                return;

                            }


                            let nextElement =
                                section.nextElementSibling;


                            let hasVisibleItem =
                                false;


                            while (nextElement) {


                                if (
                                    nextElement.classList
                                        .contains(
                                            'sidebar-section-label'
                                        )
                                ) {

                                    break;

                                }


                                if (
                                    nextElement.classList
                                        .contains(
                                            'nav-item-link'
                                        ) &&
                                    nextElement.style.display
                                        !== 'none'
                                ) {

                                    hasVisibleItem = true;

                                    break;

                                }


                                if (
                                    nextElement.classList
                                        .contains(
                                            'logout-form'
                                        ) &&
                                    nextElement.style.display
                                        !== 'none'
                                ) {

                                    hasVisibleItem = true;

                                    break;

                                }


                                nextElement =
                                    nextElement.nextElementSibling;

                            }


                            section.style.display =
                                hasVisibleItem
                                    ? 'block'
                                    : 'none';

                        });

                    if (sidebarSearchEmpty) {


                        if (
                            searchText !== '' &&
                            visibleCount === 0
                        ) {

                            sidebarSearchEmpty.style.display =
                                'block';

                        } else {

                            sidebarSearchEmpty.style.display =
                                'none';

                        }

                    }

                    if (clearSidebarSearch) {


                        if (searchText !== '') {

                            clearSidebarSearch.style.display =
                                'flex';

                        } else {

                            clearSidebarSearch.style.display =
                                'none';

                        }

                    }

                });

            }
            if (clearSidebarSearch) {


                clearSidebarSearch.addEventListener(
                    'click',
                    function () {


                        if (!sidebarSearch) {
                            return;
                        }


                        sidebarSearch.value = '';


                        sidebarSearch.dispatchEvent(
                            new Event(
                                'input',
                                {
                                    bubbles: true
                                }
                            )
                        );


                        sidebarSearch.focus();

                    }
                );

            }

            document
                .querySelectorAll(
                    '.sidebar-nav .nav-item-link'
                )
                .forEach(function (link) {


                    link.addEventListener(
                        'click',
                        function () {

                            if (
                                window.innerWidth <= 991
                            ) {

                                closeSidebar();

                            }
                        }
                    );
                });

            window.addEventListener(
                'resize',
                function () {


                    if (
                        window.innerWidth > 991
                    ) {

                        closeSidebar();

                    }

                }
            );

            document.addEventListener(
                'keydown',
                function (event) {
                    if (
                        event.key === 'Escape'
                    ) {
                        closeSidebar();
                    }
                }
            );
        });
    </script>
    @stack('scripts')
</body>
</html>