@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold">Suppliers</h2>
                <a href="{{ route('suppliers.create') }}" class="btn btn-secondary">Create New Supplier</a>
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
            @if (session('deleted_supplier'))
            <script>
                Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: "{{session('deleted_supplier')}}",
                });
            </script>
            @endif

            <!-- Check if there are any suppliers -->
            @if($suppliers->isEmpty())
            <div class="alert alert-warning">
                No suppliers found.
            </div>
            @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>address</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->contact_info }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
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
