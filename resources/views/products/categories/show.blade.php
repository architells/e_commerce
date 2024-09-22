@extends('layouts.app')

<style>
    .product-card {
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 300px;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .product-card img {
        height: 180px;
        object-fit: contain;
        width: 100%;
    }

    .card-body {
        flex-grow: 1;
        padding: 10px;
    }

    .card-title {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .stock-info {
        margin-top: 10px;
        /* Add some spacing */
        font-size: 0.8rem;
        /* Keep the font size small */
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center">{{ $category->name }}</h1>
            <p class="text-center">{{ $category->description }}</p>

            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-secondary" href="{{ route('products.index') }}">Back to Products</a>
            </div>

            <div class="row">
                @if($products->isEmpty())
                <div class="col-12">
                    <p class="text-center">No products found in this category.</p>
                </div>
                @else
                @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card shadow-sm" data-url="{{ route('products.description', $product->id) }}">
                        @if($product->product_image)
                        <img src="{{ Storage::url($product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                        @else
                        <img src="{{ Storage::url('product_images/default.jpg') }}" class="card-img-top" alt="Default Product Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">
                                @if($product->discount)
                                <span style="color: red; font-size: 1rem; font-weight: bold; text-decoration: line-through;">
                                    ₱{{ number_format($product->price, 2) }}
                                </span><br>
                                <span style="color: green; font-size: 1.2rem; font-weight: bold;">
                                    ₱{{ number_format($product->discountedPrice($product->discount), 2) }}
                                    <span style="font-size: 0.8rem; color: orange; margin-bottom: 2px; margin-top: -2px;"> - {{ intval($product->discount) }}%</span>
                                </span>
                                @else
                                <span style="color: red; font-size: 1rem; font-weight: bold;">
                                    ₱{{ number_format($product->price, 2) }}
                                </span>
                                @endif
                            </p>
                            <div class="stock-info">
                                @if($product->isInStock())
                                <span>In Stock: {{ $product->stock }}</span>
                                @else
                                <span style="color: red;">Out of Stock</span>
                                @endif
                            </div>
                            <a href="{{ route('products.description', $product->id) }}" class="btn btn-primary mt-2">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.product-card').forEach(function(card) {
            card.addEventListener('click', function() {
                window.location.href = card.getAttribute('data-url');
            });
        });
    });
</script>
@endsection