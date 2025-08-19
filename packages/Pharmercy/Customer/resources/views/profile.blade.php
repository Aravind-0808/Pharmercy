@extends('Customer::layout.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">

    <!-- Personal Details -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-fill me-2 text-primary"></i>Personal Details</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" value="{{ $user->name }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" value="{{ $user->email }}" class="form-control" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Address Details -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>Address</h5>
            <button type="button" class="btn btn-sm btn-outline-primary" id="editAddressBtn">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.update-address', $profile->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ $profile->first_name }}" class="form-control" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ $profile->last_name }}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" value="{{ $profile->phone }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alternate Phone Number</label>
                        <input type="text" name="alt_phone" value="{{ $profile->alt_phone }}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Door Number</label>
                        <input type="text" name="door_no" value="{{ $profile->door_no }}" class="form-control" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Street</label>
                        <input type="text" name="street" value="{{ $profile->street }}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" value="{{ $profile->city }}" class="form-control" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">District</label>
                        <input type="text" name="district" value="{{ $profile->district }}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">State</label>
                        <input type="text" name="state" value="{{ $profile->state }}" class="form-control" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" value="{{ $profile->country }}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Zip Code</label>
                        <input type="text" name="zip" value="{{ $profile->zip }}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="d-none" id="addressSaveBtn">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Inline Script for Edit/Save Toggle -->
<script>
    document.getElementById('editAddressBtn').addEventListener('click', function () {
        document.querySelectorAll('.card-body form')[1].querySelectorAll('input').forEach(el => el.removeAttribute('readonly'));
        document.getElementById('addressSaveBtn').classList.remove('d-none');
    });
</script>

<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }
    .form-label {
        font-weight: 500;
    }
</style>
@endsection
