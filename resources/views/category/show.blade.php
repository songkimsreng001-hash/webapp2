@extends('layout.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <!-- Header -->
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-primary fw-bold">
                    <i class="bi bi-info-circle me-2"></i>Category Details
                </h4>
                <span class="badge bg-light text-dark border">ID: #{{ $category->id }}</span>
            </div>

            <!-- Body -->
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="text-muted small text-uppercase fw-bold">Name</label>
                    <p class="fs-5 fw-semibold text-dark mb-0">
                        <i class="bi bi-tag me-2 text-primary"></i>{{ $category->name }}
                    </p>
                </div>

                <hr class="my-3 text-muted opacity-25">

                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-bold">Description</label>
                    <p class="text-secondary mb-0">
                        <i class="bi bi-card-text me-2 text-primary"></i>{{ $category->description ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Button Action Group -->
                <div class="" role="" aria-label="Category Detail Actions">
                    <a class="btn btn-secondary" href="{{ route('category.list') }}">
                        <i class="bi bi-arrow-left"></i>Back
                    </a>
                    <a class="btn btn-primary" href="{{ url('/category/' . $category->id . '/edit') }}">
                        <i class="bi bi-pencil me-1"></i>Edit Category
                    </a>
                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $category->id }}">
                        <i class="bi bi-trash me-1"></i>Delete
                    </button>
                </div>

                <!-- Hidden Delete Form -->
                <form id="delete-form-{{ $category->id }}" action="{{ route('category.delete', $category->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
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
        // SweetAlert2 confirmation on quick delete action
        const deleteBtn = document.querySelector('.btn-delete');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function () {
                const categoryId = this.getAttribute('data-id');
                const form = document.getElementById(`delete-form-${categoryId}`);

                Swal.fire({
                    title: 'Delete Category?',
                    text: 'Are you sure you want to delete this category?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-trash me-1"></i>Yes, Delete!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }
    });
</script>
@endpush