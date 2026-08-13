@extends('auth.layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="auth-card">
            <div class="auth-card-header">
                <div class="auth-icon"><i class="fas fa-user-plus"></i></div>
                <h4>Create an account</h4>
                <p>Join 24/7 NHAM today</p>
            </div>
            <div class="auth-card-body">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="name" class="form-control"
                                name="name" value="{{ old('name') }}"
                                placeholder="Your full name" required autofocus>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email_address" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="email_address" class="form-control"
                                name="email" value="{{ old('email') }}"
                                placeholder="your@email.com" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" class="form-control"
                                name="password" placeholder="Min. 6 characters" required>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" id="password_confirmation" class="form-control"
                                name="password_confirmation" placeholder="Repeat password" required>
                        </div>
                        @error('password_confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-plus me-2"></i> Create Account
                    </button>

                    <div class="text-center my-3">
                        <a href="{{ route('auth.google.redirect') }}" class="btn btn-outline-secondary btn-google">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" style="width:18px; height:18px; vertical-align:middle; margin-right:8px"> Register with Google
                        </a>
                    </div>

                    <p class="text-center mt-3 mb-0" style="font-size:.83rem; color:#64748b">
                        Already have an account?
                        <a href="{{ route('login') }}" class="auth-link ms-1">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection