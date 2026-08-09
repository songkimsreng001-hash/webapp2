@extends('layout.backend')

@section('content')
<main>
<div class="container-fluid">

    <h1 class="mt-4">Edit Book</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('book.index') }}">Books</a>
        </li>

        <li class="breadcrumb-item active">
            Edit Book
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


            <form action="{{ route('book.update', $book->BookID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="Title" class="form-label">Title</label>
                    <input type="text" name="Title" id="Title" class="form-control" value="{{ old('Title', $book->Title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="Author" class="form-label">Author</label>
                    <input type="text" name="Author" id="Author" class="form-control" value="{{ old('Author', $book->Author) }}" required>
                </div>

                <div class="mb-3">
                    <label for="ISBN" class="form-label">ISBN</label>
                    <input type="text" name="ISBN" id="ISBN" class="form-control" value="{{ old('ISBN', $book->ISBN) }}" required>
                </div>

                <div class="mb-3">
                    <label for="PublishYear" class="form-label">Publish Year</label>
                    <input type="number" name="PublishYear" id="PublishYear" class="form-control" min="1900" max="{{ date('Y') }}" value="{{ old('PublishYear', $book->PublishYear) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-secondary" href="{{ route('book.index') }}">Back</a>
            </form>

        </div>
    </div>

</div>
</main>
@endsection