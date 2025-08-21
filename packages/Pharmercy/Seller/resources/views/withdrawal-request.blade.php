@extends('Seller::layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Wallet Withdrawals</h2>

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="withdrawalTableBody">
                @if (count($withdrawals) > 0)
                    @foreach($withdrawals as $withdrawal)
                        <tr data-id="{{ $withdrawal->id }}">
                            <td>{{ $withdrawal->id }}</td>
                            <td>₹ {{ number_format($withdrawal->amount, 2) }}</td>
                            <th>{{ $withdrawal->status }}</th>
                            <td>{{ $withdrawal->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <form action="/" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                <!-- Optional: View details -->
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#viewWithdrawalModal{{ $withdrawal->id }}">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (count($withdrawals) === 0)
                    <tr>
                        <td colspan="5" class="text-center">No withdrawal requests found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection