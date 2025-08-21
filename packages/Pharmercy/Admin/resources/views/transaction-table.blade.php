@extends('Admin::layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Transactions Management</h2> 
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Razorpay Order ID</th>
                <th>Razorpay Payment ID</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="transactionTableBody">
           @if (count($transactions) > 0)
            @foreach($transactions as $transaction)
                <tr data-id="{{ $transaction->id }}">
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->razorpay_order_id }}</td>
                    <td>{{ $transaction->razorpay_payment_id }}</td>
                    <td>{{ $transaction->order_id }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ ucfirst($transaction->status) }}</td>
                    <td>
                        <button class="btn btn-sm btn-danger deleteTransactionBtn">Delete</button>
                    </td>
                </tr>
            @endforeach
           @endif
           @if (count($transactions) == 0)
               <tfoot>
                   <tr>
                       <td colspan="7" class="text-center">No transactions found.</td>
                   </tr>
               </tfoot>
           @endif
        </tbody>
    </table>
</div>
@endsection
