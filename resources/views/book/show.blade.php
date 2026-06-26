```php
@extends('layout.backend')

@section('content')

<main>
<div class="container-fluid">

    <h1>Show Book</h1>

    <div class="card">
        <div class="card-body">

            <p>
                <strong>Book ID:</strong>
                {{ $book->BookID }}
            </p>

            <p>
                <strong>Title:</strong>
                {{ $book->Title }}
            </p>

            <p>
                <strong>Author:</strong>
                {{ $book->Author }}
            </p>

            <p>
                <strong>ISBN:</strong>
                {{ $book->ISBN }}
            </p>

            <p>
                <strong>Publish Year:</strong>
                {{ $book->PublishYear }}
            </p>

        </div>
    </div>

    <br>

    <a
        class="btn btn-secondary"
        href="{{ url('/book') }}">
        Back
    </a>

</div>
</main>

@endsection
```
