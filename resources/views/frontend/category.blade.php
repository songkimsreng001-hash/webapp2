@extends('layout.frontend')
@section('content')
<div class="container">
    
    <div class="row">
        <br>
        @if (count(array($categories)) > 0)
            <div class="col-md-12">
                <ul class="list-unstyled mb-0">
                    @foreach ($categories as $category)
                    <li><a href="{{url('/frontend/'.$category->id)}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br><br><br>
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
    {{-- $products->appends(request()->input())->links(); --}}
    {{ $products->links('pagination::bootstrap-5');}}
</div>
@endsection