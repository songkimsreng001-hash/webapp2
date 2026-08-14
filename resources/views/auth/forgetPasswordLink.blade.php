@extends('auth.layout')

@section('content')
<main class="login-form py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-shield-lock me-2"></i>Reset Password
                        </h5>
                        <span class="badge bg-light text-muted border">Security</span>
                    </div>

                    <div class="card-body p-4">
                        {{-- Form Error Summary Alert --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-exclamation-octagon-fill fs-5 me-2"></i>
                                    <strong>Please fix the following issues:</strong>
                                </div>
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('reset.password.post') }}" method="POST" id="resetPasswordForm">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Email Address Input -->
                            <div class="mb-3">
                                <label for="email_address" class="form-label fw-semibold">E-Mail Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" id="email_address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your registered email">
                                    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- New Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter new password">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" id="password-confirm" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="Re-enter new password">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password-confirm">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Button Group -->
                            <div class="d-flex justify-content-end">
                                <div aria-label="Reset Password Actions">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">
                                        <i class="bi bi-arrow-left me-1"></i>Cancel
                                    </a>
                                    <button type="button" class="btn btn-primary" id="btnResetPassword">
                                        <i class="bi bi-check-circle me-1"></i>Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<!-- SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('resetPasswordForm');
        const btnSubmit = document.getElementById('btnResetPassword');

        // Toggle Password Visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });
        });

        // SweetAlert2 Confirmation Dialog
        if (btnSubmit) {
            btnSubmit.addEventListener('click', function (e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                Swal.fire({
                    title: 'Reset Password?',
                    text: 'Are you sure you want to set this as your new password?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-check-circle me-1"></i>Yes, Reset It!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        // SweetAlert2 Toast for Flash Session
        @if(Session::has('message'))
            Swal.fire({
                icon: 'info',
                title: 'Notice',
                html: "{!! session('message') !!}",
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush