@extends('Admin::layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Store Wallets</h2>

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>Store ID</th>
                <th>Store Name</th>
                <th>Total Wallet Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($storeWallets as $wallet)
                <tr>
                    <td>{{ $wallet->store_id }}</td>
                    <td>{{ $wallet->store->name ?? 'N/A' }}</td>
                    <td>₹{{ number_format($wallet->total_amount, 2) }}</td>
                    <td>
                        <a href="/" 
                           class="btn btn-sm btn-info">
                           View Transactions
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
