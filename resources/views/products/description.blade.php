@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 150px;">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="img-fluid mb-3" style="max-height: 400px; object-fit: contain;">
                </div>

                <div class="col-md-7">
                    <h3>{{ $product->product_name }}</h3>

                    <p class="card-text mt-2">
                        @if($product->discount)
                        <span style="color: red; font-size: 1rem; font-weight: bold; text-decoration: line-through;">
                            ₱{{ number_format($product->price, 2, '.', ',') }}
                        </span><br>
                        <span style="color: green; font-size: 1.2rem; font-weight: bold;">
                            ₱{{ number_format($product->discountedPrice($product->discount), 2, '.', ',') }}
                            <span style="font-size: 0.8rem; color: orange; margin-bottom: 2px; margin-top: -2px;"> - {{ intval($product->discount) }}%</span>
                        </span>
                        <br>
                        @else
                        <span style="color: red; font-size: 1rem; font-weight: bold;">
                            ₱{{ number_format($product->price, 2, '.', ',') }}
                        </span><br>
                        @endif
                    </p>

                    <p><strong>Description:</strong> {{ $product->description }}</p>

                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p><strong>Category:</strong> {{ $product->category ? $product->category->name : 'N/A' }}</p>
                    <p><strong>Supplier:</strong> {{ $product->supplier ? $product->supplier->name : 'N/A' }}</p>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                        Edit <i class="bi bi-pen ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection