@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold">Create New Supplier</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('products.supplier.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Supplier Name:</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter supplier name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="contact">Contact Information:</label>
                            <input type="text" name="contact_info" class="form-control" id="contact_info" placeholder="Enter contact information" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address:</label>
                            <input type="text" name="address" class="form-control" id="address" placeholder="Enter supplier address" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter supplier email" required>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary">
                                Create Supplier
                            </button>
                            <a href="{{ route('products.supplier.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection