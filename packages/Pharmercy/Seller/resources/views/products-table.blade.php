@extends('Seller::layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Products Management</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Add New Product</button>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Store ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Original Price</th>
                    <th>Discount Percentage</th>
                    <th>Selling Price</th>
                    <th>Stock</th>
                    <th>Is Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($products) > 0)
                    @foreach($products as $product)
                        <tr data-id="{{ $product->id }}">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->store_id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail"
                                        style="width:60px;height:60px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->original_price }}</td>
                            <td>{{ $product->discount }}%</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <button class="btn btn-sm btn-info editProductBtn" data-toggle="modal"
                                    data-target="#editProductModal">Edit</button>
                                <button class="btn btn-sm btn-danger deleteProductBtn">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (count($products) == 0)
                    <tr>
                        <td colspan="11" class="text-center">No products found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addProductForm" method="POST" action="{{ route('seller.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Original Price</label>
                            <input type="number" step="0.01" class="form-control" name="original_price" required>
                        </div>
                        <div class="form-group">
                            <label>Discount Percentage</label>
                            <input type="number" step="0.01" class="form-control" name="discount" required>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" name="stock" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProductForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editProductId">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Store ID</label>
                            <input type="number" class="form-control" name="store_id" id="editProductStoreId" required>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="editProductName" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" id="editProductImage">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="editProductDescription"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Original Price</label>
                            <input type="number" step="0.01" class="form-control" name="original_price"
                                id="editProductOriginalPrice" required>
                        </div>
                        <div class="form-group">
                            <label>Discount Percentage</label>
                            <input type="number" step="0.01" class="form-control" name="discount" id="editProductDiscount"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" name="stock" id="editProductStock" required>
                        </div>
                        <div class="form-group">
                            <label>Active</label>
                            <select class="form-control" name="is_active" id="editProductActive">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <script>
        let addEditor, editEditor;

        $(function () {
            // ✅ Initialize CKEditor for Add Product
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    addEditor = editor;
                })
                .catch(error => {
                    console.error(error);
                });

            // ✅ Initialize CKEditor for Edit Product
            ClassicEditor
                .create(document.querySelector('#editProductDescription'))
                .then(editor => {
                    editEditor = editor;
                })
                .catch(error => {
                    console.error(error);
                });

            // ✅ Add Product
            $('#addProductForm').submit(function (e) {
                e.preventDefault();

                // Get CKEditor data into textarea before submit
                if (addEditor) {
                    $('#description').val(addEditor.getData());
                }

                var formData = new FormData(this);
                $.ajax({
                    url: '/seller/products',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function () { location.reload(); },
                    error: function () { alert('Error adding product'); }
                });
            });

            // ✅ Edit Product - populate modal
            $('.editProductBtn').click(function () {
                var row = $(this).closest('tr');
                $('#editProductId').val(row.data('id'));
                $('#editProductStoreId').val(row.find('td:eq(1)').text());
                $('#editProductName').val(row.find('td:eq(2)').text());
                $('#editProductOriginalPrice').val(row.find('td:eq(5)').text());
                $('#editProductDiscount').val(row.find('td:eq(6)').text().replace('%', ''));
                $('#editProductStock').val(row.find('td:eq(8)').text());
                $('#editProductActive').val(row.find('td:eq(9)').text() === 'Active' ? '1' : '0');

                // Set description into CKEditor
                if (editEditor) {
                    editEditor.setData(row.find('td:eq(4)').html());
                }
            });

            // ✅ Update Product
            $('#editProductForm').submit(function (e) {
                e.preventDefault();

                // Get CKEditor data into textarea before submit
                if (editEditor) {
                    $('#editProductDescription').val(editEditor.getData());
                }

                var id = $('#editProductId').val();
                var formData = new FormData(this);
                $.ajax({
                    url: '/seller/products/' + id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-HTTP-Method-Override': 'PUT', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function () { location.reload(); },
                    error: function () { alert('Error updating product'); }
                });
            });

            // ✅ Delete Product
            $('.deleteProductBtn').click(function () {
                if (confirm('Are you sure you want to delete this product?')) {
                    var id = $(this).closest('tr').data('id');
                    $.ajax({
                        url: '/seller/products/' + id,
                        type: 'POST',
                        data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
                        success: function () { location.reload(); },
                        error: function () { alert('Error deleting product'); }
                    });
                }
            });
        });
    </script>
@endsection