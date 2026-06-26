@extends('layout.backend')

@section('content')
<main>
<div class="container-fluid">

    <h1 class="mt-4">Create Book</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Create Book
        </li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">

            @if(Session::has('book_create'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('book_create') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Something is Wrong</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Html::form('POST','/book')->open() !!}

            {{-- Title --}}
            {!! Html::label('Title:','Title') !!}
            {!! Html::input('text','Title')
                ->class('form-control') !!}
            <br>

            {{-- Author --}}
            {!! Html::label('Author:','Author') !!}
            {!! Html::input('text','Author')
                ->class('form-control') !!}
            <br>

            {{-- ISBN --}}
            {!! Html::label('ISBN:','ISBN') !!}
            {!! Html::input('text','ISBN')
                ->class('form-control') !!}
            <br>

            {{-- Publish Year --}}
            {!! Html::label('Publish Year:','PublishYear') !!}
            {!! Html::input('number','PublishYear')
                ->class('form-control')
                ->attribute('min','1900')
                ->attribute('max', date('Y')) !!}
            <br>

            {{ Html::submit('Create')
                ->class('btn btn-primary') }}

            <a class="btn btn-secondary"
               href="{{ url('/book') }}">
               Back
            </a>

            {{ Html::form()->close() }}

        </div>
    </div>

</div>
</main>
@endsection