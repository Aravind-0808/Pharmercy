@extends('Customer::layout.app')

@section('title', 'My Orders')

@section('content')
    <div class="container py-4">
        <div class="row g-4">
            <!-- Orders List -->
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="fw-bold">
                                                # {{ $order->id }}
                                            </td>
                                            <td class="fw-semibold">{{ $order->product->name }}</td>
                                            <td class="text-success fw-bold">
                                                ₹{{ number_format($order->product->selling_price, 2) }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td class="fw-bold">
                                                ₹{{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                @if($order->status == 'pending')
                                                   <span class="text-danger d-flex align-items-center">
                                                        <i class="fas fa-times-circle me-2"></i> Pending
                                                    </span>
                                                @elseif ($order->status == 'paid')
                                                    <span class="text-success d-flex align-items-center">
                                                        <i class="fas fa-check-circle me-2"></i> Paid
                                                    </span>
                                                @elseif ($order->status == 'cancelled')
                                                    <span class="text-danger d-flex align-items-center">
                                                        <i class="fas fa-times-circle me-2"></i> Cancelled
                                                    </span>
                                                @else
                                                    <span class="text-secondary d-flex align-items-center">
                                                        <i class="fas fa-info-circle me-2"></i> {{ ucfirst($order->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="text-dark" data-bs-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        @if($order->status == 'paid')
                                                            <li>
                                                                <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" class="mb-0">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                    Cancel Order
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if ($order->status == 'pending')
                                                            <li><a class="dropdown-item text-danger" href="{{ route('payment.initiate', $order->id) }}">Complete Payment</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Total Orders Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Orders</span>
                            <strong>8</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Items Purchased</span>
                            <strong>24</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Amount Spent</span>
                            <strong class="text-success">$1,520.00</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-4 border-top pt-2">
                            <span>Average Order Value</span>
                            <strong>$190.00</strong>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        thead.bg-light th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .table td,
        .table th {
            vertical-align: middle;
            padding: 14px;
        }

        @media (min-width: 992px) {
            .cart-totals-card {
                max-width: 500px;
                margin: 0 auto;
            }
        }

        .btn-success {
            font-size: 1.05rem;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
        }

        .table img {
            border-radius: 8px;
            object-fit: cover;
        }
    </style>
@endsection