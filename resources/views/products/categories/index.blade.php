@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold">Categories</h2>
                <div class="ml-auto">
                    <a href="{{ route('categories.create') }}" class="btn btn-secondary">Add Category</a>
                </div>
            </div>

            @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: "{{session('success')}}",
                });
            </script>
            @endif
            @if (session('deleted_product'))
            <script>
                Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: "{{session('deleted_product')}}",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            </script>
            @endif



            <!-- Check if there are any categories -->
            @if($categories->isEmpty())
            <div class="alert alert-warning">
                No categories found.
            </div>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection