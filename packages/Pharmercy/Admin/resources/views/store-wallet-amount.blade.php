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
           @if (count($storeWallets) > 0)
               @foreach($storeWallets as $wallet)
                   <tr>
                       <td>{{ $wallet->store_id }}</td>
                       <td>{{ $wallet->store->name ?? 'N/A' }}</td>
                       @if ($wallet->total_balance >= 0)
                       <td class="text-success">₹{{ number_format($wallet->total_balance, 2) }}</td>
                       @endif
                       @if ($wallet->total_balance < 0)
                           <td class="text-danger">₹{{ number_format($wallet->total_balance, 2) }}</td>
                       @endif
                       <td>
                           <a href="/" 
                              class="btn btn-sm btn-info">
                              View Transactions
                           </a>
                       </td>
                   </tr>
               @endforeach
           @endif
           @if (count($storeWallets) === 0)
               <tfoot>
                   <tr>
                       <td colspan="4" class="text-center">No store wallets found.</td>
                   </tr>
               </tfoot>
           @endif
        </tbody>
    </table>
</div>
@endsection
