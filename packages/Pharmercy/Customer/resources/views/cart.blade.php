@extends('Customer::layout.app')

@section('title', 'My Cart')

@section('content')
    <div class="container py-4">
        <div class="row g-4">

            <!-- Cart Items -->
            <div class="col-12">
                <div class="shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cart->count() > 0)
                                        @foreach($cart as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                        class="img-fluid product-thumbnail rounded" width="70">
                                                </td>
                                                <td class="fw-semibold">{{ $item->product->name }}</td>
                                                <td class="text-success fw-bold">₹{{ $item->product->selling_price }}</td>
                                                <td class="text">{{ $item->quantity }}</td>
                                                <td class="fw-bold">
                                                    ₹{{ $item->product->selling_price * $item->quantity }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('customer.cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <!-- Empty Cart Row -->
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-center p-5">
                                                    <i class="bi bi-cart-x display-1 text-muted"></i>
                                                    <h4 class="mt-3">Your Cart is Empty</h4>
                                                    <p class="text-muted">Looks like you haven't added anything to your cart
                                                        yet.</p>
                                                    <a href="/customer" class="btn btn-primary mt-2">
                                                        <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Totals (Now placed below items) -->
            @if($cart->count() > 0)
                <div class="col-12 mt-4">
                    <div class="card shadow-sm border-0 cart-totals-card">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Cart Totals</h5>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Products</span>
                                <strong>{{ count($cart) }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Amount</span>
                                <strong class="text-success"> ₹{{ $cart->sum(fn($item) => $item->product->selling_price * $item->quantity) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-4 border-top pt-2">
                                <span>Average Order Value</span>
                                <strong> ₹{{ number_format($cart->avg(fn($item) => $item->product->selling_price * $item->quantity), 2) }}</strong>
                            </div>
                            <form action="{{ route('customer.cart-order') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100 btn-lg">
                                    Place Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection