@extends('auth.layout')

@section('content')
    <main class="login-form">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card card-shadow border-0">
                        <div class="card-header bg-white text-center py-4">
                            <h4 class="mb-0">Login to your account</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="email_address" class="form-label">E-Mail Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" id="email_address" class="form-control" name="email"
                                            value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger small">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger small">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="{{ route('forget.password.get') }}">Forgot password?</a>
                                    <button type="submit" class="btn btn-primary px-4">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection