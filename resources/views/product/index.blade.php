@extends('layout.backend')

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-primary fw-bold">
            <i class="bi bi-box-seam me-2"></i>Product List
        </h4>
        <a class="btn btn-primary" href="{{ url('/product/create') }}">
            <i class="bi bi-plus-lg me-1"></i>New Product
        </a>
    </div>

    <div class="card-body p-0">
        @if (count($products) > 0)
            <div class="table-responsive">
                <table id="myTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th class="text-center" width="120">IMAGE</th>
                            <th>PRICE</th>
                            <th class="text-center" width="180">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <a href="{{ url('/product/'.$product->id) }}" class="text-decoration-none fw-semibold link-primary">
                                    <i class="bi bi-tag me-1 text-secondary"></i>{{ $product->name }}
                                </a>
                            </td>
                            <td class="text-muted small">
                                {!! $product->description !!}
                            </td>
                            <td class="text-center">
                                <img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->name }}" class="rounded img-thumbnail shadow-sm" style="width:60px; height:60px; object-fit:cover;" />
                            </td>
                            <td class="fw-bold text-success">
                                ${{ number_format((float)$product->price, 2) }}
                            </td>
                            <td class="text-center">
                                <!-- Action Button Group -->
                                <div class="" aria-label="Product Actions">
                                    <a class="btn btn-sm btn-outline-primary" href="{!! url('product/' . $product->id . '/edit') !!}" title="Edit Product">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Delete Product">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox text-muted display-4"></i>
                <p class="text-muted mt-2 mb-0">No products found.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // SweetAlert2 Confirmation for Product Deletion
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');
                
                Swal.fire({
                    title: 'Delete product?',
                    text: 'This product will be permanently deleted.',
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
        });

        // Trigger SweetAlert2 Toast on Success Session Flash
        @if(Session::has('product_delete'))
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                html: "{!! session('product_delete') !!}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush