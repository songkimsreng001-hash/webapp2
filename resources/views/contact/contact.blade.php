@extends('layout.frontend')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <div class="text-success small fw-semibold"><i class="bi bi-chat-dots me-1"></i> GET IN TOUCH</div>
                            <h1 class="h3 fw-bold mt-1">Contact us</h1>
                            <p class="text-secondary mb-0">Send us a message and we will get back to you.</p>
                        </div>
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
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name" value="{ old('name') }">
                <!-- Error -->
                @if ($errors->has('name'))
                    <div class="error">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email" value="{ old('email') }">
                @if ($errors->has('email'))
                    <div class="error">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone" id="phone" value="{ old('phone') }">
                @if ($errors->has('phone'))
                    <div class="error">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label>Subject</label>
                <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" name="subject"
                    id="subject" value="{{ old('subject') }}">
                @if ($errors->has('subject'))
                    <div class="error">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label>Message</label>
                <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" name="message" id="message"
                    rows="4">{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                    <div class="error">
                        {{ $errors->first('message') }}
                    </div>
                @endif
            </div>
            <button type="submit" name="send" class="btn btn-success rounded-3 px-4"><i class="bi bi-send me-1"></i> Submit</button>
        </form>
                </div>
            </div>
        </div>
    </div>
@endsection