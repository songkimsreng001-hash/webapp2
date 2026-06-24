@extends('layout.frontend')

@section('content')
<div class="container">
    <br>
    <div class="row">
        @if(session('success'))
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Primary!</strong> {{ session('success') }}
            </div>
        @endif
        @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href="{{url('/show/'.$product->id)}}">
                    <img src="img/{{$product->image}}" width="200px" alt="">
                </a>
                <div class="caption">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                    <p class="btn-holder"><a href="{{-- route('add.to.cart', $product->id) --}}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Pagination -->
    {{ $products->links('pagination::bootstrap-5');}}
</div>
@endsection