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
                <div><img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->name }}" style="width:300px;height:150px;object-fit:cover;" /></div>
            </div>
		</div>
        <br>
        <a class="btn btn-secondary" href="{{ route('product.index') }}">Back</a>
	</div>
</main>
@endsection