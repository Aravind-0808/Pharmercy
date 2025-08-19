@extends('Seller::layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Wallet Management</h2>

        <!-- Top Section -->
        <div class="row mb-4">
            <!-- Wallet Balance -->
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h5>Total Wallet Balance</h5>
                    <h3 class="text-success">₹ {{ number_format($WalletAmount, 2) }}</h3>
                    <p class="text-muted">You can receive the money in 5 business days</p>
                    <button class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                        Withdraw Amount
                    </button>
                </div>
            </div>

            <!-- Bank Details -->
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h5>Bank Details</h5>
                    @if ($Bank_details)
                        <div class="row">
                            <div class="col-6">
                                <p><strong>Account Holder:</strong> {{ $Bank_details->account_holder_name }}</p>
                                <p><strong>Bank Name:</strong> {{ $Bank_details->bank_name }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Account No:</strong> {{ $Bank_details->account_number }}</p>
                                <p><strong>IFSC:</strong> {{ $Bank_details->ifsc_code }}</p>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#bankDetailsModal">
                            Update Bank Details
                        </button>
                    @else
                        <p class="text-muted">No bank details available. Please add your bank details to proceed with
                            withdrawals.</p>
                        <button class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#bankDetailsModal">
                            Add Bank Details
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="transactionTableBody">
                @foreach($walletTransactions as $transaction)
                    <tr data-id="{{ $transaction->id }}">
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->transaction_id ? $transaction->transaction_id : 'Null' }}</td>
                        <td>{{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ ucfirst($transaction->type) }}</td>
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
            </tbody>
        </table>
    </div>

    <!-- Bank Details Modal -->
    <div class="modal fade" id="bankDetailsModal" tabindex="-1" aria-labelledby="bankDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content"  action="{{ $Bank_details ? route('seller.update.bank.details', $storeId) : route('seller.add.bank.details') }}" " method="POST">
                @csrf
                @if($Bank_details)
                    @method('PUT')
                @endif
                <div class="modal-header">
                    <h5 class="modal-title" id="bankDetailsModalLabel">
                        {{ $Bank_details ? 'Update Bank Details' : 'Add Bank Details' }}
                    </h5>
                    <button type="button" class="btn-close btn" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Account Holder</label>
                        <input type="text" name="account_holder_name" class="form-control"
                            value="{{ $Bank_details->account_holder_name ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control"
                            value="{{ $Bank_details->bank_name ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Account Number</label>
                        <input type="text" name="account_number" class="form-control"
                            value="{{ $Bank_details->account_number ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label>IFSC Code</label>
                        <input type="text" name="ifsc_code" class="form-control"
                            value="{{ $Bank_details->ifsc_code ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Branch Name</label>
                        <input type="text" name="branch_name" class="form-control"
                            value="{{ $Bank_details->branch_name ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label>UPI</label>
                        <input type="text" name="upi_id" class="form-control"
                            value="{{ $Bank_details->upi_id ?? '' }}" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Withdraw Modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('seller.withdraw') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawModalLabel">Withdraw Amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Enter Amount</label>
                        <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                            <input type="hidden" name="bank_details_id" class="form-control" value="{{ $Bank_details->id }}" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection