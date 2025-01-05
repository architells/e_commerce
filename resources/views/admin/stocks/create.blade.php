@extends('Admin.layouts.header')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Stock</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <!-- Card Body -->
                        <div class="card-body">
                            <form action="{{ route('stocks.store') }}" method="POST">
                                @push('scripts')
                                @if (session('success'))
                                <script>
                                    Swal.fire({
                                        title: 'Success',
                                        icon: 'success',
                                        text: "{{ session('success') }}",
                                    });
                                </script>
                                @endif
                                @endpush

                                @csrf
                                <div class="form-group">
                                    <label for="product_id">Product <span class="text-danger">*</span></label>
                                    <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                        <option value="">Select a product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->product_id }}" {{ old('product_id') == $product->product_id ? 'selected' : '' }}>
                                            {{ $product->product_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stockInQuantity">Quantity to Add <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stockInQuantity') is-invalid @enderror" id="stockInQuantity" name="stockInQuantity" value="{{ old('stockInQuantity') }}" required min="1">
                                    @error('stockInQuantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Stock</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection