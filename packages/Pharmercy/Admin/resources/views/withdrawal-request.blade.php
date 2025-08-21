@extends('Admin::layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Wallet Withdrawals</h2>

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Bank ID</th>
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
                    <td>{{ $withdrawal->bank_details_id }}</td>
                    <td>
                        <select name="status" class="form-control form-control-sm status-select" data-id="{{ $withdrawal->id }}">
                            <option value="pending" {{ $withdrawal->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $withdrawal->status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $withdrawal->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </td>
                    <td>{{ $withdrawal->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="/" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        <!-- Optional: View details -->
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewWithdrawalModal{{ $withdrawal->id }}">
                            View
                        </button>
                    </td>
                </tr>
            @endforeach
           @endif
           @if (count($withdrawals) == 0)
               <tfoot>
                   <tr>
                       <td colspan="6" class="text-center">No withdrawal requests found.</td>
                   </tr>
               </tfoot>
           
           @endif
        </tbody>
    </table>
</div>

<script>
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            let withdrawalId = this.dataset.id;
            let newStatus = this.value;

            fetch(`/admin/withdrawal-request/${withdrawalId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Status updated successfully!');
                } else {
                    alert('Failed to update status.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Error updating status.');
            });
        });
    });
</script>
@endsection
