@extends('auth.layout')

@section('content')
<main class="login-form py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-key me-2"></i>Reset Password
                        </h5>
                        <span class="badge bg-light text-muted border">Recovery</span>
                    </div>

                    <div class="card-body p-4">
                        {{-- Form Error Alert --}}
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

                        <form action="{{ route('forget.password.post') }}" method="POST" id="resetPasswordForm">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-4">
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

                            <!-- Action Button Group -->
                            <div class="d-flex justify-content-end">
                                <div class="" role="" aria-label="Reset Password Actions">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">
                                        <i class="bi bi-arrow-left me-1"></i>Back
                                    </a>
                                    <button type="button" class="btn btn-primary" id="btnSendResetLink">
                                        <i class="bi bi-send me-1"></i>Send Password Reset Link
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
        const btnSubmit = document.getElementById('btnSendResetLink');

        // SweetAlert2 Interactive Confirmation Popup
        if (btnSubmit) {
            btnSubmit.addEventListener('click', function (e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                Swal.fire({
                    title: 'Send Reset Link?',
                    text: 'A password reset link will be sent to your email address.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-send me-1"></i>Yes, Send Link!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        // SweetAlert2 Toast for Flash Session Message
        @if(Session::has('message'))
            Swal.fire({
                icon: 'success',
                title: 'Link Sent!',
                html: "{!! session('message') !!}",
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush