@extends('layout.frontend')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <div class="text-success small fw-semibold">
                                <i class="bi bi-chat-dots me-1"></i> GET IN TOUCH
                            </div>
                            <h1 class="h3 fw-bold mt-1">Contact us</h1>
                            <p class="text-secondary mb-0">Send us a message and we will get back to you.</p>
                        </div>

                        <!-- Success Alert -->
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Global Error List Alert -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <strong class="d-block mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please check the errors below:</strong>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}" novalidate>
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1 text-muted"></i>Name
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="John Doe">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-1 text-muted"></i>Email
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="name@example.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold">
                                    <i class="bi bi-telephone me-1 text-muted"></i>Phone
                                </label>
                                <input type="tel" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" 
                                       id="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="+885 (00) 000 0000">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Subject Field -->
                            <div class="mb-3">
                                <label for="subject" class="form-label fw-semibold">
                                    <i class="bi bi-tag me-1 text-muted"></i>Subject
                                </label>
                                <input type="text" 
                                       class="form-control @error('subject') is-invalid @enderror" 
                                       name="subject" 
                                       id="subject" 
                                       value="{{ old('subject') }}" 
                                       placeholder="How can we help?">
                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Message Field -->
                            <div class="mb-4">
                                <label for="message" class="form-label fw-semibold">
                                    <i class="bi bi-pencil me-1 text-muted"></i>Message
                                </label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          name="message" 
                                          id="message" 
                                          rows="4" 
                                          placeholder="Write your message here...">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success rounded-3 px-4 py-2 fw-semibold">
                                <i class="bi bi-send me-1"></i> Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection