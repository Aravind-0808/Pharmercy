@extends('Customer::layout.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow border-0 text-center p-4">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                </div>

                <h2 class="mb-3">Payment Successful!</h2>
                <p class="mb-4">Your order <strong>#{{ $order->id }}</strong> has been placed successfully.</p>

                <h5>Order Details</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Order ID:</span> <strong>#{{ $order->id }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Amount Paid:</span> <strong class="text-success">₹{{ $order->total_amount }}</strong>
                    </li>
                    <li class="list-group-item customer.orders.indexd-flex justify-content-between">
                        <span>Status:</span> <strong class="text-success">{{ $order->status }}</strong>
                    </li>
                </ul>

                <a href="{{ route('customer.index') }}" class="btn btn-primary">Go to Home</a>
                <a href="{{ route('customer.index') }}" class="btn btn-outline-secondary">View My Orders</a>
            </div>

        </div>
    </div>
</div>
@endsection
