@extends('auth.layout')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-person-gear me-2"></i>{{ __('Edit Profile') }}
                    </h5>
                    <span class="badge bg-light text-muted border">Account</span>
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

                    <form method="POST" action="{{ route('profile.update', $user) }}" id="editProfileForm">
                        @csrf
                        @method('PATCH')

                        <!-- Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? auth()->user()->name }}" required autocomplete="name" autofocus placeholder="Enter your full name">
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">{{ __('E-Mail Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? auth()->user()->email }}" required autocomplete="email" placeholder="Enter your email address">
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Button Group -->
                        <div class="d-flex justify-content-end">
                            <div class="btn-group" role="group" aria-label="Profile Actions">
                                <a href="{{ url()->previous() }}" class="btn btn-danger">
                                    <i class="bi bi-arrow-left me-1"></i>Cancel
                                </a>
                            </div>
                            <div class="btn-group ms-2" role="group" aria-label="Profile Actions">
                                <button type="button" class="btn btn-success" id="btnUpdateProfile">
                                    <i class="bi bi-check-circle me-1"></i>Update Profile
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
        const form = document.getElementById('editProfileForm');
        const btnSubmit = document.getElementById('btnUpdateProfile');

        // SweetAlert2 Interactive Confirmation Popup
        if (btnSubmit) {
            btnSubmit.addEventListener('click', function (e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                Swal.fire({
                    title: 'Update Profile?',
                    text: 'Are you sure you want to save these profile changes?',
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

        // SweetAlert2 Toast for Flash Session Success
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