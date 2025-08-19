@extends('Admin::layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Bank Details Management</h2> 

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Store ID</th>
                <th>Account Holder</th>
                <th>Bank Name</th>
                <th>Account Number</th>
                <th>IFSC Code</th>
                <th>Branch</th>
                <th>UPI ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bankDetails as $bank)
                <tr data-id="{{ $bank->id }}">
                    <td>{{ $bank->id }}</td>
                    <td>{{ $bank->store_id }}</td>
                    <td>{{ $bank->account_holder_name }}</td>
                    <td>{{ $bank->bank_name }}</td>
                    <td>{{ $bank->account_number }}</td>
                    <td>{{ $bank->ifsc_code }}</td>
                    <td>{{ $bank->branch_name ?? '-' }}</td>
                    <td>{{ $bank->upi_id ?? '-' }}</td>
                    <td>
                        <!-- Update button triggers modal -->
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateBankModal{{ $bank->id }}">
                            Update
                        </button>

                        <!-- Delete Form -->
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
@endsection
