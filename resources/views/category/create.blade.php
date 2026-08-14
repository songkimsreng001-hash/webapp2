@extends('layout.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-primary fw-bold">
                    <i class="bi bi-folder-plus me-2"></i>Create Category
                </h4>
            </div>
            
            <div class="card-body p-4">
                {{-- Form Error List --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                            <strong>Please fix the following errors:</strong>
                        </div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('category.store') }}" method="POST">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Name:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary">
                                <i class="bi bi-tag"></i>
                            </span>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                placeholder="Enter category name"
                                required
                            >
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <textarea 
                                name="description" 
                                id="description" 
                                class="form-control @error('description') is-invalid @enderror" 
                                rows="4" 
                                placeholder="Enter category description"
                                required
                            >{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Action Button Group -->
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn-group" role="group" aria-label="Form actions">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-lg me-1"></i>Create Category
                            </button>
                        </div>
                        <div class="btn-group" role="group" aria-label="Form actions">
                            <a href="{{ route('category.list') }}" class="btn btn-danger">
                                <i class="bi bi-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                </form>
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
        // Trigger SweetAlert2 on Success Session Flash
        @if(Session::has('category_create'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                html: "{!! session('category_create') !!}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush