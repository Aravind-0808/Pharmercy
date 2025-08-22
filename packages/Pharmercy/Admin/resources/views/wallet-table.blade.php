@extends('Admin::layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Wallet Management</h2> 
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Store ID</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="transactionTableBody">
           @if (count($walletTransactions) > 0)
               @foreach($walletTransactions as $transaction)
                   <tr data-id="{{ $transaction->id }}">
                       <td>{{ $transaction->id }}</td>
                       <td>{{ $transaction->store_id }}</td>
                       <td>{{ $transaction->transaction_id ?? 'Null' }}</td>
                       <td>{{ number_format($transaction->amount, 2) }}</td>
                       <td>{{ ucfirst($transaction->type) }}</td>
                       <td>{{ $transaction->description }}</td>
                       <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                       <td>
                           <form action="/" method="POST" style="display:inline-block;">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                           </form>
                       </td>
                   </tr>
               @endforeach
           @endif
           @if (count($walletTransactions) == 0)
               <tfoot>
                   <tr>
                       <td colspan="7" class="text-center">No wallet transactions found.</td>
                   </tr>
               </tfoot>
           @endif
        </tbody>
    </table>
</div>
@endsection
