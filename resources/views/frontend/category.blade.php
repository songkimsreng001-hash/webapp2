@extends('layout.frontend')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Categories</h3>
            <p class="text-muted">Click a category to view only its products.</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="btn-toolbar" role="toolbar" aria-label="Category toolbar">
                <div class="btn-group me-2" role="group" aria-label="Category buttons">
                    <a href="{{ route('frontend.categories') }}" class="btn btn-outline-primary {{ is_null($selectedCategory) ? 'active' : '' }}">All Categories</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('frontend.category', $category->id) }}" class="btn btn-outline-primary {{ optional($selectedCategory)->id === $category->id ? 'active' : '' }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($selectedCategory)
        <div class="row mb-3">
            <div class="col-md-12">
                <h4 class="fw-bold">Products in {{ $selectedCategory->name }}</h4>
            </div>
        </div>
    @endif

    <div class="row">
        @forelse($products as $product)
            <div class="col-xs-18 col-sm-6 col-md-3 mb-4">
                <div class="card h-100">
                    <a href="{{ url('/show/'.$product->id) }}">
                        <img src="{{ $product->image ? asset('img/'.$product->image) : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }}" class="card-img-top" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                        <p class="fw-bold">Price: ${{ number_format($product->price, 2) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block">Add to cart</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-info">No products found in this category.</div>
            </div>
        @endforelse
    </div>

    @if($products instanceof \Illuminate\Contracts\Pagination\Paginator)
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection