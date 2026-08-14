@extends('layout.backend')
@section('title', 'ORDERS LIST')

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-receipt me-2"></i>@yield('title')
        </h5>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="orderId">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" width="60">NO.</th>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>ORDER ID</th>
                        <th>ORDER ITEMS</th>
                        <th>TOTAL</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center" width="180">OPTIONS</th>
                    </tr>
                </thead>
                <tbody id="tbl">
                    @foreach ($orders as $order)
                    <tr>
                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">
                            <i class="bi bi-person me-1 text-secondary"></i>{{ $order->user->name }}
                        </td>
                        <td>
                            <i class="bi bi-envelope me-1 text-secondary"></i>{{ $order->user->email }}
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">#{{ $order->id }}</span>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach ($order->orderItems as $item)
                                    <li class="small text-muted">
                                        <i class="bi bi-box-seam me-1"></i>
                                        <span class="fw-medium text-dark">{{ $item->product->name }}</span> 
                                        <span class="badge bg-secondary ms-1">x{{ $item->quantity }}</span>
                                        <span class="text-success ms-1">${{ $item->product->price * $item->quantity }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="fw-bold text-success">${{ number_format($order->amount, 2) }}</td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-info-circle me-1"></i>{{ $order->statusLabel() }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Order Actions">
                                <!-- Confirm Form -->
                                <form action="{{ route('admin.approve', $order->id) }}" method="POST" class="d-inline confirm-form">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-success btn-confirm me-1" title="Approve Order">
                                        <i class="bi bi-check-circle me-1"></i>Approve
                                    </button>
                                </form>

                                <!-- Reject Form -->
                                <form action="{{ route('admin.reject', $order->id) }}" method="POST" class="d-inline reject-form">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-reject" title="Reject Order">
                                        <i class="bi bi-x-circle me-1"></i>Reject
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // SweetAlert2 for Confirm / Approve
        document.querySelectorAll('.btn-confirm').forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Approve Order?',
                    text: "Are you sure you want to approve this order?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-check-lg me-1"></i>Yes, Approve!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // SweetAlert2 for Reject
        document.querySelectorAll('.btn-reject').forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Reject Order?',
                    text: "This action will reject the order.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-x-lg me-1"></i>Yes, Reject!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush