@extends('layout.frontend')
@section('page-title', 'About — 24/7 NHAM')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="brand-icon"><i class="bi bi-shop"></i></div>
                        <div>
                            <div class="text-success fw-semibold small">24/7 NHAM</div>
                            <h1 class="h3 fw-bold mb-0">About our store</h1>
                        </div>
                    </div>
                    <p class="lead text-secondary">A simple, friendly online store for food, drinks and everyday products.</p>
                    <p class="text-secondary mb-0">Browse products, search by name, add items to your cart, and complete checkout securely through Stripe.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
