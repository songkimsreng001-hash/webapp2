@extends('layout.backend')
@section('page-title', 'Dashboard — 24/7 NHAM')

@push('styles')
<style>
    /* ── Stat cards ─────────────────────────── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }
    @media (max-width: 1200px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px)  { .stat-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
        border: 1px solid #f1f5f9;
        position: relative;
        overflow: hidden;
        transition: transform .2s, box-shadow .2s;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.09); }
    .stat-card.green {
        background: linear-gradient(135deg, #166534, #16a34a);
        border: none;
    }
    .stat-card.green .stat-label,
    .stat-card.green .stat-value,
    .stat-card.green .stat-trend { color: #fff !important; }
    .stat-card.green .stat-trend { color: rgba(255,255,255,.75) !important; }
    .stat-card.green .stat-link {
        width: 32px; height: 32px;
        background: rgba(255,255,255,.2);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: .8rem;
        position: absolute; top: 20px; right: 20px;
        text-decoration: none;
        transition: background .18s;
    }
    .stat-card.green .stat-link:hover { background: rgba(255,255,255,.35); }
    .stat-corner-link {
        width: 30px; height: 30px;
        background: #f0fdf4;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #16a34a; font-size: .75rem;
        position: absolute; top: 20px; right: 20px;
        text-decoration: none;
        transition: background .18s;
    }
    .stat-corner-link:hover { background: #dcfce7; }
    .stat-label { font-size: .78rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 8px; }
    .stat-value { font-size: 2.2rem; font-weight: 700; color: #0f172a; line-height: 1; margin-bottom: 8px; }
    .stat-trend { font-size: .78rem; color: #64748b; display: flex; align-items: center; gap: 5px; }
    .trend-up { color: #16a34a; }
    .trend-badge {
        display: inline-flex; align-items: center; gap: 4px;
        background: #dcfce7; color: #15803d;
        padding: 2px 8px; border-radius: 20px;
        font-size: .72rem; font-weight: 600;
    }

    /* ── Section row ─────────────────────────── */
    .section-row {
        display: grid;
        gap: 18px;
        margin-bottom: 24px;
    }
    .section-row.two-col   { grid-template-columns: 1fr 1fr; }
    .section-row.three-col { grid-template-columns: 1fr 1fr 1fr; }
    .section-row.left-heavy { grid-template-columns: 1.45fr 1fr; }
    @media (max-width: 991px) {
        .section-row.two-col,
        .section-row.three-col,
        .section-row.left-heavy { grid-template-columns: 1fr; }
    }

    /* ── Panel ───────────────────────────────── */
    .panel {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        overflow: hidden;
    }
    .panel-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 18px 22px 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .panel-title { font-size: .92rem; font-weight: 700; color: #0f172a; margin: 0; }
    .panel-body { padding: 18px 22px; }
    .panel-badge {
        background: #f0fdf4; color: #15803d;
        font-size: .73rem; font-weight: 600;
        padding: 3px 10px; border-radius: 20px;
        border: 1px solid #bbf7d0;
    }
    .panel-action-btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fff; border: 1.5px solid #e2e8f0;
        border-radius: 8px; color: #475569;
        font-size: .78rem; font-weight: 500;
        padding: 5px 12px; text-decoration: none;
        transition: all .18s;
    }
    .panel-action-btn:hover { border-color: #16a34a; color: #16a34a; }

    /* ── Chart bar (weekly activity) ─────────── */
    .bar-chart-wrap {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        height: 120px;
        padding: 0 4px;
    }
    .bar-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; }
    .bar-track { flex: 1; width: 100%; display: flex; align-items: flex-end; }
    .bar {
        width: 100%; border-radius: 8px 8px 0 0;
        min-height: 6px;
        transition: height .3s ease;
        position: relative;
    }
    .bar.filled     { background: #16a34a; }
    .bar.active     { background: linear-gradient(180deg, #22c55e, #16a34a); box-shadow: 0 4px 12px rgba(22,163,74,.3); }
    .bar.striped    { background: repeating-linear-gradient(45deg, #e2e8f0 0, #e2e8f0 3px, #f8fafc 3px, #f8fafc 9px); border: 1.5px solid #e2e8f0; }
    .bar-day { font-size: .7rem; color: #94a3b8; font-weight: 500; }

    /* ── Project list (right panel) ──────────── */
    .project-item {
        display: flex; align-items: center; gap: 12px;
        padding: 9px 0;
        border-bottom: 1px solid #f8fafc;
    }
    .project-item:last-child { border-bottom: none; padding-bottom: 0; }
    .project-dot {
        width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0;
    }
    .project-name { font-size: .83rem; font-weight: 500; color: #1e293b; flex: 1; }
    .project-due  { font-size: .72rem; color: #94a3b8; }

    /* ── Reminder card ───────────────────────── */
    .reminder-card {
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
        border-radius: 14px;
        padding: 18px;
    }
    .reminder-label { font-size: .72rem; font-weight: 600; color: #15803d; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 6px; }
    .reminder-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
    .reminder-time  { font-size: .8rem; color: #64748b; margin-bottom: 14px; }
    .btn-start {
        display: inline-flex; align-items: center; gap: 7px;
        background: #16a34a; color: #fff;
        border: none; border-radius: 10px;
        padding: 9px 18px; font-size: .82rem; font-weight: 600;
        cursor: pointer; text-decoration: none;
        transition: background .18s;
    }
    .btn-start:hover { background: #15803d; color: #fff; }

    /* ── Team collab ─────────────────────────── */
    .team-item {
        display: flex; align-items: center; gap: 12px;
        padding: 9px 0;
        border-bottom: 1px solid #f8fafc;
    }
    .team-item:last-child { border-bottom: none; }
    .team-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: .82rem; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .team-info { flex: 1; min-width: 0; }
    .team-name { font-size: .83rem; font-weight: 600; color: #0f172a; }
    .team-task { font-size: .74rem; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .team-status {
        font-size: .7rem; font-weight: 600; padding: 2px 9px; border-radius: 20px; white-space: nowrap;
    }
    .status-done   { background: #dcfce7; color: #15803d; }
    .status-prog   { background: #fef9c3; color: #854d0e; }
    .status-pend   { background: #fee2e2; color: #991b1b; }
    .status-review { background: #dbeafe; color: #1d4ed8; }

    /* ── Progress donut ──────────────────────── */
    .donut-wrap { display: flex; flex-direction: column; align-items: center; gap: 14px; padding: 12px 0; }
    .donut-svg { width: 160px; height: 160px; }
    .donut-legend { display: flex; gap: 20px; font-size: .78rem; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; }

    /* ── Time tracker ────────────────────────── */
    .time-tracker {
        background: linear-gradient(135deg, #0f2318, #166534);
        border-radius: 14px;
        padding: 18px;
        color: #fff;
        text-align: center;
    }
    .tracker-label { font-size: .72rem; font-weight: 600; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 8px; }
    .tracker-time  { font-size: 2.4rem; font-weight: 700; letter-spacing: .04em; margin-bottom: 14px; font-variant-numeric: tabular-nums; }
    .tracker-controls { display: flex; justify-content: center; gap: 10px; }
    .tracker-btn {
        width: 38px; height: 38px; border-radius: 50%; border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center; font-size: .9rem;
    }
    .tracker-btn.pause { background: rgba(255,255,255,.15); color: #fff; }
    .tracker-btn.stop  { background: #ef4444; color: #fff; }
    .tracker-btn:hover.pause { background: rgba(255,255,255,.25); }

    /* ── Products table ──────────────────────── */
    .products-table { width: 100%; border-collapse: collapse; }
    .products-table th {
        font-size: .72rem; font-weight: 600; color: #94a3b8;
        text-transform: uppercase; letter-spacing: .05em;
        padding: 0 12px 12px;
        text-align: left; border-bottom: 1.5px solid #f1f5f9;
    }
    .products-table td {
        padding: 12px; font-size: .83rem; color: #374151;
        border-bottom: 1px solid #f8fafc;
        vertical-align: middle;
    }
    .products-table tr:last-child td { border-bottom: none; }
    .products-table tr:hover td { background: #f8fafc; }
    .cat-badge {
        background: #f0fdf4; color: #16a34a;
        font-size: .7rem; font-weight: 600;
        padding: 2px 8px; border-radius: 6px;
    }
    .price-cell { font-weight: 600; color: #0f172a; }
    .btn-view {
        display: inline-flex; align-items: center; gap: 5px;
        border: 1.5px solid #e2e8f0; border-radius: 7px;
        color: #475569; font-size: .75rem; font-weight: 500;
        padding: 4px 10px; text-decoration: none;
        transition: all .18s;
    }
    .btn-view:hover { border-color: #16a34a; color: #16a34a; }

    /* ── Page header ─────────────────────────── */
    .page-header {
        display: flex; align-items: flex-start; justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap; gap: 12px;
    }
    .page-header h1 { font-size: 1.65rem; font-weight: 700; color: #0f172a; margin: 0; }
    .page-header p  { font-size: .85rem; color: #64748b; margin: 4px 0 0; }
    .header-actions { display: flex; gap: 10px; }
    .btn-primary-green {
        display: inline-flex; align-items: center; gap: 7px;
        background: #16a34a; color: #fff;
        border: none; border-radius: 10px;
        padding: 9px 18px; font-size: .83rem; font-weight: 600;
        text-decoration: none; cursor: pointer;
        transition: background .18s;
    }
    .btn-primary-green:hover { background: #15803d; color: #fff; }
    .btn-outline-green {
        display: inline-flex; align-items: center; gap: 7px;
        background: #fff; color: #374151;
        border: 1.5px solid #e2e8f0; border-radius: 10px;
        padding: 9px 18px; font-size: .83rem; font-weight: 600;
        text-decoration: none; cursor: pointer;
        transition: all .18s;
    }
    .btn-outline-green:hover { border-color: #16a34a; color: #16a34a; }
</style>
@endpush

@section('content')

{{-- Page header --}}
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>Plan, prioritize, and accomplish your tasks with ease.</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('product.create') }}" class="btn-primary-green">
            <i class="fas fa-plus"></i> Add Product
        </a>
        <a href="{{ route('admin.order') }}" class="btn-outline-green">
            <i class="fas fa-file-import"></i> View Orders
        </a>
    </div>
</div>

{{-- Stat cards --}}
<div class="stat-grid">
    <div class="stat-card green">
        <a href="{{ route('product.index') }}" class="stat-link"><i class="fas fa-arrow-up-right-from-square"></i></a>
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ $totalProducts }}</div>
        <div class="stat-trend"><i class="fas fa-arrow-trend-up"></i> Increased from last month</div>
    </div>
    <div class="stat-card">
        <a href="{{ route('admin.order') }}" class="stat-corner-link"><i class="fas fa-arrow-up-right-from-square"></i></a>
        <div class="stat-label">Total Orders</div>
        <div class="stat-value">{{ $totalOrders }}</div>
        <div class="stat-trend">
            <span class="trend-badge"><i class="fas fa-arrow-up"></i> All time</span>
        </div>
    </div>
    <div class="stat-card">
        <a href="{{ route('category.list') }}" class="stat-corner-link"><i class="fas fa-arrow-up-right-from-square"></i></a>
        <div class="stat-label">Categories</div>
        <div class="stat-value">{{ $totalCategories }}</div>
        <div class="stat-trend">
            <span class="trend-badge"><i class="fas fa-arrow-up"></i> Active</span>
        </div>
    </div>
    <div class="stat-card">
        <span class="stat-corner-link" style="cursor:default"><i class="fas fa-users"></i></span>
        <div class="stat-label">Revenue (Total)</div>
        <div class="stat-value">${{ number_format($totalRevenue, 0) }}</div>
        <div class="stat-trend">
            <span class="trend-badge trend-up"><i class="fas fa-arrow-up"></i> Paid orders</span>
        </div>
    </div>
</div>

{{-- Analytics + Reminder + Projects --}}
<div class="section-row three-col">

    {{-- Weekly activity bars --}}
    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Project Analytics</h2>
            <span class="panel-badge">This week</span>
        </div>
        <div class="panel-body">
            <div class="bar-chart-wrap" id="weeklyBars">
                @php
                    $days = ['S','M','T','W','T','F','S'];
                    $heights = [30, 55, 70, 90, 45, 60, 20];
                    $activeDay = 3; // Wednesday highlighted
                @endphp
                @foreach($days as $i => $day)
                <div class="bar-col">
                    <div class="bar-track">
                        <div class="bar {{ $i === $activeDay ? 'active' : ($i < $activeDay ? 'filled' : 'striped') }}"
                             style="height: {{ $heights[$i] }}%"></div>
                    </div>
                    <div class="bar-day">{{ $day }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Reminder --}}
    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Reminders</h2>
            <a href="{{ route('admin.order') }}" class="panel-action-btn"><i class="fas fa-plus"></i> New</a>
        </div>
        <div class="panel-body">
            <div class="reminder-card">
                <div class="reminder-label">Upcoming</div>
                <div class="reminder-title">Review Pending Orders</div>
                <div class="reminder-time"><i class="fas fa-clock" style="color:#16a34a"></i>
                    {{ now()->format('h:i A') }} — {{ now()->addHours(2)->format('h:i A') }}
                </div>
                <a href="{{ route('admin.order') }}" class="btn-start">
                    <i class="fas fa-play"></i> Go to Orders
                </a>
            </div>
        </div>
    </div>

    {{-- Recent projects (top products) --}}
    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Top Products</h2>
            <a href="{{ route('product.create') }}" class="panel-action-btn"><i class="fas fa-plus"></i> New</a>
        </div>
        <div class="panel-body" style="padding-top:8px">
            @php
                $dotColors = ['#16a34a','#3b82f6','#f59e0b','#ef4444','#8b5cf6'];
            @endphp
            @forelse($topProducts as $i => $p)
            <div class="project-item">
                <div class="project-dot" style="background:{{ $dotColors[$i % 5] }}"></div>
                <div class="project-name">{{ $p->name }}</div>
                <div class="project-due">{{ $p->total_quantity }} sold</div>
            </div>
            @empty
            <p class="text-muted" style="font-size:.83rem">No order data yet.</p>
            @endforelse
        </div>
    </div>

</div>

{{-- Team + Progress + Time tracker --}}
<div class="section-row left-heavy">

    {{-- Team collaboration --}}
    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Recent Orders</h2>
            <a href="{{ route('admin.order') }}" class="panel-action-btn">View all</a>
        </div>
        <div class="panel-body" style="padding-top:8px">
            @php
                $avatarColors = ['#16a34a','#3b82f6','#f59e0b','#8b5cf6','#ef4444'];
            @endphp
            @forelse($recentOrders as $i => $order)
            <div class="team-item">
                <div class="team-avatar" style="background:{{ $avatarColors[$i % 5] }}">
                    {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                </div>
                <div class="team-info">
                    <div class="team-name">{{ $order->user->name ?? 'Unknown' }}</div>
                    <div class="team-task">Order #{{ $order->id }} — ${{ number_format($order->amount, 2) }}</div>
                </div>
                @php
                    $statusMap = [
                        0 => ['label'=>'Rejected', 'class'=>'status-pend'],
                        1 => ['label'=>'Approved', 'class'=>'status-done'],
                        2 => ['label'=>'Paid',     'class'=>'status-prog'],
                    ];
                    $s = $statusMap[$order->status] ?? ['label'=>'Unknown','class'=>'status-review'];
                @endphp
                <span class="team-status {{ $s['class'] }}">{{ $s['label'] }}</span>
            </div>
            @empty
            <p class="text-muted" style="font-size:.83rem">No orders yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Progress + Time tracker stacked --}}
    <div style="display:flex; flex-direction:column; gap:18px;">
        {{-- Donut --}}
        <div class="panel">
            <div class="panel-header">
                <h2 class="panel-title">Order Status</h2>
            </div>
            <div class="panel-body">
                <div class="donut-wrap">
                    <svg class="donut-svg" viewBox="0 0 100 100">
                        @php
                            $approved = max($approvedOrders, 0);
                            $pending  = max($pendingOrders, 0);
                            $rejected = max($rejectedOrders, 0);
                            $tot = $approved + $pending + $rejected;
                            if ($tot === 0) { $tot = 1; $approved = 1; }
                            $pct_a = $approved / $tot;
                            $pct_p = $pending  / $tot;
                            $pct_r = $rejected / $tot;
                            $r = 38; $cx = 50; $cy = 50;
                            $circ = 2 * M_PI * $r;
                            function dashArc($pct, $circ) {
                                return round($pct * $circ, 2) . ' ' . round((1 - $pct) * $circ, 2);
                            }
                            $rot_a = -90;
                            $rot_p = $rot_a + $pct_a * 360;
                            $rot_r = $rot_p + $pct_p * 360;
                        @endphp
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f1f5f9" stroke-width="14"/>
                        @if($pct_a > 0)
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#16a34a" stroke-width="14"
                            stroke-dasharray="{{ dashArc($pct_a, $circ) }}"
                            stroke-dashoffset="{{ round($circ * 0.25, 2) }}"
                            transform="rotate({{ $rot_a }} {{ $cx }} {{ $cy }})"/>
                        @endif
                        @if($pct_p > 0)
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f59e0b" stroke-width="14"
                            stroke-dasharray="{{ dashArc($pct_p, $circ) }}"
                            stroke-dashoffset="{{ round($circ * 0.25, 2) }}"
                            transform="rotate({{ $rot_p }} {{ $cx }} {{ $cy }})"/>
                        @endif
                        @if($pct_r > 0)
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#ef4444" stroke-width="14"
                            stroke-dasharray="{{ dashArc($pct_r, $circ) }}"
                            stroke-dashoffset="{{ round($circ * 0.25, 2) }}"
                            transform="rotate({{ $rot_r }} {{ $cx }} {{ $cy }})"/>
                        @endif
                        <text x="{{ $cx }}" y="{{ $cy - 5 }}" text-anchor="middle" font-size="16" font-weight="700" fill="#0f172a">
                            {{ $tot > 0 ? round($pct_a * 100) : 0 }}%
                        </text>
                        <text x="{{ $cx }}" y="{{ $cy + 12 }}" text-anchor="middle" font-size="7" fill="#94a3b8">Approved</text>
                    </svg>
                    <div class="donut-legend">
                        <div><span class="legend-dot" style="background:#16a34a"></span>Approved ({{ $approvedOrders }})</div>
                        <div><span class="legend-dot" style="background:#f59e0b"></span>Paid ({{ $pendingOrders }})</div>
                        <div><span class="legend-dot" style="background:#ef4444"></span>Rejected ({{ $rejectedOrders }})</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Time tracker --}}
        <div class="time-tracker">
            <div class="tracker-label">Session Timer</div>
            <div class="tracker-time" id="sessionTimer">00:00:00</div>
            <div class="tracker-controls">
                <button class="tracker-btn pause" id="trackerToggle" onclick="toggleTimer()">
                    <i class="fas fa-pause" id="trackerIcon"></i>
                </button>
                <button class="tracker-btn stop" onclick="resetTimer()">
                    <i class="fas fa-stop"></i>
                </button>
            </div>
        </div>
    </div>

</div>

{{-- Latest Products table --}}
<div class="panel">
    <div class="panel-header">
        <h2 class="panel-title">Latest Products</h2>
        <a href="{{ route('product.index') }}" class="panel-action-btn">View all</a>
    </div>
    <div class="panel-body" style="padding:0; overflow-x:auto;">
        @if($products->isEmpty())
            <div class="p-4">
                <div class="alert alert-info mb-0">No products yet. <a href="{{ route('product.create') }}">Add one!</a></div>
            </div>
        @else
        <table class="products-table">
            <thead>
                <tr>
                    <th style="padding-left:22px">Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th style="text-align:right; padding-right:22px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td style="padding-left:22px">
                        <div style="font-weight:600; color:#0f172a">{{ $product->name }}</div>
                        <div style="font-size:.72rem; color:#94a3b8">ID #{{ $product->id }}</div>
                    </td>
                    <td>
                        @if($product->category)
                            <span class="cat-badge">{{ $product->category->name }}</span>
                        @else
                            <span style="color:#94a3b8; font-size:.8rem">—</span>
                        @endif
                    </td>
                    <td class="price-cell">${{ number_format($product->price, 2) }}</td>
                    <td style="text-align:right; padding-right:22px">
                        <a href="{{ route('product.show', $product->id) }}" class="btn-view">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Session timer
    let seconds = 0, running = true, interval;
    function pad(n) { return String(n).padStart(2,'0'); }
    function tick() {
        seconds++;
        const h = Math.floor(seconds/3600);
        const m = Math.floor((seconds%3600)/60);
        const s = seconds % 60;
        document.getElementById('sessionTimer').textContent = pad(h)+':'+pad(m)+':'+pad(s);
    }
    interval = setInterval(tick, 1000);

    function toggleTimer() {
        if (running) {
            clearInterval(interval);
            document.getElementById('trackerIcon').className = 'fas fa-play';
        } else {
            interval = setInterval(tick, 1000);
            document.getElementById('trackerIcon').className = 'fas fa-pause';
        }
        running = !running;
    }
    function resetTimer() {
        clearInterval(interval);
        seconds = 0; running = false;
        document.getElementById('sessionTimer').textContent = '00:00:00';
        document.getElementById('trackerIcon').className = 'fas fa-play';
    }
</script>
@endpush