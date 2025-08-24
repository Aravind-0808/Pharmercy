@extends('Seller::layouts.app')
@section('content')
	<div class="container mt-5">
		<h2 class="mb-4">Labs Management</h2>
		<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addLabModal">Add New Lab</button>
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
					<th>Lab Type</th>
					<th>Phone</th>
					<th>WhatsApp</th>
					<th>Active</th>
					<th>Verified</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="labTableBody">
			   @if (count($labs) > 0)
				@foreach($labs as $lab)
					<tr data-id="{{ $lab->id }}">
						<td>{{ $lab->id }}</td>
						<td>{{ $lab->name }}</td>
						<td>
							@if($lab->logo)
								<img src="{{ asset('/storage/'.$lab->logo) }}" class="img-thumbnail" style="width:40px;height:40px;">
							@else
								<span class="text-muted">No Logo</span>
							@endif
						</td>
						<td>{{ $lab->address }}</td>
						<td>{{ $lab->country }}</td>
						<td>{{ $lab->state }}</td>
						<td>{{ $lab->city }}</td>
						<td>{{ $lab->zip_code }}</td>
						<td>{{ $lab->lab_type }}</td>
						<td>{{ $lab->phone }}</td>
						<td>{{ $lab->whatsapp }}</td>
						<td>{{ $lab->is_active ? 'Active' : 'Inactive' }}</td>
						<td>{{ $lab->is_verified ? 'Verified' : 'Unverified' }}</td>
						<td>
							<button class="btn btn-sm btn-info editLabBtn" data-toggle="modal" data-target="#editLabModal">Edit</button>
							<button class="btn btn-sm btn-danger deleteLabBtn">Delete</button>
						</td>
					</tr>
				@endforeach
			   @endif
			   @if (count($labs) == 0)
					<tr>
						<td colspan="14" class="text-center">No labs found.</td>
					</tr>
			   @endif
			</tbody>
		</table>
	</div>

	<!-- Add Lab Modal -->
	<div class="modal fade" id="addLabModal" tabindex="-1" role="dialog" aria-labelledby="addLabModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addLabModalLabel">Add New Lab</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="addLabForm" method="POST" action="{{ route('seller.labs.store') }}" enctype="multipart/form-data">
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
							<label>Lab Type</label>
							<input type="text" class="form-control" name="lab_type" required>
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
						<button type="submit" class="btn btn-primary">Add Lab</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Edit Lab Modal -->
	<div class="modal fade" id="editLabModal" tabindex="-1" role="dialog" aria-labelledby="editLabModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editLabModalLabel">Edit Lab</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="editLabForm">
					<div class="modal-body">
						<input type="hidden" name="id" id="editLabId">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" id="editLabName" required>
						</div>
						<div class="form-group">
							<label>Logo</label>
							<input type="file" class="form-control" name="logo" id="editLabLogo">
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" class="form-control" name="address" id="editLabAddress" required>
						</div>
						<div class="form-group">
							<label>Country</label>
							<input type="text" class="form-control" name="country" id="editLabCountry" required>
						</div>
						<div class="form-group">
							<label>State</label>
							<input type="text" class="form-control" name="state" id="editLabState" required>
						</div>
						<div class="form-group">
							<label>City</label>
							<input type="text" class="form-control" name="city" id="editLabCity" required>
						</div>
						<div class="form-group">
							<label>Zip Code</label>
							<input type="text" class="form-control" name="zip_code" id="editLabZipCode" required>
						</div>
						<div class="form-group">
							<label>Lab Type</label>
							<input type="text" class="form-control" name="lab_type" id="editLabType" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" name="phone" id="editLabPhone" required>
						</div>
						<div class="form-group">
							<label>WhatsApp</label>
							<input type="text" class="form-control" name="whatsapp" id="editLabWhatsApp" required>
						</div>
						<div class="form-group">
							<label>Active</label>
							<select class="form-control" name="is_active" id="editLabActive">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
						<div class="form-group">
							<label>Verified</label>
							<select class="form-control" name="is_verified" id="editLabVerified">
								<option value="1">Verified</option>
								<option value="0">Unverified</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update Lab</button>
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
			// Add Lab
			$('#addLabForm').submit(function (e) {
				e.preventDefault();
				var formData = new FormData(this);
				$.ajax({
					url: '/seller/labs',
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
					success: function (response) {
						location.reload();
					},
					error: function (xhr) {
						alert('Error adding lab');
					}
				});
			});

			// Edit Lab - populate modal
			$('.editLabBtn').click(function () {
				var row = $(this).closest('tr');
				$('#editLabId').val(row.data('id'));
				$('#editLabName').val(row.find('td:eq(1)').text());
				$('#editLabAddress').val(row.find('td:eq(3)').text());
				$('#editLabCountry').val(row.find('td:eq(4)').text());
				$('#editLabState').val(row.find('td:eq(5)').text());
				$('#editLabCity').val(row.find('td:eq(6)').text());
				$('#editLabZipCode').val(row.find('td:eq(7)').text());
				$('#editLabType').val(row.find('td:eq(8)').text());
				$('#editLabPhone').val(row.find('td:eq(9)').text());
				$('#editLabWhatsApp').val(row.find('td:eq(10)').text());
				$('#editLabActive').val(row.find('td:eq(11)').text() === 'Active' ? '1' : '0');
				$('#editLabVerified').val(row.find('td:eq(12)').text() === 'Verified' ? '1' : '0');
			});

			// Update Lab
			$('#editLabForm').submit(function (e) {
				e.preventDefault();
				var id = $('#editLabId').val();
				var formData = new FormData(this);
				$.ajax({
					url: '/seller/labs/' + id,
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					headers: { 'X-HTTP-Method-Override': 'PUT', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
					success: function (response) {
						location.reload();
					},
					error: function (xhr) {
						alert('Error updating lab');
					}
				});
			});

			// Delete Lab
			$('.deleteLabBtn').click(function () {
				if (confirm('Are you sure you want to delete this lab?')) {
					var row = $(this).closest('tr');
					var id = row.data('id');
					$.ajax({
						url: '/seller/labs/' + id,
						type: 'POST',
						data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
						success: function (response) {
							location.reload();
						},
						error: function (xhr) {
							alert('Error deleting lab');
						}
					});
				}
			});
		});
	</script>
@endsection
