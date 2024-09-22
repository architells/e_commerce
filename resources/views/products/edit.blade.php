@extends('layouts.app')

@section('content')


<div class="container">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex align-items-start" style="margin-top: 80px;">
            <div class="flex-shrink-0" style="margin-top: 35px;">
                <!-- Image Section -->
                @if ($product->product_image)
                <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 400px; max-height: 400px;">
                @else
                <img src="{{ asset('storage/product_images/default.jpg') }}" alt="Default Image" class="img-thumbnail" style="max-width: 400px; max-height: 400px;">
                @endif
            </div>
            <div class="flex-grow-1 ml-4">
                <!-- Form Fields -->
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" class="rounded border-gray-300 form-control" value="{{ old('product_name', $product->product_name) }}">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="rounded border-gray-300 form-control">{{ old('description', $product->description) }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" name="price" class="rounded border-gray-300 form-control" value="{{ old('price', $product->price) }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" class="rounded border-gray-300 form-control" value="{{ old('stock', $product->stock) }}">
                </div>
                <div class="form-group">
                    <label for="discount">Discount (%):</label>
                    <input type="number" name="discount" class="rounded border-gray-300 form-control" value="{{ old('discount', $product->discount ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_id">Supplier:</label>
                    <select name="supplier_id" class="form-control" required>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ (old('supplier_id', $product->supplier_id) == $supplier->id) ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="product_image">Product Image:</label>
                    <div class="custom-file">
                        <input type="file" name="product_image" id="product_image" class="rounded border-gray-300 custom-file-input">
                        <label class="custom-file-label" for="product_image">Choose file</label>
                    </div>
                    @error('product_image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex mt-3">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="bi bi-box-arrow-in-up" style="margin-right: 5px;"></i>Update
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Form -->
    <div class="mt-3 text-right" style="margin-top: -40px;">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Delete <i class="bi bi-trash3-fill ms-2"></i>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fileInput = document.getElementById('product_image');
        var fileLabel = document.querySelector('.custom-file-label');

        fileInput.addEventListener('change', function() {
            var fileName = fileInput.files.length > 0 ? fileInput.files[0].name : 'Choose file';
            fileLabel.textContent = fileName;
        });
    });
</script>
@endsection