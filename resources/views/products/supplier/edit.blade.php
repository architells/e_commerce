@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold">Edit Supplier</h2>


    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $supplier->name) }}" required>
        </div>

        <div class="form-group">
            <label for="contact_info">Contact Info:</label>
            <input type="text" name="contact_info" class="form-control" value="{{ old('contact_info', $supplier->contact_info) }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $supplier->address) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $supplier->email) }}" required>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">
                Update Supplier
            </button>
            <a href="{{ route('products.supplier.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection