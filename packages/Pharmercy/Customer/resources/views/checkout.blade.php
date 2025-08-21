@extends('Customer::layout.app')

@section('title', 'Address')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Address Form -->
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="h4 mb-4">Shipping Address</h2>
                    @if($address)
                        <div class="alert alert-info mb-4">
                            <strong>Note:</strong> You have already saved an address. You can edit it on your profile.
                        </div>
                    @endif
                    <form method="POST" action="{{ route('customer.checkout.storeAddress') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name', $address->first_name ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                            <div class="col">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $address->last_name ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $address->phone ?? '') }}"
                                @if($address) readonly @endif required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alternate Phone Number</label>
                            <input type="text" name="alt_phone" class="form-control"
                                value="{{ old('alt_phone', $address->alt_phone ?? '') }}"
                                @if($address) readonly @endif>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Door Number</label>
                                <input type="text" name="door_no" class="form-control"
                                    value="{{ old('door_no', $address->door_no ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                            <div class="col">
                                <label class="form-label">Street</label>
                                <input type="text" name="street" class="form-control"
                                    value="{{ old('street', $address->street ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control"
                                    value="{{ old('city', $address->city ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                            <div class="col">
                                <label class="form-label">District</label>
                                <input type="text" name="district" class="form-control"
                                    value="{{ old('district', $address->district ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control"
                                    value="{{ old('state', $address->state ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                            <div class="col">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control"
                                    value="{{ old('country', $address->country ?? '') }}"
                                    @if($address) readonly @endif required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zip" class="form-control"
                                value="{{ old('zip', $address->zip ?? '') }}"
                                @if($address) readonly @endif required>
                        </div>

                        @unless($address)
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Save Address & Continue</button>
                            </div>
                        @endunless
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-5">
            <div class="card border-1 shadow-sm">
                <div class="card-body">
                    <h2 class="h4 mb-4">Product Details</h2>

                    <!-- Product Image -->
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product" class="rounded"
                            style="width: 100%; max-height: 250px; object-fit: cover;">
                    </div>

                    <!-- Product Info -->
                    <div class="mb-2">
                        <div class="fw-bold h5 mb-1">{{ $product->name }}</div>
                        <div class="text-muted mb-2">{{ $product->description }}</div>
                        <div class="fw-bold h5 mb-3">Quantity: {{ $quantity }}</div>
                        <div class="h4 text-success mb-0">₹{{ (float) $product->selling_price * (int) $quantity }}</div>
                    </div>

                    <!-- Payment Options -->
                    <div class="mt-4">
                        <label class="fw-bold mb-2">Payment Options</label>

                        <!-- Razorpay Option -->
                        <div class="p-3 border rounded bg-light mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <small class="text-muted d-block">Razorpay</small>
                                </div>
                                <button type="button" class="btn btn-success px-4 pay-btn" data-method="razorpay">
                                    Proceed to Pay
                                </button>
                            </div>
                        </div>

                        <!-- Wallet Option -->
                        <div class="p-3 border rounded bg-light mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <small class="text-muted d-block">Wallet</small>
                                </div>
                                <button type="button" class="btn btn-success px-4 pay-btn" data-method="wallet">
                                    Pay with Wallet
                                </button>
                            </div>
                        </div>

                        <!-- Cash on Delivery Option -->
                        <div class="p-3 border rounded bg-light mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <small class="text-muted d-block">Cash on Delivery</small>
                                </div>
                                <button type="button" class="btn btn-warning px-4 pay-btn" data-method="cod">
                                    Cash on Delivery
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Razorpay Modal -->
<div class="modal fade" id="orderConfirmModal" tabindex="-1" aria-labelledby="orderConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="orderConfirmLabel">Pay with Razorpay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>You have selected <strong>Razorpay</strong>. Please confirm your order.</p>
                <p class="text-muted">Total amount to pay: ₹{{ (float) $product->selling_price * (int) $quantity }}</p>
                <form method="POST" action="{{ route('customer.checkout.placeOrder') }}">
                    @csrf
                    <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="store_id" value="{{ $product->store_id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="{{ $quantity }}">
                    <input type="hidden" name="total_amount" value="{{ (float) $product->selling_price * (int) $quantity }}">
                    <input type="hidden" name="status" value="pending">
                    <input type="hidden" name="payment_type" value="1">
                    <input type="hidden" name="ordered_at" value="{{ now() }}">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Continue to Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Wallet Modal -->
<div class="modal fade" id="walletModal" tabindex="-1" aria-labelledby="walletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="walletModalLabel">Pay with Wallet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>Your available wallet balance is:</p>
                <h3 class="text-success" id="walletBalance">₹{{ $WalletAmount ?? 0 }}</h3>
                <p class="text-muted">Total amount to pay: ₹{{ (float) $product->selling_price * (int) $quantity }}</p>

                @if($WalletAmount >= ((float) $product->selling_price * (int) $quantity))
                    <form method="POST" action="{{ route('customer.checkout.placeOrder') }}">
                        @csrf
                        <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="store_id" value="{{ $product->store_id }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="{{ $quantity }}">
                        <input type="hidden" name="total_amount" value="{{ (float) $product->selling_price * (int) $quantity }}">
                        <input type="hidden" name="status" value="pending">
                        <input type="hidden" name="payment_type" value="wallet">
                        <input type="hidden" name="ordered_at" value="{{ now() }}">
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Pay Now</button>
                    </form>
                @else
                    <div class="alert alert-danger mt-3">
                        Insufficient wallet balance. Please add funds or choose another payment method.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Cash on Delivery Modal -->
<div class="modal fade" id="codModal" tabindex="-1" aria-labelledby="codModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="codModalLabel">Cash on Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>You have selected <strong>Cash on Delivery</strong>. Please confirm your order.</p>
                <p class="text-muted">Total amount to pay: ₹{{ (float) $product->selling_price * (int) $quantity }}</p>
                <form method="POST" action="{{ route('customer.checkout.placeOrder') }}">
                    @csrf
                    <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="store_id" value="{{ $product->store_id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="{{ $quantity }}">
                    <input type="hidden" name="total_amount" value="{{ (float) $product->selling_price * (int) $quantity }}">
                    <input type="hidden" name="status" value="pending">
                    <input type="hidden" name="payment_type" value="3">
                    <input type="hidden" name="ordered_at" value="{{ now() }}">
                    <button type="submit" class="btn btn-warning btn-lg mt-3">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const payButtons = document.querySelectorAll('.pay-btn');

    payButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const method = this.getAttribute('data-method');

            if(method === 'razorpay') {
                const orderModal = new bootstrap.Modal(document.getElementById('orderConfirmModal'));
                orderModal.show();
            }

            if(method === 'wallet') {
                const walletModal = new bootstrap.Modal(document.getElementById('walletModal'));
                walletModal.show();
            }
            if(method === 'cod') {
                const codModal = new bootstrap.Modal(document.getElementById('codModal'));
                codModal.show();
            }
        });
    });
});
</script>
@endpush
