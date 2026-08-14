@extends('auth.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="auth-card">
                <div class="auth-card-header">
                    <div class="auth-icon"><i class="fas fa-lock"></i></div>
                    <h4>Welcome back</h4>
                    <p>Sign in to your 24/7 NHAM account</p>
                </div>
                <div class="auth-card-body">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email_address" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" id="email_address" class="form-control" name="email"
                                    value="{{ old('email') }}" placeholder="your@email.com" required autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="••••••••" required>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                                <label class="form-check-label" for="remember"
                                    style="font-size:.83rem; color:#64748b">Remember me</label>
                            </div>
                            <a href="{{ route('forget.password.get') }}" class="auth-link">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-sign-in-alt me-2"></i> Sign In
                        </button>

                        <div class="text-center my-3">
                            <a href="{{ route('auth.google.redirect') }}"
                                class="btn btn-primary btn-google d-inline-flex align-items-center justify-content-center">

                                <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google"
                                    style="width: 20px; height: 20px; margin-right: 12px;">

                                <span>Sign in with Google</span>
                            </a>
                        </div>

                        <p class="text-center mt-3 mb-0" style="font-size:.83rem; color:#64748b">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="auth-link ms-1">Create one</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection