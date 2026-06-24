@extends('layout.backend')
@section('content')
<main>
	<div class="container-fluid">
		<h1>Show product</h1>
		<div class="card">
            <div class="card-body">
                <p>Name: {{$product->name}}</p>
                <p>Category: {{$product->category->name}}</p>
                <p>Price: {{$product->price}}</p>
                <p>Description: {{$product->description}}</p>
                <div>{!! Html::img('/img/'.$product->image, $product->name)->attributes(['style'=>'width:300px;height:150px']) !!}</div>
            </div>
		</div>
        <br>
        <a class="btn btn-secondary" href="{{url('/product')}}">Back</a>
	</div>
</main>
@endsection