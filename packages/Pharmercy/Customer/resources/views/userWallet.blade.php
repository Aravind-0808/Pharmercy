@extends('Customer::layout.app')

@section('title', 'My Wallet')

@section('content')
<div class="container py-4">
    <div class="row g-4">

        <!-- Wallet Balance -->
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Wallet Balance</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Current Balance:</span>
                        <span class="fw-bold text-success" style="font-size: 1.25rem;">
                            ₹{{ number_format($walletBalance ?? 0, 2) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wallet Transactions -->
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <h5 class="fw-bold p-3 mb-0">Wallet Transactions</h5>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($walletTransactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td class="{{ $transaction->type === 'credit' ? 'text-success' : 'text-danger' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </td>
                                        <td>₹{{ number_format($transaction->amount, 2) }}</td>
                                        <td>#{{ $transaction->order_id }}</td>
                                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary">
                                            No transactions found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
        .wallet-card {
            max-width: 500px;
            margin: 0 auto;
        }
    }
</style>
@endsection
