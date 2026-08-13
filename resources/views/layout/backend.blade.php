<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title', '24/7 NHAM Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --nham-950:#06351f;
            --nham-900:#074d2d;
            --nham-800:#086b3c;
            --nham-700:#0b7a45;
            --nham-600:#129455;
            --nham-500:#18a85e;
            --nham-100:#e5f7ed;
            --nham-50:#f1fbf5;
            --ink:#14231d;
            --muted:#7b8b84;
            --line:#e8efeb;
            --surface:#ffffff;
            --page:#f7faf8;
            --sidebar-w:248px;
            --topbar-h:76px;
            --radius:18px;
        }

        * { box-sizing:border-box; }
        html,body { margin:0; min-height:100%; }
        body {
            font-family:'Inter',sans-serif;
            background:var(--page);
            color:var(--ink);
            overflow-x:hidden;
        }
        a { text-decoration:none; }
        button,input { font-family:inherit; }

        /* Sidebar */
        #sidebar {
            position:fixed;
            inset:0 auto 0 0;
            width:var(--sidebar-w);
            background:#217a42;
            border-right:1px solid #1a5e33;
            z-index:1050;
            display:flex;
            flex-direction:column;
            transition:transform .25s ease;
        }
        .brand {
            height:var(--topbar-h);
            padding:0 22px;
            display:flex;
            align-items:center;
            gap:11px;
            border-bottom:1px solid rgba(255,255,255,.15);
        }
        .brand-mark {
            width:38px;height:38px;border-radius:12px;
            display:grid;place-items:center;
            color:#fff;background:rgba(255,255,255,.15);
            box-shadow:0 8px 18px rgba(0,0,0,.20);
        }
        .brand-name { font-size:18px;font-weight:800;letter-spacing:-.4px;color:#ffffff; }
        .brand-name span { color:#ffffff; }

        .sidebar-scroll { flex:1;overflow:auto;padding:18px 13px 12px; }
        .sidebar-scroll::-webkit-scrollbar { width:4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background:rgba(255,255,255,.25);border-radius:10px; }

        .sidebar-label {
            padding:13px 13px 8px;
            font-size:10px;font-weight:800;
            text-transform:uppercase;letter-spacing:.12em;
            color:rgba(255,255,255,.65);
        }
        .nav-item-link {
            position:relative;
            width:100%;
            display:flex;align-items:center;gap:12px;
            min-height:44px;padding:10px 13px;
            margin:2px 0;
            border-radius:12px;
            color:rgba(255,255,255,.7);
            font-size:13px;font-weight:600;
            transition:.18s ease;
        }
        .nav-item-link:hover { background:rgba(255,255,255,.15);color:#ffffff; }
        .nav-item-link.active {
            color:#ffffff;
            background:rgba(255,255,255,.2);
        }
        .nav-item-link.active::before {
            content:"";position:absolute;left:-13px;top:8px;bottom:8px;
            width:4px;border-radius:0 5px 5px 0;background:#ffffff;
        }
        .nav-icon {
            width:20px;height:20px;display:grid;place-items:center;flex:none;
        }
        .nav-icon svg { width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:1.8; }
        .nav-badge {
            margin-left:auto;min-width:22px;height:20px;padding:0 6px;
            display:grid;place-items:center;border-radius:8px;
            background:rgba(255,255,255,.2);color:#ffffff;font-size:10px;font-weight:800;
        }
        .logout-form { margin:0; }
        .logout-button { border:0;background:transparent;text-align:left;cursor:pointer;color:rgba(255,255,255,.7); }

        .sidebar-promo {
            margin:12px 10px 15px;
            padding:16px;
            border-radius:17px;
            background:linear-gradient(145deg,#155933,#1a6d3d);
            color:#fff;overflow:hidden;position:relative;
        }
        .sidebar-promo::after {
            content:"";position:absolute;width:100px;height:100px;right:-35px;bottom:-45px;
            border:20px solid rgba(255,255,255,.08);border-radius:50%;
        }
        .promo-title { font-size:12px;font-weight:700;line-height:1.45; }
        .promo-text { margin-top:5px;color:rgba(255,255,255,.58);font-size:10px; }
        .promo-btn {
            display:inline-flex;margin-top:12px;padding:7px 12px;border-radius:9px;
            background:#1fd361;color:#fff;font-size:10px;font-weight:700;
        }

        .sidebar-user {
            padding:13px 18px;
            border-top:1px solid rgba(255,255,255,.15);
            display:flex;align-items:center;gap:10px;
        }
        .avatar {
            width:34px;height:34px;border-radius:50%;display:grid;place-items:center;
            flex:none;background:rgba(255,255,255,.15);color:#ffffff;font-weight:800;font-size:12px;
        }
        .sidebar-user-main { min-width:0;flex:1; }
        .sidebar-user-name { font-size:12px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#ffffff; }
        .sidebar-user-role { font-size:10px;color:rgba(255,255,255,.65);margin-top:2px;text-transform:capitalize; }

        /* Topbar */
        #topbar {
            position:fixed;top:0;left:var(--sidebar-w);right:0;height:var(--topbar-h);
            background:rgba(255,255,255,.94);backdrop-filter:blur(12px);
            border-bottom:1px solid var(--line);z-index:1040;
            display:flex;align-items:center;gap:18px;padding:0 28px;
        }
        .mobile-toggle {
            display:none;border:0;background:transparent;color:#51635b;
            width:38px;height:38px;border-radius:10px;cursor:pointer;
        }
        .mobile-toggle:hover { background:#f2f7f4; }

        .global-search {
            flex:1;max-width:440px;position:relative;
        }
        .global-search input {
            width:100%;height:42px;border:1px solid #e6ece9;background:#f8faf9;
            border-radius:12px;padding:0 72px 0 41px;outline:none;color:#263830;font-size:12px;
        }
        .global-search input:focus { background:#fff;border-color:#b8d9c7;box-shadow:0 0 0 4px rgba(24,168,94,.07); }
        .search-icon { position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a29b; }
        .search-icon svg { width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2; }
        .search-key {
            position:absolute;right:10px;top:50%;transform:translateY(-50%);
            border:1px solid #e3eae6;background:#fff;border-radius:6px;
            padding:2px 6px;color:#a2ada8;font-size:9px;font-weight:700;
        }
        .top-actions { margin-left:auto;display:flex;align-items:center;gap:8px; }
        .top-icon {
            width:38px;height:38px;border:0;background:transparent;border-radius:10px;
            display:grid;place-items:center;color:#64746d;position:relative;cursor:pointer;
        }
        .top-icon:hover { background:#f4f8f5;color:var(--nham-800); }
        .top-icon svg { width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:1.8; }
        .notification-dot {
            position:absolute;top:8px;right:8px;width:6px;height:6px;border-radius:50%;
            background:#e45b45;border:2px solid #fff;box-sizing:content-box;
        }
        .profile {
            display:flex;align-items:center;gap:9px;margin-left:5px;padding-left:12px;
            border-left:1px solid var(--line);cursor:pointer;
        }
        .profile-text { line-height:1.2; }
        .profile-name { font-size:12px;font-weight:700;color:#263830; }
        .profile-email { font-size:9px;color:#9aa59f;margin-top:3px; }
        .profile .avatar { width:36px;height:36px; }

        /* Main */
        #main-wrapper {
            margin-left:var(--sidebar-w);
            padding:calc(var(--topbar-h) + 25px) 28px 34px;
            min-height:100vh;
        }
        .content-container { max-width:1600px;margin:0 auto; }

        .page-header {
            display:flex;align-items:flex-start;justify-content:space-between;gap:15px;
            margin-bottom:22px;
        }
        .page-header h1 { margin:0;font-size:27px;letter-spacing:-.8px;font-weight:800;color:#172a21; }
        .page-header p { margin:5px 0 0;font-size:11px;color:#8a9891; }
        .header-actions { display:flex;gap:9px; }
        .btn-primary-green,.btn-outline-green {
            display:inline-flex;align-items:center;justify-content:center;gap:7px;
            min-height:40px;padding:0 16px;border-radius:11px;font-size:11px;font-weight:700;
            transition:.18s ease;cursor:pointer;
        }
        .btn-primary-green { background:var(--nham-700);color:#fff;border:1px solid var(--nham-700); }
        .btn-primary-green:hover { background:var(--nham-800);color:#fff;transform:translateY(-1px); }
        .btn-outline-green { background:#fff;color:#53625b;border:1px solid #dbe5df; }
        .btn-outline-green:hover { border-color:#a8cdb8;color:var(--nham-800); }

        /* Shared dashboard components */
        .stat-grid { display:grid;grid-template-columns:repeat(4,1fr);gap:15px;margin-bottom:15px; }
        .stat-card {
            min-height:150px;background:#fff;border:1px solid var(--line);border-radius:var(--radius);
            padding:20px;position:relative;overflow:hidden;box-shadow:0 2px 10px rgba(25,55,41,.025);
            transition:.2s ease;
        }
        .stat-card:hover { transform:translateY(-2px);box-shadow:0 10px 25px rgba(25,55,41,.07); }
        .stat-card.green { background:linear-gradient(145deg,#087340,#0c9654);border-color:#0b864b;box-shadow:0 10px 25px rgba(8,115,64,.15); }
        .stat-label { color:#85948c;font-size:11px;font-weight:700;margin-bottom:13px; }
        .stat-card.green .stat-label { color:rgba(255,255,255,.84); }
        .stat-value { font-size:31px;line-height:1;font-weight:800;letter-spacing:-1px;color:#15271f; }
        .stat-card.green .stat-value { color:#fff; }
        .stat-trend { margin-top:13px;font-size:10px;color:#96a29c; }
        .stat-card.green .stat-trend { color:rgba(255,255,255,.72); }
        .trend-badge { display:inline-flex;align-items:center;gap:5px;padding:4px 8px;border-radius:7px;background:#f0f8f3;color:#4c7560;font-weight:700; }
        .stat-card.green .trend-badge { background:rgba(255,255,255,.12);color:#fff; }
        .stat-link,.stat-corner-link {
            position:absolute;right:17px;top:17px;width:31px;height:31px;border-radius:50%;
            display:grid;place-items:center;background:#f3f8f5;color:var(--nham-700);
        }
        .stat-card.green .stat-link { background:rgba(255,255,255,.18);color:#fff; }
        .stat-link svg,.stat-corner-link svg { width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2; }

        .section-row { display:grid;gap:15px;margin-bottom:15px; }
        .section-row.three-col { grid-template-columns:1.25fr 1fr 1fr; }
        .section-row.two-col { grid-template-columns:1fr 1fr; }
        .section-row.left-heavy { grid-template-columns:1.5fr 1fr; }
        .panel {
            background:#fff;border:1px solid var(--line);border-radius:var(--radius);
            box-shadow:0 2px 10px rgba(25,55,41,.025);overflow:hidden;
        }
        .panel-header {
            display:flex;align-items:center;justify-content:space-between;gap:10px;
            padding:17px 19px 13px;border-bottom:1px solid #f0f4f2;
        }
        .panel-title { margin:0;color:#20332a;font-size:12px;font-weight:800; }
        .panel-badge { color:var(--nham-700);background:var(--nham-50);border:1px solid #d9eee2;padding:4px 8px;border-radius:7px;font-size:9px;font-weight:700; }
        .panel-body { padding:17px 19px; }
        .panel-action-btn {
            display:inline-flex;align-items:center;gap:5px;padding:5px 9px;border:1px solid #e1e9e4;
            border-radius:8px;background:#fff;color:#68766f;font-size:9px;font-weight:700;
        }
        .panel-action-btn:hover { color:var(--nham-700);border-color:#b7d7c4; }

        .bar-chart-wrap { height:155px;display:flex;align-items:stretch;gap:12px;padding-top:8px; }
        .bar-col { flex:1;display:flex;flex-direction:column;align-items:center;justify-content:flex-end;gap:6px; }
        .bar-track { flex:1;width:100%;max-width:34px;display:flex;align-items:flex-end; }
        .bar {
            width:100%;min-height:8px;border-radius:9px 9px 5px 5px;
            background:#dbe9e1;position:relative;
        }
        .bar.filled { background:#a6d9bb; }
        .bar.active { background:linear-gradient(180deg,#0a8950,#0b6b3e);box-shadow:0 7px 16px rgba(9,123,69,.18); }
        .bar.striped { background:repeating-linear-gradient(135deg,#eef3f0 0,#eef3f0 3px,#dbe4df 3px,#dbe4df 5px); }
        .bar-day { font-size:9px;color:#9ba7a1;font-weight:700; }

        .mini-stats { display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:12px; }
        .mini-stat { padding:10px;border-radius:11px;background:#f7faf8; }
        .mini-stat strong { display:block;font-size:13px;color:#24372e; }
        .mini-stat span { font-size:9px;color:#99a49e; }

        .reminder-card { background:linear-gradient(145deg,#f0faf4,#e6f7ed);border:1px solid #d4ecde;border-radius:14px;padding:16px; }
        .reminder-label { color:#278354;text-transform:uppercase;letter-spacing:.08em;font-size:8px;font-weight:800; }
        .reminder-title { margin-top:7px;font-size:14px;font-weight:800;color:#173126;line-height:1.35; }
        .reminder-time { margin:7px 0 13px;font-size:9px;color:#7f9188; }
        .btn-start { display:inline-flex;align-items:center;justify-content:center;padding:9px 13px;border-radius:9px;background:var(--nham-700);color:#fff;font-size:9px;font-weight:800; }
        .btn-start:hover { color:#fff;background:var(--nham-800); }

        .project-item { display:flex;align-items:center;gap:9px;padding:9px 0;border-bottom:1px solid #f2f5f3; }
        .project-item:last-child { border-bottom:0; }
        .project-dot { width:8px;height:8px;border-radius:50%;background:var(--nham-600);flex:none; }
        .project-name { flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:10px;font-weight:700;color:#32463d; }
        .project-due { font-size:9px;color:#9ba69f;white-space:nowrap; }

        .team-item { display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid #f1f4f2; }
        .team-item:last-child { border-bottom:0; }
        .team-avatar { width:35px;height:35px;border-radius:50%;display:grid;place-items:center;flex:none;background:#e1f2e8;color:#157044;font-size:11px;font-weight:800; }
        .team-info { flex:1;min-width:0; }
        .team-name { font-size:10px;font-weight:800;color:#263a31; }
        .team-task { margin-top:3px;font-size:9px;color:#8e9b95;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
        .team-status { font-size:8px;font-weight:800;padding:4px 7px;border-radius:7px;white-space:nowrap; }
        .status-done { color:#1c7c4c;background:#e9f7ef; }
        .status-prog { color:#9b7115;background:#fff7dc; }
        .status-pend { color:#bd4e42;background:#fff0ed; }
        .status-review { color:#3167a4;background:#edf4ff; }

        .donut-wrap { display:flex;align-items:center;gap:20px;padding:7px 0; }
        .donut {
            width:145px;height:145px;border-radius:50%;
            background:conic-gradient(#0a8950 var(--approved),#f1b94b 0 var(--paid),#e76c5d 0 var(--rejected),#edf2ef 0);
            position:relative;flex:none;display:grid;place-items:center;
        }
        .donut::after { content:"";width:98px;height:98px;border-radius:50%;background:#fff;position:absolute; }
        .donut-center { position:relative;z-index:1;text-align:center; }
        .donut-center strong { display:block;font-size:22px;color:#15271f;line-height:1; }
        .donut-center span { font-size:8px;color:#9aa69f; }
        .donut-legend { display:grid;gap:10px;font-size:9px;color:#6f7f77; }
        .legend-row { display:flex;align-items:center;gap:7px; }
        .legend-dot { width:8px;height:8px;border-radius:50%;display:inline-block; }

        .time-tracker {
            margin-top:15px;padding:17px;border-radius:15px;color:#fff;
            background:radial-gradient(circle at 80% 10%,rgba(51,187,117,.22),transparent 35%),linear-gradient(145deg,#052b1a,#08713f);
            position:relative;overflow:hidden;text-align:left;
        }
        .time-tracker::after { content:"";position:absolute;inset:0;opacity:.12;background:repeating-radial-gradient(circle at 80% 20%,transparent 0 18px,#fff 19px 20px,transparent 21px 35px); }
        .tracker-label,.tracker-time,.tracker-controls { position:relative;z-index:1; }
        .tracker-label { font-size:9px;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.63);font-weight:700; }
        .tracker-time { margin:14px 0;font-size:25px;font-weight:800;letter-spacing:1px;font-variant-numeric:tabular-nums; }
        .tracker-controls { display:flex;gap:8px; }
        .tracker-btn { width:34px;height:34px;border:0;border-radius:50%;display:grid;place-items:center;cursor:pointer; }
        .tracker-btn.pause { background:rgba(255,255,255,.16);color:#fff; }
        .tracker-btn.stop { background:#e9584c;color:#fff; }
        .tracker-btn svg { width:13px;height:13px;fill:currentColor;stroke:currentColor; }

        .products-table { width:100%;border-collapse:collapse; }
        .products-table th { padding:0 12px 11px;text-align:left;border-bottom:1px solid #eef3f0;font-size:8px;color:#9aa59f;text-transform:uppercase;letter-spacing:.07em; }
        .products-table td { padding:12px;font-size:10px;color:#53635b;border-bottom:1px solid #f2f5f3;vertical-align:middle; }
        .products-table tr:last-child td { border-bottom:0; }
        .products-table tbody tr:hover td { background:#fbfdfc; }
        .product-name { font-size:10px;font-weight:800;color:#293d34; }
        .product-id { margin-top:3px;font-size:8px;color:#a1aaa5; }
        .cat-badge { display:inline-flex;padding:4px 7px;border-radius:6px;background:#eef8f2;color:#2c8155;font-size:8px;font-weight:800; }
        .price-cell { color:#21372b!important;font-weight:800!important; }
        .btn-view { display:inline-flex;padding:5px 8px;border:1px solid #dfe8e3;border-radius:7px;color:#66766d;font-size:8px;font-weight:700; }
        .btn-view:hover { border-color:#acd0ba;color:var(--nham-700); }

        .empty-state { padding:30px 20px;text-align:center;color:#94a19a;font-size:11px; }

        @media (max-width:1200px) {
            :root { --sidebar-w:220px; }
            .stat-grid { grid-template-columns:repeat(2,1fr); }
            .section-row.three-col { grid-template-columns:1fr 1fr; }
            .section-row.three-col > :first-child { grid-column:1 / -1; }
        }
        @media (max-width:991.98px) {
            :root { --sidebar-w:248px; }
            #sidebar { transform:translateX(-100%);box-shadow:20px 0 50px rgba(33,122,66,.25); }
            #sidebar.show { transform:translateX(0); }
            #topbar { left:0;padding:0 17px; }
            #main-wrapper { margin-left:0;padding-left:17px;padding-right:17px; }
            .mobile-toggle { display:grid;place-items:center; }
            #sidebar-overlay { display:none;position:fixed;inset:0;background:rgba(5,28,18,.35);z-index:1045;backdrop-filter:blur(2px); }
            #sidebar-overlay.show { display:block; }
            .global-search { max-width:none; }
            .section-row.three-col,.section-row.two-col,.section-row.left-heavy { grid-template-columns:1fr; }
        }
        @media (max-width:680px) {
            .profile-text { display:none; }
            .profile { padding-left:5px;border-left:0; }
            .top-icon { display:none; }
            .global-search { max-width:none; }
            .global-search input { padding-right:14px; }
            .search-key { display:none; }
            .page-header { flex-direction:column; }
            .header-actions { width:100%; }
            .header-actions a { flex:1; }
            .stat-grid { grid-template-columns:1fr 1fr;gap:10px; }
            .stat-card { min-height:132px;padding:15px; }
            .stat-value { font-size:25px; }
            .stat-card:nth-child(4) { grid-column:1 / -1; }
            .donut-wrap { justify-content:center; }
            .donut-legend { display:none; }
        }
        @media (max-width:430px) {
            .stat-grid { grid-template-columns:1fr; }
            .stat-card:nth-child(4) { grid-column:auto; }
            .global-search { display:none; }
            .page-header h1 { font-size:24px; }
            .header-actions { flex-direction:column; }
            .header-actions a { width:100%; }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="sidebar-overlay"></div>

    <aside id="sidebar" aria-label="Main navigation">
        <div class="brand">
            <div class="brand-mark">
                <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                    <path d="M4 10.5 12 4l8 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5z"/>
                    <path d="M9 20v-6h6v6M7 10h10"/>
                </svg>
            </div>
            <div class="brand-name">24/7 <span>NHAM</span></div>
        </div>

        <div class="sidebar-search" style="padding:14px 14px 2px;">
            <div style="position:relative;">
                <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9aa8a1;">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="6.5"/><path d="m16 16 4 4"/></svg>
                </span>
                <input id="sidebarSearch" type="search" placeholder="Search menu..." style="width:100%;height:38px;border:1px solid #e6ece9;background:#f7faf8;border-radius:10px;padding:0 10px 0 34px;outline:none;color:#31433a;font-size:11px;">
            </div>
        </div>
        <div class="sidebar-scroll" id="sidebarScroll">
            <div class="sidebar-label">Menu</div>
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="nav-item-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="4" y="4" width="6" height="6" rx="1"/><rect x="14" y="4" width="6" height="6" rx="1"/><rect x="4" y="14" width="6" height="6" rx="1"/><rect x="14" y="14" width="6" height="6" rx="1"/></svg></span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('product.index') }}" class="nav-item-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="m5 7 7-3 7 3-7 3z"/><path d="M5 7v10l7 3 7-3V7M12 10v10"/></svg></span>
                    <span>Products</span>
                </a>
                <a href="{{ route('category.list') }}" class="nav-item-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M4 6h7v5H4zM13 6h7v5h-7zM4 13h7v5H4zM13 13h7v5h-7z"/></svg></span>
                    <span>Categories</span>
                </a>
                <a href="{{ route('admin.order') }}" class="nav-item-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M6 3h12v18H6z"/><path d="M9 7h6M9 11h6M9 15h4"/></svg></span>
                    <span>Orders</span>
                    @php $sidebarOrderCount = \App\Models\Order::whereIn('status',[1,2])->count(); @endphp
                    @if($sidebarOrderCount)
                        <span class="nav-badge">{{ $sidebarOrderCount > 99 ? '99+' : $sidebarOrderCount }}</span>
                    @endif
                </a>
            </nav>

            <div class="sidebar-label">General</div>
            <nav>
                <a href="{{ route('profile.edit', auth()->id()) }}" class="nav-item-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <span class="nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3"/><path d="M5 20c.8-3.4 3.2-5 7-5s6.2 1.6 7 5"/></svg></span>
                    <span>Profile</span>
                </a>
                <a href="{{ url('/contact') }}" class="nav-item-link">
                    <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M4 5h16v12H8l-4 3z"/><path d="M8 9h8M8 13h5"/></svg></span>
                    <span>Help & Support</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="nav-item-link logout-button">
                        <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M10 5H5v14h5M13 8l4 4-4 4M17 12H9"/></svg></span>
                        <span>Log Out</span>
                    </button>
                </form>
            </nav>

            <div class="sidebar-promo">
                <div class="promo-title">Manage your shop faster</div>
                <div class="promo-text">Add products and keep your orders organized from one place.</div>
                <a class="promo-btn" href="{{ route('product.create') }}">Add Product</a>
            </div>
        </div>

        <div class="sidebar-user">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}</div>
            <div class="sidebar-user-main">
                <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                <div class="sidebar-user-role">{{ auth()->user()->role ?? 'admin' }}</div>
            </div>
        </div>
    </aside>

    <header id="topbar">
        <button class="mobile-toggle" id="sidebar-toggle" type="button" aria-label="Open navigation">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <form class="global-search" id="globalSearchForm" action="{{ url('/search') }}" method="GET">
            <span class="search-icon"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6.5"/><path d="m16 16 4 4"/></svg></span>
            <input id="globalSearchInput" name="keyword" type="search" placeholder="Search products..." autocomplete="off">
            <span class="search-key">Ctrl K</span>
        </form>

        <div class="top-actions">
            <button class="top-icon" type="button" aria-label="Messages">
                <svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="14" rx="2"/><path d="m5 7 7 5 7-5"/></svg>
            </button>
            <button class="top-icon" type="button" aria-label="Notifications">
                <span class="notification-dot"></span>
                <svg viewBox="0 0 24 24"><path d="M18 10a6 6 0 0 0-12 0c0 7-3 7-3 8h18c0-1-3-1-3-8M10 21h4"/></svg>
            </button>
            <div class="profile">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}</div>
                <div class="profile-text">
                    <div class="profile-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                    <div class="profile-email">{{ auth()->user()->email ?? '' }}</div>
                </div>
            </div>
        </div>
    </header>

    <main id="main-wrapper">
        <div class="content-container">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-3">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggle = document.getElementById('sidebar-toggle');

            function closeSidebar() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }
            function openSidebar() {
                sidebar.classList.add('show');
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            toggle?.addEventListener('click', function () {
                sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
            });
            overlay?.addEventListener('click', closeSidebar);
            document.querySelectorAll('#sidebar a').forEach(a => {
                a.addEventListener('click', function () {
                    if (window.innerWidth <= 991) closeSidebar();
                });
            });

            // Sidebar search: filter menu items by title and restore on clear.
            const sidebarSearch = document.getElementById('sidebarSearch');
            if (sidebarSearch) {
                sidebarSearch.addEventListener('input', function () {
                    const q = this.value.trim().toLowerCase();
                    document.querySelectorAll('.sidebar-nav .nav-item-link').forEach(item => {
                        const text = item.innerText.toLowerCase();
                        item.style.display = !q || text.includes(q) ? 'flex' : 'none';
                    });
                });
            }

            // Ctrl/Cmd + K focuses the product search.
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    document.getElementById('globalSearchInput')?.focus();
                }
                if (e.key === 'Escape') {
                    document.getElementById('globalSearchInput')?.blur();
                }
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
