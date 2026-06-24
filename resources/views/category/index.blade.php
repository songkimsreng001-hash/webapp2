@extends('layout.backend')
@section('content')
<h1>Category</h1>
<a class="btn btn-primary" href="{{ url('/category/create') }}">New</a>
<br><br>
@if(Session::has('category_delete'))
<div class="alert alert-primary alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Primary!</strong> {!! session('category_delete') !!}
</div>
@endif
@if (count($categories) > 0)
<table class="table table-bordered">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>
                {!! $category->id !!}
            </td>
            <td>
            <a href="{{ url('/category/' . $category->id) }}">{!! $category->name !!}</a>
            </td>
            <td><a class="btn btn-primary" href="{!! url('/category/' . $category->id . '/edit') !!}">Edit</a></td>
            <td>
                    {{ Html::form('DELETE','category/'. $category->id)->open()}}
                        <button onclick="return confirmAction()" class="btn btn-danger delete">Delete</button>
                    {{ Html::form()->close() }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    function confirmAction() {
        let confirmAction = confirm("Are you sure to delete?");
        if (confirmAction == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endif
@endsection