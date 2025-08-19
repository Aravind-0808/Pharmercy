@extends('Customer::layout.app')

@section('title', 'Payment Checkout')

@section('content')
    <div class="container py-5">
        <h2 class="text-center">Proceed with Payment</h2>

        <div class="container py-3 d-flex justify-content-center">
            <div class="card shadow-sm p-4" style="max-width: 800px; width: 100%;">
                <h4 class="mb-3">Order Details</h4>
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Amount:</strong> ₹{{ $order->total_amount }}</p>

                @if($order->address)
                    <h5 class="mt-4">Shipping Address</h5>
                    <p>
                        {{ $order->address->first_name }} {{ $order->address->last_name }}<br>
                        {{ $order->address->door_no }}, {{ $order->address->street }}<br>
                        {{ $order->address->city }}, {{ $order->address->district }}<br>
                        {{ $order->address->state }}, {{ $order->address->country }} - {{ $order->address->zip }}<br>
                        Phone: {{ $order->address->phone }}
                    </p>
                @endif

                <form action="{{ route('payment.success') }}" method="POST">
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ $razorpayKey }}"
                        data-amount="{{ $razorpayOrder['amount'] }}" data-currency="INR"
                        data-order_id="{{ $razorpayOrder['id'] }}" data-buttontext="Pay Now" data-name="Pharmercy"
                        data-description="Order Payment" data-theme.color="#0d6efd">
                        </script>
                </form>
            </div>
        </div>
    </div>
    <style>
        .razorpay-payment-button{
            background-color: #1abc9c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
    </style>
@endsection