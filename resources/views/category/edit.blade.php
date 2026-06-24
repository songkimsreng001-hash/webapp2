@extends('layout.backend')

@section('content')
    @if(Session::has('category_update'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('category_update') !!}
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
    {{ Html::modelForm($category ,'PUT', route('category.update', $category->id))->open() }}
    {!! Html::label('Name:','name') !!}
    {!! Html::input('text','name', null)->class('form-control')  !!}
    <br>
    {!! Html::label('Description:','description') !!}
    {!! Html::textarea('description', null)->class('form-control') !!}
    <br>
    {{ Html::submit('Update')->class('btn btn-primary') }}
    <a class="btn btn-secondary" href="{{route('category.list')}}">Back</a>
    {!! Html::closeModelForm() !!}
@endsection