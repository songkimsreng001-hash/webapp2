@extends('auth.layout')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-shield-lock me-2"></i>Change Password
                    </h5>
                    <span class="badge bg-light text-muted border">Security</span>
                </div>

                <div class="card-body p-4">
                    {{-- Form Validation Error Alert --}}
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

                    <form method="POST" action="{{ route('change.password') }}" id="changePasswordForm">
                        @csrf

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password" placeholder="Enter current password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label fw-semibold">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password" placeholder="Enter new password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Confirm Password -->
                        <div class="mb-4">
                            <label for="new_confirm_password" class="form-label fw-semibold">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" autocomplete="new-password" placeholder="Re-enter new password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_confirm_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Action Button Group -->
                        <div class="d-flex justify-content-end">
                            <div class="btn-group" role="group" aria-label="Password Form Actions">
                                <a href="{{ url()->previous() }}" class="btn btn-danger">
                                    <i class="bi bi-arrow-left me-1"></i>Cancel
                                </a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Password Form Actions">
                                <button type="button" class="btn btn-success" id="btnUpdatePassword">
                                    <i class="bi bi-check-circle me-1"></i>Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('changePasswordForm');
        const btnSubmit = document.getElementById('btnUpdatePassword');

        // Toggle Password Visibility Functionality
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

        // SweetAlert2 Confirmation Popup
        if (btnSubmit) {
            btnSubmit.addEventListener('click', function (e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                Swal.fire({
                    title: 'Update Password?',
                    text: 'Are you sure you want to change your password?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-check-circle me-1"></i>Yes, Update!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        // SweetAlert2 Toast for Success Flash Session
        @if(Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                html: "{!! session('success') !!}",
                timer: 3500,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush