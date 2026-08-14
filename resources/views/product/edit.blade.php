@extends('layout.backend')

@section('content')
<main>
    <div class="container-fluid px-4">
        <!-- Page Title & Breadcrumbs -->
        <h1 class="mt-4 text-primary fw-bold">
            <i class="bi bi-box-seam me-2"></i>Edit Product
        </h1>
        <ol class="breadcrumb mb-4 bg-light p-2 rounded-3">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('product.index') }}" class="text-decoration-none">
                    <i class="bi bi-grid me-1"></i>Products
                </a>
            </li>
            <li class="breadcrumb-item active">
                <i class="bi bi-plus-square me-1"></i>Create Product
            </li>
        </ol>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold text-secondary">
                    <i class="bi bi-pencil-square me-2"></i>Product Details Form
                </h5>
                <span class="badge bg-light text-muted border">New Entry</span>
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

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="createProductForm">
                    @csrf
                    
                    <div class="row">
                        <!-- Category Select -->
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label fw-semibold">Category:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-folder"></i>
                                </span>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select category</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">Product Name:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-tag"></i>
                                </span>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter product name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Price -->
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-semibold">Price ($):</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>
                                <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="0.00" required>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label fw-semibold">Product Image:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-image"></i>
                                </span>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                            </div>
                        </div>
                    </div>

                    <!-- Image Preview Placeholder -->
                    <div class="mb-3 d-none" id="imagePreviewContainer">
                        <label class="form-label fw-semibold text-muted small">Image Preview:</label>
                        <div>
                            <img id="imagePreview" src="#" alt="Preview" class="img-thumbnail rounded shadow-sm" style="max-height: 150px;">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter product description" required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Action Button Group -->
                    <div class="" aria-label="Product Form Actions">
                        <button type="button" class="btn btn-success" id="btnSubmit">
                            <i class="bi bi-check-lg me-1"></i>Save Product
                        </button>
                        <a class="btn btn-danger" href="{{ route('product.index') }}">
                            <i class="bi bi-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </form>
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
        const form = document.getElementById('createProductForm');
        const btnSubmit = document.getElementById('btnSubmit');
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');

        // Image Preview Handler
        if (imageInput) {
            imageInput.addEventListener('change', function () {
                const [file] = this.files;
                if (file) {
                    imagePreview.src = URL.createObjectURL(file);
                    imagePreviewContainer.classList.remove('d-none');
                }
            });
        }

        // SweetAlert2 Confirmation on Submit Button Click
        if (btnSubmit) {
            btnSubmit.addEventListener('click', function (e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                Swal.fire({
                    title: 'Edit Product?',
                    text: 'Are you sure you want to edit this product?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-check-lg me-1"></i>Yes, Save!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        // Trigger SweetAlert2 Flash Toast on Success Session
        @if(Session::has('product_create'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                html: "{!! session('product_create') !!}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush