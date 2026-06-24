@extends('layout.backend')

@section('content')
    <h1>Create category</h1>
    @if(Session::has('category_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('category_create') !!}
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
    {!! Html::form('POST','/category')->open() !!}
    {!! Html::label('Name: ','name') !!}
    {!! Html::input('text','name', '')->class('form-control')  !!}
    <br>
    {!! Html::label('Description: ','description') !!}
    {!! Html::textarea('description', '')->class('form-control') !!}
    <br>
    {{ Html::submit('Create')->class('btn btn-primary') }}
    <a class="btn btn-secondary" href="{{route('category.list')}}">Back</a>
    {!! Html::form()->close() !!}
@endsection