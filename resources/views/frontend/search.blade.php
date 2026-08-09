@extends('layout.frontend')
@section('page-title', 'Search — 24/7 NHAM')

@section('content')
<div class="container">
    <div class="section-header">
        <h2>Search Products</h2>
        <p>Find exactly what you're looking for.</p>
    </div>

    {{-- Search form --}}
    <form action="{{ url('/search') }}" method="GET" class="mb-5">
        <div class="input-group" style="max-width:560px; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.06);">
            <input type="text" name="keyword"
                   value="{{ old('keyword', $keyword ?? '') }}"
                   class="form-control border-end-0"
                   style="border-radius:12px 0 0 12px; border-color:#e2e8f0; font-size:.9rem; padding:12px 16px;"
                   placeholder="Search products by name…">
            <button type="submit" class="btn"
                    style="background:#16a34a; color:#fff; border-radius:0 12px 12px 0; padding:12px 20px; font-weight:600; font-size:.88rem; border:none;">
                <i class="fas fa-search me-1"></i> Search
            </button>
        </div>
    </form>

    {{-- Results --}}
    @if(isset($keyword) && $keyword !== '')
        <p class="text-muted mb-4" style="font-size:.85rem;">
            Showing results for <strong>"{{ $keyword }}"</strong>
            — {{ $products->total() }} {{ Str::plural('product', $products->total()) }} found
        </p>
    @endif

    @if($products->isEmpty())
        <div class="empty-state">
            <i class="fas fa-search"></i>
            <h5>{{ isset($keyword) && $keyword ? 'No results for "' . $keyword . '"' : 'Start searching' }}</h5>
            <p>Try different keywords or <a href="{{ url('/list') }}" style="color:#16a34a">browse all products</a>.</p>
        </div>
    @else
        <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-xl-4">
            @foreach($products as $product)
            <div class="col">
                <div class="product-card">
                    <div class="card-img-wrap">
                        @if($product->image)
                            <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://dummyimage.com/450x300/dcfce7/166534.jpg&text={{ urlencode($product->name) }}"
                                 alt="{{ $product->name }}">
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-desc">{{ Str::limit($product->description, 70) }}</div>
                        <div class="product-price">${{ number_format($product->price, 2) }}</div>
                    </div>
                    <div class="card-footer-actions">
                        <a href="{{ url('/show/' . $product->id) }}" class="btn-view-product">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                        {{-- FIX: was href="#" (dead link), now routes to add.to.cart --}}
                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn-add-cart">
                            <i class="fas fa-cart-plus me-1"></i> Add to Cart
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection