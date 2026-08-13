@extends('layout.backend')

@section('page-title', 'Dashboard — 24/7 NHAM')

@push('styles')
<style>
    .dashboard-subtitle { max-width:650px; }
    .sales-total { font-size:10px;color:#217a42; }
    .sales-total strong { color:#243a2f;font-size:14px;margin-left:4px; }
    .chart-tooltip {
        position:absolute;left:50%;top:-32px;transform:translateX(-50%);
        padding:4px 7px;border-radius:6px;background:#173d2b;color:#fff;
        font-size:8px;font-weight:700;white-space:nowrap;opacity:0;pointer-events:none;
        transition:.15s;
    }
    .bar:hover .chart-tooltip { opacity:1; }
    .status-summary { display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:12px; }
    .status-summary-item { background:#f8faf9;border-radius:9px;padding:9px; }
    .status-summary-item strong { display:block;font-size:13px;color:#24372e; }
    .status-summary-item span { font-size:8px;color:#9aa59f; }
    .order-amount { font-weight:800;color:#263a31; }
    .product-thumb {
        width:34px;height:34px;border-radius:9px;object-fit:cover;background:#edf5f0;
        display:block;
    }
    .product-thumb-placeholder {
        width:34px;height:34px;border-radius:9px;background:#e7f5ed;color:#268052;
        display:grid;place-items:center;font-size:10px;font-weight:800;
    }
    @media (max-width:680px) {
        .status-summary { grid-template-columns:1fr; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="dashboard-subtitle">
        <h1>Dashboard</h1>
        <p>Overview of your products, orders, customers, and shop performance.</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('product.create') }}" class="btn-primary-green">
            <span>+</span> Add Product
        </a>
        <a href="{{ route('admin.order') }}" class="btn-outline-green">
            View Orders
        </a>
    </div>
</div>

{{-- KPI cards --}}
<div class="stat-grid">
    <div class="stat-card green">
        <a href="{{ route('product.index') }}" class="stat-link" aria-label="View products">
            <svg viewBox="0 0 24 24"><path d="M7 17 17 7M9 7h8v8"/></svg>
        </a>
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ number_format($totalProducts) }}</div>
        <div class="stat-trend">Your current product catalog</div>
    </div>

    <div class="stat-card">
        <a href="{{ route('admin.order') }}" class="stat-corner-link" aria-label="View orders">
            <svg viewBox="0 0 24 24"><path d="M7 17 17 7M9 7h8v8"/></svg>
        </a>
        <div class="stat-label">Total Orders</div>
        <div class="stat-value">{{ number_format($totalOrders) }}</div>
        <div class="stat-trend"><span class="trend-badge">All orders</span></div>
    </div>

    <div class="stat-card">
        <a href="{{ route('profile.edit', auth()->id()) }}" class="stat-corner-link" aria-label="View profile">
            <svg viewBox="0 0 24 24"><path d="M7 17 17 7M9 7h8v8"/></svg>
        </a>
        <div class="stat-label">Customers</div>
        <div class="stat-value">{{ number_format($totalCustomers) }}</div>
        <div class="stat-trend"><span class="trend-badge">Registered users</span></div>
    </div>

    <div class="stat-card">
        <span class="stat-corner-link" style="cursor:default" aria-hidden="true">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/><path d="M14.5 9.5c-.6-.7-1.4-1-2.6-1-1.5 0-2.5.7-2.5 1.8 0 1.2 1 1.6 2.6 1.9 1.7.3 2.7.8 2.7 2.1 0 1.1-1 2.2-2.8 2.2-1.3 0-2.3-.4-3-1.2M12 7v10"/></svg>
        </span>
        <div class="stat-label">Paid Revenue</div>
        <div class="stat-value">${{ number_format($totalRevenue, 2) }}</div>
        <div class="stat-trend"><span class="trend-badge">Paid orders</span></div>
    </div>
</div>

{{-- Sales analytics / reminder / top products --}}
<div class="section-row three-col">

    <div class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Sales Analytics</h2>
                <div class="sales-total">This week <strong>${{ number_format($weeklySales->sum('revenue'), 2) }}</strong></div>
            </div>
            <span class="panel-badge">Current week</span>
        </div>
        <div class="panel-body">
            <div class="bar-chart-wrap">
                @foreach($weeklySales as $i => $sale)
                    @php
                        $height = $weeklyMax > 0 ? max(8, ($sale['revenue'] / $weeklyMax) * 100) : 8;
                        $isToday = $sale['day'] === now()->format('D');
                    @endphp
                    <div class="bar-col">
                        <div class="bar-track">
                            <div class="bar {{ $isToday ? 'active' : ($sale['revenue'] > 0 ? 'filled' : 'striped') }}"
                                 style="height:{{ $height }}%">
                                <span class="chart-tooltip">${{ number_format($sale['revenue'], 2) }}</span>
                            </div>
                        </div>
                        <div class="bar-day">{{ $sale['short'] }}</div>
                    </div>
                @endforeach
            </div>
            <div class="mini-stats">
                <div class="mini-stat">
                    <strong>{{ $approvedOrders }}</strong>
                    <span>Approved orders</span>
                </div>
                <div class="mini-stat">
                    <strong>{{ $pendingOrders }}</strong>
                    <span>Paid / processing</span>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Reminders</h2>
            <a href="{{ route('admin.order') }}" class="panel-action-btn">Review</a>
        </div>
        <div class="panel-body">
            <div class="reminder-card">
                <div class="reminder-label">Order attention</div>
                <div class="reminder-title">
                    {{ $pendingOrders }} paid {{ \Illuminate\Support\Str::plural('order', $pendingOrders) }} ready for processing
                </div>
                <div class="reminder-time">
                    Keep paid orders moving so customers receive their products on time.
                </div>
                <a href="{{ route('admin.order') }}" class="btn-start">Open Orders</a>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Top Products</h2>
            <a href="{{ route('product.create') }}" class="panel-action-btn">+ New</a>
        </div>
        <div class="panel-body" style="padding-top:7px">
            @forelse($topProducts as $p)
                <div class="project-item">
                    <div class="project-dot"></div>
                    <div class="project-name">{{ $p->name }}</div>
                    <div class="project-due">{{ $p->total_quantity }} sold</div>
                </div>
            @empty
                <div class="empty-state" style="padding:25px 0">No sales data yet.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- Recent orders + status / timer --}}
<div class="section-row left-heavy">

    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title">Recent Orders</h2>
            <a href="{{ route('admin.order') }}" class="panel-action-btn">View all</a>
        </div>
        <div class="panel-body" style="padding-top:6px">
            @forelse($recentOrders as $order)
                @php
                    $statusMap = [
                        0 => ['label'=>'Rejected', 'class'=>'status-pend'],
                        1 => ['label'=>'Approved', 'class'=>'status-done'],
                        2 => ['label'=>'Paid', 'class'=>'status-prog'],
                    ];
                    $status = $statusMap[$order->status] ?? ['label'=>'Unknown', 'class'=>'status-review'];
                @endphp
                <div class="team-item">
                    <div class="team-avatar">
                        {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="team-info">
                        <div class="team-name">{{ $order->user->name ?? 'Unknown customer' }}</div>
                        <div class="team-task">Order #{{ $order->id }} · {{ optional($order->created_at)->format('d M Y, h:i A') }}</div>
                    </div>
                    <div style="text-align:right">
                        <div class="order-amount">${{ number_format($order->amount, 2) }}</div>
                        <span class="team-status {{ $status['class'] }}">{{ $status['label'] }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-state">No orders yet.</div>
            @endforelse
        </div>
    </div>

    <div>
        @php
            $statusTotal = max($approvedOrders + $pendingOrders + $rejectedOrders, 1);
            $approvedPct = round(($approvedOrders / $statusTotal) * 100, 1);
            $paidEnd = $approvedPct + round(($pendingOrders / $statusTotal) * 100, 1);
            $rejectedEnd = $paidEnd + round(($rejectedOrders / $statusTotal) * 100, 1);
        @endphp

        <div class="panel">
            <div class="panel-header">
                <h2 class="panel-title">Order Status</h2>
                <span class="panel-badge">{{ $approvedOrders + $pendingOrders + $rejectedOrders }} tracked</span>
            </div>
            <div class="panel-body">
                <div class="donut-wrap">
                    <div class="donut"
                         style="--approved:{{ $approvedPct }}%;--paid:{{ $paidEnd }}%;--rejected:{{ $rejectedEnd }}%;">
                        <div class="donut-center">
                            <strong>{{ $totalOrders ? round(($pendingOrders / $totalOrders) * 100) : 0 }}%</strong>
                            <span>Paid</span>
                        </div>
                    </div>
                    <div class="donut-legend">
                        <div class="legend-row"><span class="legend-dot" style="background:#0a8950"></span>Approved <strong>{{ $approvedOrders }}</strong></div>
                        <div class="legend-row"><span class="legend-dot" style="background:#f1b94b"></span>Paid <strong>{{ $pendingOrders }}</strong></div>
                        <div class="legend-row"><span class="legend-dot" style="background:#e76c5d"></span>Rejected <strong>{{ $rejectedOrders }}</strong></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="time-tracker">
            <div class="tracker-label">Session Timer</div>
            <div class="tracker-time" id="sessionTimer">00:00:00</div>
            <div class="tracker-controls">
                <button class="tracker-btn pause" id="trackerToggle" type="button" onclick="toggleTimer()" aria-label="Pause timer">
                    <svg id="trackerIcon" viewBox="0 0 24 24"><path d="M8 6v12M16 6v12" fill="none" stroke-width="2"/></svg>
                </button>
                <button class="tracker-btn stop" type="button" onclick="resetTimer()" aria-label="Reset timer">
                    <svg viewBox="0 0 24 24"><path d="M7 7h10v10H7z"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Latest products --}}
<div class="panel">
    <div class="panel-header">
        <h2 class="panel-title">Latest Products</h2>
        <a href="{{ route('product.index') }}" class="panel-action-btn">View all</a>
    </div>

    <div class="panel-body" style="padding:0;overflow-x:auto">
        @if($products->isEmpty())
            <div class="empty-state">
                No products yet.
                <a href="{{ route('product.create') }}" style="color:#17824e;font-weight:800">Add your first product</a>
            </div>
        @else
            <table class="products-table">
                <thead>
                    <tr>
                        <th style="padding-left:19px">Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th style="text-align:right;padding-right:19px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td style="padding-left:19px">
                                <div style="display:flex;align-items:center;gap:9px">
                                    @if($product->image)
                                        <img class="product-thumb" src="{{ asset('img/'.$product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <div class="product-thumb-placeholder">{{ strtoupper(substr($product->name,0,1)) }}</div>
                                    @endif
                                    <div>
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-id">ID #{{ $product->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="cat-badge">{{ $product->category->name }}</span>
                                @else
                                    <span style="color:#a0aaa5">—</span>
                                @endif
                            </td>
                            <td class="price-cell">${{ number_format($product->price, 2) }}</td>
                            <td style="text-align:right;padding-right:19px">
                                <a href="{{ route('product.show', $product->id) }}" class="btn-view">View</a>
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
    let seconds = 0;
    let running = true;
    let interval = setInterval(tick, 1000);

    function pad(n) { return String(n).padStart(2, '0'); }

    function tick() {
        seconds++;
        const h = Math.floor(seconds / 3600);
        const m = Math.floor((seconds % 3600) / 60);
        const s = seconds % 60;
        const timer = document.getElementById('sessionTimer');
        if (timer) timer.textContent = `${pad(h)}:${pad(m)}:${pad(s)}`;
    }

    function setTimerIcon(paused) {
        const icon = document.getElementById('trackerIcon');
        if (!icon) return;
        icon.innerHTML = paused
            ? '<path d="m9 6 8 6-8 6z"/>'
            : '<path d="M8 6v12M16 6v12" fill="none" stroke-width="2"/>';
    }

    function toggleTimer() {
        if (running) {
            clearInterval(interval);
            setTimerIcon(true);
        } else {
            interval = setInterval(tick, 1000);
            setTimerIcon(false);
        }
        running = !running;
    }

    function resetTimer() {
        clearInterval(interval);
        seconds = 0;
        running = false;
        const timer = document.getElementById('sessionTimer');
        if (timer) timer.textContent = '00:00:00';
        setTimerIcon(true);
    }
</script>
@endpush
