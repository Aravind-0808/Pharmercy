@extends('Admin::layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Stores Management</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addStoreModal">Add New Store</button>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Active</th>
                    <th>Verified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="storeTableBody">
                @foreach($stores as $store)
                    <tr data-id="{{ $store->id }}">
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>
                            @if($store->logo)
                                <img src="{{ asset('' . $store->logo) }}" class="img-thumbnail"
                                    style="width:40px;height:40px;">
                            @else
                                <span class="text-muted">No Logo</span>
                            @endif
                        </td>
                        <td>{{ $store->address }}</td>
                        <td>{{ $store->country }}</td>
                        <td>{{ $store->state }}</td>
                        <td>{{ $store->city }}</td>
                        <td>{{ $store->zip_code }}</td>
                        <td>{{ $store->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $store->is_verified ? 'Verified' : 'Unverified' }}</td>
                        <td>
                            <button class="btn btn-sm btn-info editStoreBtn" data-toggle="modal"
                                data-target="#editStoreModal">Edit</button>
                            <button class="btn btn-sm btn-danger deleteStoreBtn">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Store Modal -->
    <div class="modal fade" id="addStoreModal" tabindex="-1" role="dialog" aria-labelledby="addStoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStoreModalLabel">Add New Store</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addStoreForm" method="POST" action="{{ route('seller.stores.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" required>
                        </div>
                        <div class="form-group">
                            <label>Active</label>
                            <select class="form-control" name="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Verified</label>
                            <select class="form-control" name="is_verified">
                                <option value="1">Verified</option>
                                <option value="0">Unverified</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Store Modal -->
    <div class="modal fade" id="editStoreModal" tabindex="-1" role="dialog" aria-labelledby="editStoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStoreModalLabel">Edit Store</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editStoreForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editStoreId">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="editStoreName" required>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo" id="editStoreLogo">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="editStoreAddress" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" id="editStoreCountry" required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" id="editStoreState" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" id="editStoreCity" required>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" id="editStoreZipCode" required>
                        </div>
                        <div class="form-group">
                            <label>Active</label>
                            <select class="form-control" name="is_active" id="editStoreActive">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Verified</label>
                            <select class="form-control" name="is_verified" id="editStoreVerified">
                                <option value="1">Verified</option>
                                <option value="0">Unverified</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add Store
            $('#addStoreForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '/seller/stores',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Error adding store');
                    }
                });
            });

            // Edit Store - populate modal
            $('.editStoreBtn').click(function () {
                var row = $(this).closest('tr');
                $('#editStoreId').val(row.data('id'));
                $('#editStoreName').val(row.find('td:eq(1)').text());
                $('#editStoreAddress').val(row.find('td:eq(3)').text());
                $('#editStoreCountry').val(row.find('td:eq(4)').text());
                $('#editStoreState').val(row.find('td:eq(5)').text());
                $('#editStoreCity').val(row.find('td:eq(6)').text());
                $('#editStoreZipCode').val(row.find('td:eq(7)').text());
                $('#editStoreActive').val(row.find('td:eq(8)').text() === 'Active' ? '1' : '0');
                $('#editStoreVerified').val(row.find('td:eq(9)').text() === 'Verified' ? '1' : '0');
            });

            // Update Store
            $('#editStoreForm').submit(function (e) {
                e.preventDefault();
                var id = $('#editStoreId').val();
                var formData = new FormData(this);
                $.ajax({
                    url: '/seller/stores/' + id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-HTTP-Method-Override': 'PUT', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Error updating store');
                    }
                });
            });

            // Delete Store
            $('.deleteStoreBtn').click(function () {
                if (confirm('Are you sure you want to delete this store?')) {
                    var row = $(this).closest('tr');
                    var id = row.data('id');
                    $.ajax({
                        url: '/seller/stores/' + id,
                        type: 'POST',
                        data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            location.reload();
                        },
                        error: function (xhr) {
                            alert('Error deleting store');
                        }
                    });
                }
            });
        });
    </script>
@endsection