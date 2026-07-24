@extends('layout.frontend')

@section('content')
    <div class="container mt-5">
        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
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
        <form method="post" action="{{ route('contact.store') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name">
                <!-- Error -->
                @if ($errors->has('name'))
                    <div class="error">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email">
                @if ($errors->has('email'))
                    <div class="error">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone" id="phone">
                @if ($errors->has('phone'))
                    <div class="error">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Subject</label>
                <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" name="subject"
                    id="subject">
                @if ($errors->has('subject'))
                    <div class="error">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" name="message" id="message"
                    rows="4"></textarea>
                @if ($errors->has('message'))
                    <div class="error">
                        {{ $errors->first('message') }}
                    </div>
                @endif
            </div>
            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
@endsection