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
           @if (count($bankDetails) > 0)
               @foreach($bankDetails as $detail)
                   <tr data-id="{{ $detail->id }}">
                       <td>{{ $detail->id }}</td>
                       <td>{{ $detail->store_id }}</td>
                       <td>{{ $detail->account_holder }}</td>
                       <td>{{ $detail->bank_name }}</td>
                       <td>{{ $detail->account_number }}</td>
                       <td>{{ $detail->ifsc_code }}</td>
                       <td>{{ $detail->branch }}</td>
                       <td>{{ $detail->upi_id }}</td>
                       <td>
                           <form action="{{ route('admin.bank-details.destroy', $detail->id) }}" method="POST" style="display:inline-block;">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                           </form>
                       </td>
                   </tr>
               @endforeach
           @endif
           @if (count($bankDetails) === 0)
               <tfoot>
                   <tr>
                       <td colspan="9" class="text-center">No bank details found.</td>
                   </tr>
               </tfoot>
           
           @endif
        </tbody>
    </table>
</div>
@endsection
