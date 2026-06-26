@extends('layout.backend')

@section('content')
<main>
<div class="container-fluid">

    <h1 class="mt-4">Edit Book</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="/book">View All Books</a>
        </li>

        <li class="breadcrumb-item active">
            <a href="/book/create">Create Book</a>
        </li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">

            @if(Session::has('book_update'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('book_update') }}

                    <button
                        type="button"
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


            {{ Html::modelForm($book,'PUT',
                route('book.update',$book->BookID))->open()
            }}

            {{-- Title --}}
            {!! Html::label('Title','Title') !!}
            {!! Html::input('text','Title',null)
                ->class('form-control') !!}
            <br>

            {{-- Author --}}
            {!! Html::label('Author','Author') !!}
            {!! Html::input('text','Author',null)
                ->class('form-control') !!}
            <br>

            {{-- ISBN --}}
            {!! Html::label('ISBN','ISBN') !!}
            {!! Html::input('text','ISBN',null)
                ->class('form-control') !!}
            <br>

            {{-- Publish Year --}}
            {!! Html::label('Publish Year','PublishYear') !!}
            {!! Html::input('number','PublishYear',null)
                ->class('form-control')
                ->attribute('min','1900')
                ->attribute('max',date('Y')) !!}
            <br>

            {{ Html::submit('Update')
                ->class('btn btn-primary') }}

            <a class="btn btn-secondary"
               href="{{ url('/book') }}">
               Back
            </a>

            {!! Html::closeModelForm() !!}

        </div>
    </div>

</div>
</main>
@endsection