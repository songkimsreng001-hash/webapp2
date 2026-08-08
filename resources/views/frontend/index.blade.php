@extends('layout.frontend')

@section('content')
<div class="container px-4 px-lg-5 mt-5">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h2 class="fw-bolder">Featured Products</h2>
            <p class="text-muted">Discover the latest items from our products table.</p>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-info">No products available right now.</div>
    @else
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        @if($product->image)
                            <img class="card-img-top" src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" />
                        @else
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="{{ $product->name }}" />
                        @endif
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">{{ $product->name }}</h5>
                                <p class="text-muted small mb-2">{{ \u003CIlluminate\Support\Str::limit($product->description, 70) }}</p>
                                <span class="text-success fw-bold">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center d-grid gap-2">
                                <a class="btn btn-outline-dark mt-auto" href="{{ url('/show/'.$product->id) }}">View</a>
                                <a class="btn btn-warning mt-auto" href="{{ route('add.to.cart', $product->id) }}">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection