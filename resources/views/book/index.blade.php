@extends('layout.backend')

@section('content')

<main>
<div class="container-fluid">

    <h1 class="mt-4">Book List</h1>

    <a href="{{ route('book.create') }}"
       class="btn btn-primary mb-3">
       Add Book
    </a>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Publish Year</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($books as $book)

        <tr>

            <td>{{ $book->BookID }}</td>
            <td>{{ $book->Title }}</td>
            <td>{{ $book->Author }}</td>
            <td>{{ $book->ISBN }}</td>
            <td>{{ $book->PublishYear }}</td>

            <td>

                <a
                    href="{{ route('book.show',$book->BookID) }}"
                    class="btn btn-info">
                    View
                </a>

                <a
                    href="{{ route('book.edit',$book->BookID) }}"
                    class="btn btn-warning">
                    Edit
                </a>

                <form
                    action="{{ route('book.destroy',$book->BookID) }}"
                    method="POST"
                    style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-danger">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

</div>
</main>

@endsection