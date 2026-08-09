@extends('layout.frontend')
@section('content')
<div class="container">
    <br>
    <div class="row">
        <form action="{{ url('/search') }}" method="GET">
            <div class="input-group">
                <input type="text" name="keyword" value="{{ old('keyword', $keyword ?? '') }}" class="form-control" placeholder="Search products">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <br><br>
        @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href="{{url('/show/'.$product->id)}}">
                    <img src="/img/{{$product->image}}" width="200px" alt="">
                </a>
                
                <div class="caption">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                    <p class="btn-holder"><a href="#" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Pagination -->
    {{ $products->withQueryString()->links('pagination::bootstrap-5');}}
</div>
@endsection