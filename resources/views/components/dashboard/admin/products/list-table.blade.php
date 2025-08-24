<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Products List</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
        </div>
        <hr/>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="productsTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th style="width: 120px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/'.$product->image) }}" style="width:60px; height:60px; object-fit:cover;" />
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category ? $product->category->name : '' }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>                      
                        <td>{{ $product->quantity }}</td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('admin.products.adminProductEdit', $product->id) }}" class="btn btn-sm btn-info me-1">Edit</a>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $product->id }}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="addProductForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="price" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" required>
            </div>
            <button type="submit" class="btn btn-success">Add Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
document.getElementById('addProductForm').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);

    axios.post("{{ route('admin.products.store') }}", formData)
        .then(function(response){
            const product = response.data.product;
            if(!product) return;

            // Close modal
            var addModal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
            addModal.hide();

            // Append new row to table
            const table = document.getElementById('productsTable').getElementsByTagName('tbody')[0];
            const row = table.insertRow(0); 

            // Use proper route for Edit link
            const editUrl = `{{ url('backend/admin/products/edit') }}/${product.id}`;

            row.innerHTML = `
                <td><img src="/storage/${product.image}" style="width:60px; height:60px; object-fit:cover;" /></td>
                <td>${product.name}</td>
                <td>${product.category_name}</td>
                <td>${product.description}</td>
                <td>${product.price}</td>
                <td>${product.quantity}</td>
                <td style="white-space: nowrap;">
                    <a href="${editUrl}" class="btn btn-sm btn-info me-1">Edit</a>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="${product.id}">Delete</button>
                </td>
            `;
            
            // Clear form
            document.getElementById('addProductForm').reset();
        })
        .catch(function(err){
            console.error(err);
            alert("Failed to add product");
        });
});

// Delete product
document.querySelector('#productsTable').addEventListener('click', function(e){
    if(e.target.classList.contains('delete-btn')){
        let id = e.target.dataset.id;
        if(confirm("Are you sure you want to delete this product?")){
            axios.delete(`/backend/admin/products/${id}`)
            .then(res => {
                e.target.closest('tr').remove(); // remove row
                alert(res.data.message);
            })
            .catch(err => {
                console.error(err);
                alert('Failed to delete product');
            });
        }
    }
});
</script>
@endpush
