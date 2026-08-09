@extends('layout.backend')
@section('content')
<main>
	<div class="container-fluid">
		<h1 class="mt-4">Edit Product</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
			<li class="breadcrumb-item active">Edit Product</li>
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
                
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category:</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($product->image)
                            <div class="mt-2">
                                <img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->name }}" style="width:120px;height:80px;object-fit:cover;">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-primary" href="{{ route('product.index') }}">Back</a>
                </form>
			</div>
		</div>
	</div>
</main>
@endsection