<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>24/7 NHAM</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --green-base: #16a34a;
            --green-dark: #166534;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f0fdf4;
            min-height: 100vh;
        }
        .navbar-nham {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
        }
        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--green-dark) !important;
            display: flex; align-items: center; gap: 8px;
        }
        .brand-icon {
            width: 30px; height: 30px;
            background: var(--green-base);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: .85rem;
        }
        .nav-link { color: #475569 !important; font-size: .88rem; font-weight: 500; }
        .nav-link:hover { color: var(--green-base) !important; }
        .btn-nav-primary {
            background: var(--green-base); color: #fff !important;
            border-radius: 8px; padding: 6px 16px;
            font-size: .85rem; font-weight: 600;
            transition: background .18s;
        }
        .btn-nav-primary:hover { background: var(--green-dark) !important; }

        /* Auth card */
        .auth-wrap { min-height: calc(100vh - 65px); display: flex; align-items: center; }
        .auth-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 32px rgba(0,0,0,.06);
            overflow: hidden;
        }
        .auth-card-header {
            background: linear-gradient(135deg, var(--green-dark), var(--green-base));
            padding: 28px 28px 24px;
            text-align: center;
        }
        .auth-card-header .auth-icon {
            width: 52px; height: 52px;
            background: rgba(255,255,255,.2);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff;
            margin: 0 auto 12px;
        }
        .auth-card-header h4 { color: #fff; font-weight: 700; font-size: 1.2rem; margin: 0; }
        .auth-card-header p  { color: rgba(255,255,255,.75); font-size: .83rem; margin: 5px 0 0; }
        .auth-card-body { padding: 28px; }

        .form-label { font-size: .82rem; font-weight: 600; color: #374151; margin-bottom: 5px; }
        .input-group-text {
            background: #f8fafc; border-right: none;
            border-color: #e2e8f0; color: #94a3b8;
        }
        .form-control {
            border-left: none; border-color: #e2e8f0;
            font-size: .88rem;
        }
        .form-control:focus {
            border-color: var(--green-base);
            box-shadow: 0 0 0 3px rgba(22,163,74,.12);
        }
        .input-group:focus-within .input-group-text {
            border-color: var(--green-base);
        }
        .btn-submit {
            background: var(--green-base); color: #fff;
            border: none; border-radius: 10px;
            padding: 10px 24px; font-size: .88rem; font-weight: 600;
            width: 100%; transition: background .18s;
        }
        .btn-submit:hover { background: var(--green-dark); color: #fff; }
        .auth-link { color: var(--green-base); font-weight: 500; font-size: .83rem; }
        .auth-link:hover { color: var(--green-dark); }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-nham">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="{{ url('/') }}">
                <div class="brand-icon"><i class="fas fa-store"></i></div>
                24/7 NHAM
            </a>
            <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-nav-primary ms-1" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-th-large me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                               id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-th-large me-2 text-success"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit', auth()->user()->id) }}">
                                    <i class="fas fa-user-edit me-2 text-primary"></i> Edit Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('form.password') }}">
                                    <i class="fas fa-key me-2 text-warning"></i> Change Password</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="auth-wrap py-4">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>