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
@endsection