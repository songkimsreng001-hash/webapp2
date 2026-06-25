@extends('layout.backend')
@section('content')
<main>
	<div class="container-fluid">
		<h1 class="mt-4">Edit Product</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="/product">View all product</a></li>
			<li class="breadcrumb-item active"><a href="product/create">Create post</a></li>
		</ol>
		<div class="card mb-4">
			<div class="card-body">
                @if(Session::has('product_update'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {!! session('product_update') !!}
                </div>
                @endif
                @if (count($errors) > 0)
                <!-- Form Error List -->
                <div class="alert alert-danger">
                    <strong>Something is Wrong</strong>
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                {{ Html::modelForm($product ,'PUT', route('product.update', $product->id))->acceptsFiles()->open() }}
                {!! Html::label('Category:','category_id') !!}
                {!! Html::select('category_id',$categories,null)->class('form-control') !!}
                <br>
                {!! Html::label('Name:', 'name') !!}
                {!! Html::input('text','name', null)->class('form-control')  !!}

                {!! Html::label('Price:','price') !!}
                {!! Html::input('text','price', null)->class('form-control')  !!}

                {!! Html::label('Image:','image') !!}
                {!! Html::file('image')->class('form-control') !!}
                <br>
                
                {!! Html::label('Description:','description') !!}
                {!! Html::textarea('description', null)->class('form-control') !!}
                <br>
                {{ Html::submit('Update')->class('btn btn-primary') }}
                <a class="btn btn-primary" href="{!! url('/product')!!}">Back</a>
                {!! Html::closeModelForm() !!}
			</div>
		</div>
	</div>
</main>
@endsection