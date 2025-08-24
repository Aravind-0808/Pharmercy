@extends('Admin::layouts.app')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Doctors Management</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addDoctorModal">Add New Doctor</button>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Zip Code</th>
                    <th>Specialization</th>
                    <th>Phone</th>
                    <th>WhatsApp</th>
                    <th>Active</th>
                    <th>Verified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="storeTableBody">
                @if (count($doctors) > 0)
                    @foreach($doctors as $doctor)
                        <tr data-id="{{ $doctor->id }}">
                            <td>{{ $doctor->id }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>
                                @if($doctor->logo)
                                    <img src="{{ asset("/storage/{$doctor->logo}") }}" class="img-thumbnail"
                                        style="width:40px;height:40px;">
                                @else
                                    <span class="text-muted">No Logo</span>
                                @endif
                            </td>
                            <td>{{ $doctor->address }}</td>
                            <td>{{ $doctor->city }}</td>
                            <td>{{ $doctor->state }}</td>
                            <td>{{ $doctor->country }}</td>
                            <td>{{ $doctor->zip_code }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>{{ $doctor->whatsapp }}</td>
                            <td>{{ $doctor->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $doctor->is_verified ? 'Verified' : 'Unverified' }}</td>
                            <td>
                                <button class="btn btn-sm btn-info editDoctorBtn" data-toggle="modal"
                                    data-target="#editDoctorModal">Edit</button>
                                <button class="btn btn-sm btn-danger deleteDoctorBtn">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (count($doctors) == 0)
                    <tr>
                        <td colspan="12" class="text-center">No doctors found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Add Doctor Modal -->
    <div class="modal fade" id="addDoctorModal" tabindex="-1" role="dialog" aria-labelledby="addDoctorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDoctorModalLabel">Add New Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addDoctorForm" method="POST" action="{{ route('seller.doctors.store') }}"
                    enctype="multipart/form-data">
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
                            <label>City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" required>
                        </div>
                        <div class="form-group">
                            <label>Specialization</label>
                            <input type="text" class="form-control" name="specialization" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>WhatsApp</label>
                            <input type="text" class="form-control" name="whatsapp" required>
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
                        <button type="submit" class="btn btn-primary">Add Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Doctor Modal -->
    <div class="modal fade" id="editDoctorModal" tabindex="-1" role="dialog" aria-labelledby="editDoctorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDoctorModalLabel">Edit Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editDoctorForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editDoctorId">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="editDoctorName" required>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo" id="editDoctorLogo">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="editDoctorAddress" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" id="editDoctorCity" required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" id="editDoctorState" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" id="editDoctorCountry" required>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" id="editDoctorZipCode" required>
                        </div>
                        <div class="form-group">
                            <label>Specialization</label>
                            <input type="text" class="form-control" name="specialization" id="editDoctorSpecialization"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" id="editDoctorPhone" required>
                        </div>
                        <div class="form-group">
                            <label>WhatsApp</label>
                            <input type="text" class="form-control" name="whatsapp" id="editDoctorWhatsApp" required>
                        </div>
                        <div class="form-group">
                            <label>Active</label>
                            <select class="form-control" name="is_active" id="editDoctorActive">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Verified</label>
                            <select class="form-control" name="is_verified" id="editDoctorVerified">
                                <option value="1">Verified</option>
                                <option value="0">Unverified</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Doctor</button>
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
            // Add Doctor
            $('#addDoctorForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '/seller/doctors',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Error adding doctor');
                    }
                });
            });

            // Edit Doctor - populate modal
            $('.editDoctorBtn').click(function () {
                var row = $(this).closest('tr');
                $('#editDoctorId').val(row.data('id'));
                $('#editDoctorUserId').val(row.find('td:eq(1)').text());
                $('#editDoctorName').val(row.find('td:eq(2)').text());
                $('#editDoctorAddress').val(row.find('td:eq(4)').text());
                $('#editDoctorCountry').val(row.find('td:eq(5)').text());
                $('#editDoctorState').val(row.find('td:eq(6)').text());
                $('#editDoctorCity').val(row.find('td:eq(7)').text());
                $('#editDoctorZipCode').val(row.find('td:eq(8)').text());
                $('#editDoctorActive').val(row.find('td:eq(9)').text() === 'Active' ? '1' : '0');
                $('#editDoctorVerified').val(row.find('td:eq(10)').text() === 'Verified' ? '1' : '0');
            });

            // Update Doctor
            $('#editDoctorForm').submit(function (e) {
                e.preventDefault();
                var id = $('#editDoctorId').val();
                var formData = new FormData(this);
                $.ajax({
                    url: '/seller/doctors/' + id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-HTTP-Method-Override': 'PUT', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Error updating doctor');
                    }
                });
            });

            // Delete Doctor
            $('.deleteDoctorBtn').click(function () {
                if (confirm('Are you sure you want to delete this doctor?')) {
                    var row = $(this).closest('tr');
                    var id = row.data('id');
                    $.ajax({
                        url: '/seller/doctors/' + id,
                        type: 'POST',
                        data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            location.reload();
                        },
                        error: function (xhr) {
                            alert('Error deleting doctor');
                        }
                    });
                }
            });
        });
    </script>
@endsection