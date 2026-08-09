@extends('layout.frontend')
@section('page-title', ($product->name ?? 'Product') . ' — 24/7 NHAM')

@section('content')
<div class="container" style="padding-top:40px; padding-bottom:64px;">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="font-size:.82rem;">
            <li class="breadcrumb-item"><a href="{{ url('/list') }}" style="color:#16a34a">Products</a></li>
            @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('frontend.category', $product->category->id) }}" style="color:#16a34a">
                        {{ $product->category->name }}
                    </a>
                </li>
            @endif
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5 align-items-start">

        {{-- Product image --}}
        <div class="col-md-6">
            <div style="border-radius:20px; overflow:hidden; background:#f8fafc; border:1px solid #f1f5f9;">
                @if($product->image)
                    <img src="{{ asset('img/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="img-fluid w-100"
                         style="aspect-ratio:4/3; object-fit:cover;">
                @else
                    <img src="https://dummyimage.com/600x450/dcfce7/166534.jpg&text={{ urlencode($product->name) }}"
                         alt="{{ $product->name }}"
                         class="img-fluid w-100"
                         style="aspect-ratio:4/3; object-fit:cover;">
                @endif
            </div>
        </div>

        {{-- Product info --}}
        <div class="col-md-6">
            @if($product->category)
                <span style="background:#f0fdf4; color:#16a34a; border:1.5px solid #bbf7d0;
                             border-radius:20px; font-size:.75rem; font-weight:600;
                             padding:3px 12px; display:inline-block; margin-bottom:14px;">
                    {{ $product->category->name }}
                </span>
            @endif

            <div style="font-size:.8rem; color:#94a3b8; margin-bottom:6px;">SKU: #{{ $product->id }}</div>
            <h1 style="font-size:2rem; font-weight:800; color:#0f172a; margin-bottom:12px;">
                {{ $product->name }}
            </h1>

            <div style="font-size:2rem; font-weight:700; color:#16a34a; margin-bottom:20px;">
                ${{ number_format($product->price, 2) }}
            </div>

            <p style="color:#475569; font-size:.92rem; line-height:1.7; margin-bottom:28px;">
                {{ $product->description ?: 'No description available.' }}
            </p>

            {{-- FIX: Add to cart now uses a proper link with quantity passed via URL / session
                 The original was a dead <button> with no form or route --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="display:flex; align-items:center; border:1.5px solid #e2e8f0; border-radius:10px; overflow:hidden;">
                    <button onclick="stepQty(-1)" type="button"
                            style="width:38px; height:42px; border:none; background:#f8fafc; font-size:1.1rem; cursor:pointer; color:#475569; transition:background .18s;"
                            onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='#f8fafc'">−</button>
                    <input type="number" id="qtyInput" value="1" min="1" max="99"
                           style="width:50px; text-align:center; border:none; outline:none; font-size:.9rem; font-weight:600; color:#0f172a;">
                    <button onclick="stepQty(1)" type="button"
                            style="width:38px; height:42px; border:none; background:#f8fafc; font-size:1.1rem; cursor:pointer; color:#475569; transition:background .18s;"
                            onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='#f8fafc'">+</button>
                </div>
                <a id="addToCartBtn"
                   href="{{ route('add.to.cart', $product->id) }}"
                   class="btn-add-cart d-inline-flex align-items-center gap-2"
                   style="flex:1; justify-content:center; padding:11px 24px; font-size:.9rem; border-radius:12px;">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </a>
            </div>

            <a href="{{ url('/list') }}"
               style="color:#64748b; font-size:.83rem; text-decoration:none; display:inline-flex; align-items:center; gap:5px;">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function stepQty(delta) {
        const input = document.getElementById('qtyInput');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > 99) val = 99;
        input.value = val;
    }
</script>
@endpush