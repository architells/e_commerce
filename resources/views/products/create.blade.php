@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <h1 class="text-center">Create New Product</h1> -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mt-3">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="rounded border-gray-300 form-control" value="{{ old('product_name') }}" required>
            @error('product_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="rounded border-gray-300 form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="rounded border-gray-300 form-control" value="{{ old('price') }}" required>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="rounded border-gray-300 form-control" value="{{ old('stock') }}" required>
            @error('stock')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control" required>
                <option value=" ">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="supplier_id">Supplier:</label>
            <select name="supplier_id" class="form-control">
                <option value=" ">Select Supplier</option>  
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group mt-3">
            <label for="product_image">Product Image:</label>
            <div class="custom-file">
                <input type="file" name="product_image" id="product_image" class="rounded border-gray-300 custom-file-input">
                <label class="custom-file-label" for="product_image">Choose file</label>
            </div>
            @if (isset($product->product_image))
            <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
            @error('product_image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-up" style="margin-right: 5px;"></i> Save Product
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fileInput = document.getElementById('product_image');
        var fileLabel = document.querySelector('.custom-file-label');

        fileInput.addEventListener('change', function() {
            var fileName = fileInput.files[0] ? fileInput.files[0].name : 'Choose file';
            fileLabel.textContent = fileName;
        });
    });
</script>
@endsection