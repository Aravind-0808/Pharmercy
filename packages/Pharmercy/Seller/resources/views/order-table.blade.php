@extends('Seller::layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Orders Management</h2>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addOrderModal">Add New Order</button>
    
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Store ID</th>
                <th>Product ID</th>
                <th>Address ID</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Ordered At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="orderTableBody">
            @foreach($orders as $order)
                <tr data-id="{{ $order->id }}">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->store_id }}</td>
                    <td>{{ $order->product_id }}</td>
                    <td>{{ $order->address_id }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->total_amount }}</td>         
                    <td>{{ $order->ordered_at }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('seller.generate.invoice', $order->id) }}" class="btn btn-sm btn-info">Generate Invoice</a>
                        <button class="btn btn-sm btn-danger deleteOrderBtn">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
