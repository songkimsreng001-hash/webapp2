<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('page-title', '24/7 NHAM Admin')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
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

        /* --- TOPBAR --- */
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
            justify-content: space-between;
            padding: 0 24px;
            z-index: 1040;
            transition: left .3s ease, right .3s ease;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #475569;
            cursor: pointer;
        }

        /* --- MAIN CONTENT CONTAINER --- */
        #main-wrapper {
            margin-top: var(--topbar-h);
            margin-left: var(--sidebar-w);
            padding: 24px;
            min-height: calc(100vh - var(--topbar-h));
            transition: margin-left .3s ease;
        }

        /* --- MOBILE RESPONSIVE VIEWS --- */
        @media (max-width: 991.98px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.show {
                transform: translateX(0);
            }
            #topbar {
                left: 0;
            }
            #main-wrapper {
                margin-left: 0;
            }
            .mobile-toggle {
                display: block;
            }
            #sidebar-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1045;
            }
            #sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- Backdrop overlay for mobile screens -->
    <div id="sidebar-overlay"></div>

    <!-- Sidebar Layout -->
    <aside id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>
            <span>24/7 NHAM</span>
        </div>

        <div class="sidebar-search">
            <div class="sidebar-search-form">
                <i class="fa-solid fa-magnifying-glass sidebar-search-icon"></i>
                <input type="text" placeholder="Search menu...">
            </div>
        </div>

        <div class="sidebar-section-label">Core Modules</div>
        
        <nav class="sidebar-nav">
            <a href="#" class="nav-item-link active">
                <i class="fa-solid fa-chart-pie nav-icon"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item-link">
                <i class="fa-solid fa-burger nav-icon"></i>
                <span>Products / Items</span>
            </a>
            <a href="#" class="nav-item-link">
                <i class="fa-solid fa-receipt nav-icon"></i>
                <span>Orders</span>
            </a>

            <div class="sidebar-section-label">Account settings</div>
            
            <!-- Safe Form Logout Action -->
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="nav-item-link logout-button">
                    <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </nav>

