@extends('Customer::layout.app')

@section('title', 'Payment Failed')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow border-0 text-center p-4">
                <div class="mb-4">
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
                </div>

                <h2 class="mb-3">Payment Failed!</h2>
                <p class="mb-4">We could not process your payment for order <strong>#{{ $order_id }}</strong>.</p>

                <h5>Next Steps</h5>
                <p class="mb-4">You can try again or contact support if the problem persists.</p>

                <a href="{{ route('customer.index') }}" class="btn btn-primary">Go to Home</a>
                <a href="{{ route('customer.checkout', [$store_id, $product_id]) }}" class="btn btn-outline-secondary">Try Payment Again</a>
            </div>

        </div>
    </div>
</div>
@endsection
