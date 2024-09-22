@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold">Create Category</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    
    <form action="{{ route('categories.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <!-- Flex container for buttons -->
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="{{ route('products.categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>


    <!-- Display validation errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection