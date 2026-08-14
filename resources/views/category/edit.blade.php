@extends('layout.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-primary fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>Edit Category
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

                <form action="{{ route('category.update', $category->id) }}" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')

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
                                value="{{ old('name', $category->name) }}" 
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
                            >{{ old('description', $category->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Action Button Group -->
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn-group" role="group" aria-label="Form actions">
                            <button type="button" class="btn btn-success" id="btnUpdate">
                                <i class="bi bi-check2-circle me-1"></i>Update Category
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
        // SweetAlert2 Confirmation on Form Submit
        const btnUpdate = document.getElementById('btnUpdate');
        const form = document.getElementById('editCategoryForm');

        if (btnUpdate) {
            btnUpdate.addEventListener('click', function (e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                Swal.fire({
                    title: 'Update Category?',
                    text: "Are you sure you want to save these changes?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-save me-1"></i>Yes, Save Changes!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        // Trigger SweetAlert2 on Success Session Flash
        @if(Session::has('category_update'))
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                html: "{!! session('category_update') !!}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush