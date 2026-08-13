@extends('layout.frontend')
@section('page-title', 'Secure Checkout — 24/7 NHAM')

@section('content')
<div class="container py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-3 bg-success-subtle text-success p-2">
                            <i class="bi bi-credit-card-2-front fs-4"></i>
                        </div>
                        <div>
                            <div class="small text-success fw-semibold">SECURE PAYMENT</div>
                            <h1 class="h4 fw-bold mb-0">Checkout</h1>
                        </div>
                    </div>

                    <div id="payment-error" class="alert alert-danger d-none"></div>
                    <form id="payment-form">
                        <label class="form-label fw-semibold">Payment details</label>
                        <div id="payment-element" class="border rounded-3 p-3 bg-light"></div>
                        <button id="pay-button" class="btn btn-success w-100 rounded-3 py-2 mt-4" type="submit">
                            <span id="button-text"><i class="bi bi-lock-fill me-1"></i> Pay ${{ number_format($totalAmount, 2) }}</span>
                            <span id="button-spinner" class="spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                        </button>
                    </form>
                    <div class="text-center small text-secondary mt-3">
                        <i class="bi bi-shield-check me-1"></i> Your payment is processed securely by Stripe.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h2 class="h6 fw-bold mb-3">Order summary</h2>
                    @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between gap-3 small py-2 border-bottom">
                            <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                            <strong>${{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between mt-3">
                        <strong>Total</strong>
                        <strong class="text-success">${{ number_format($totalAmount, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', async function () {
    const stripe = Stripe(@json($stripeKey));
    const form = document.getElementById('payment-form');
    const button = document.getElementById('pay-button');
    const errorBox = document.getElementById('payment-error');
    const spinner = document.getElementById('button-spinner');
    const buttonText = document.getElementById('button-text');

    if (!@json($stripeKey)) {
        errorBox.textContent = 'Stripe is not configured. Please add STRIPE_KEY to your .env file.';
        errorBox.classList.remove('d-none');
        button.disabled = true;
        return;
    }

    try {
        const response = await fetch('{{ route('payment.intent') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();
        if (!response.ok) throw new Error(data.message || 'Unable to start payment.');

        const elements = stripe.elements({ clientSecret: data.clientSecret, appearance: { theme: 'stripe' } });
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            button.disabled = true;
            spinner.classList.remove('d-none');
            buttonText.classList.add('d-none');
            errorBox.classList.add('d-none');

            const result = await stripe.confirmPayment({
                elements,
                redirect: 'if_required',
                confirmParams: { return_url: @json(route('cart.checkout')) }
            });

            if (result.error) {
                errorBox.textContent = result.error.message || 'Payment failed.';
                errorBox.classList.remove('d-none');
                button.disabled = false;
                spinner.classList.add('d-none');
                buttonText.classList.remove('d-none');
                return;
            }

            if (result.paymentIntent && result.paymentIntent.status === 'succeeded') {
                const complete = document.createElement('form');
                complete.method = 'POST';
                complete.action = @json(route('checkout.complete'));
                complete.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="payment_intent_id" value="${result.paymentIntent.id}">
                `;
                document.body.appendChild(complete);
                complete.submit();
            } else {
                errorBox.textContent = 'Payment is not complete yet. Please check your payment status.';
                errorBox.classList.remove('d-none');
                button.disabled = false;
                spinner.classList.add('d-none');
                buttonText.classList.remove('d-none');
            }
        });
    } catch (error) {
        errorBox.textContent = error.message || 'Unable to initialize payment.';
        errorBox.classList.remove('d-none');
        button.disabled = true;
    }
});
</script>
@endpush
