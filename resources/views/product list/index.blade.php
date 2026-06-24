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
<div class="panel panel-default">
    <div class="panel-heading">
        All Products
    </div>

    <div class="panel-body">
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
                        {{ Html::img('img/'.$product->image, $product->name)->attributes(['style'=>'width:100px;height:100px']) }}
                    </td>
                    <td>
                        {!! $product->price !!}
                    </td>

                    <td><a class="btn btn-primary" href="{!! url('product/' . $product->id . '/edit') !!}">Edit</a></td>

                    <td>
                        {{ Html::form('DELETE','product/'. $product->id)->open()}}
                        <button class="btn btn-danger delete">Delete</button>
                        {{ Html::form()->close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    new DataTable('#myTable');
    $(".delete").click(function() {
        var form = $(this).closest('form');
        $('<div></div>').appendTo('body')
            .html('<div><h6> Are you sure ?</h6></div>')
            .dialog({
                modal: true,
                title: 'Delete message',
                zIndex: 10000,
                autoOpen: true,
                width: 'auto',
                resizable: false,
                buttons: {
                    Yes: function() {
                        $(this).dialog('close');
                        form.submit();
                    },
                    No: function() {
                        $(this).dialog("close");
                        return false;
                    }
                },
                close: function(event, ui) {
                    $(this).remove();
                }
            });
        return false;
    });
</script>
@endif
@endsection