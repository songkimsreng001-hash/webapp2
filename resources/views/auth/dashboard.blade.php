@extends('auth.layout')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card card-shadow border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Dashboard</h4>
                            <small class="text-muted">Welcome back, {{ $user->name }}</small>
                        </div>
                        <span class="badge badge-primary bg-primary text-white">{{ $products->count() }} Products</span>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3 h-100">
                                    <h6 class="text-uppercase">User ID</h6>
                                    <p class="mb-0">{{ $user->id }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3 h-100">
                                    <h6 class="text-uppercase">Email</h6>
                                    <p class="mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3 h-100">
                                    <h6 class="text-uppercase">Registered</h6>
                                    <p class="mb-0">{{ optional($user->created_at)->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card card-shadow border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Top Products by Sales Quantity</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="productChart" height="260"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card card-shadow border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Top Categories by Orders</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="categoryChart" height="260"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-shadow border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Latest Products</h5>
                    </div>
                    <div class="card-body">
                        @if ($products->isEmpty())
                            <div class="alert alert-info">No products available yet.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category ID</th>
                                            <th>Price</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category_id }}</td>
                                                <td>${{ number_format($product->price, 2) }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const productLabels = @json($topProducts->pluck('name'));
        const productData = @json($topProducts->pluck('total_quantity'));
        const categoryLabels = @json($topCategories->pluck('name'));
        const categoryData = @json($topCategories->pluck('total_quantity'));

        new Chart(document.getElementById('productChart'), {
            type: 'bar',
            data: {
                labels: productLabels,
                datasets: [{
                    label: 'Units Sold',
                    data: productData,
                    backgroundColor: 'rgba(78, 115, 223, 0.7)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryData,
                    backgroundColor: [
                        'rgba(54, 185, 204, 0.75)',
                        'rgba(28, 200, 138, 0.75)',
                        'rgba(255, 193, 7, 0.75)',
                        'rgba(255, 99, 132, 0.75)',
                        'rgba(153, 102, 255, 0.75)'
                    ],
                    borderColor: 'rgba(255,255,255,0.9)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                }
            }
        });
    </script>
@endpush
@endsection