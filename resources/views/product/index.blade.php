@extends('layout.backend')
@section('content')
<h1>Product list</h1>
<a class="btn btn-primary" href="{{ url('/product/create') }}">New</a>
<br><br>
@if(Session::has('product_delete'))
<div class="alert alert-primary alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Primary!</strong> {!! session('product_delete') !!}
</div>
@endif
@if (count($products) > 0)
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white fw-semibold py-3">
        All Products
    </div>

    <div class="card-body">
        <table id="myTable" class="table table-striped task-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
                
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>
                        <a href="{{url('/product/'.$product->id)}}">{{ $product->name }}</a>
                    </td>
                    <td>
                        {!! $product->description !!}
                    </td>
                    <td>
                        <img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->name }}" style="width:100px;height:100px;object-fit:cover;" />
                    </td>
                    <td>
                        {!! $product->price !!}
                    </td>

                    <td><a class="btn btn-primary" href="{!! url('product/' . $product->id . '/edit') !!}">Edit</a></td>

                    <td>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" data-confirm="This product will be deleted." data-confirm-title="Delete product?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endif
@endsection