@extends('layouts.customer')

<style>
    .product-card {
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 300px;
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid #e0e0e0;
        /* Subtle border for definition */
        border-radius: 8px;
        /* Rounded corners */
        overflow: hidden;
        /* Ensures image fits within the card */
        background: #fff;
        /* White background for cleanliness */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
    }

    .product-card img {
        height: 180px;
        object-fit: contain;
        width: 100%;
        transition: transform 0.3s;
        /* Smooth image scaling */
    }

    .product-card:hover img {
        transform: scale(1.05);
        /* Slight zoom effect on hover */
    }

    .product-card:hover {
        transform: translateY(-5px);
        /* Slight upward movement */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        /* Deeper shadow on hover */
    }

    .card-body {
        flex-grow: 1;
        padding: 15px;
        /* Increased padding for better spacing */
        text-align: center;
        /* Centered text for better alignment */
    }

    .card-title {
        font-size: 1.1rem;
        /* Slightly larger font size */
        font-weight: 600;
        /* Bold title for emphasis */
        color: #333;
        /* Dark gray for text contrast */
    }

    .card-text {
        margin-top: 10px;
    }

    .card-text span {
        display: block;
        /* Display price and stock as block elements */
    }

    .input-group {
        margin-bottom: 1.5rem;
        /* Spacing below the search bar */
    }

    .btn-outline-secondary {
        transition: background-color 0.3s, color 0.3s;
        /* Smooth transitions */
        color: #333;
        /* Dark text color */
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        /* Darker on hover */
        color: #fff;
        /* White text on hover */
    }

    .category-button {
        margin-right: 0.5rem;
        /* Spacing between category buttons */
    }

    .empty-message {
        font-size: 1.2rem;
        /* Larger font size for empty message */
        color: #777;
        /* Gray color for emphasis */
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

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
                });
            </script>
            @endif

            <aside>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form action="{{ route('customer.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="search" name="search" value="{{ $search ?? '' }}" class="rounded border-gray-300 form-control form-control-lg" placeholder="Search products...">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            <ul class="list-unstyled d-flex flex-row mt-3 mb-4">
                <li class="mb-2 category-button">
                    <a href="{{ route('customer.index') }}" class="btn btn-outline-secondary btn-sm">
                        All Products
                    </a>
                </li>
                @foreach($categories as $category)
                <li class="mb-2 category-button">
                    <a href="{{ route('customer.category', $category->id) }}" class="btn btn-outline-secondary btn-sm">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="row">
                @if($products->isEmpty())
                <div class="col-12">
                    <p class="text-center empty-message">No products found.</p>
                </div>
                @else
                @foreach($products as $product)
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card product-card w-100"
                        data-url="{{ route('customer.description', $product->id) }}">
                        @if($product->product_image)
                        <img src="{{ Storage::url($product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                        @else
                        <img src="{{ Storage::url('product_images/default.jpg') }}" class="card-img-top" alt="Product Image">
                        @endif
                        <div class="card-body">
                            <span class="card-title mb-0">{{ $product->product_name }}</span>
                            <p class="card-text mt-2">
                                @if($product->discount)
                                <span style="color: red; font-weight: bold; text-decoration: line-through;">
                                    ₱{{ number_format($product->price, 2, '.', ',') }}
                                </span>
                                <span style="font-size: 0.8rem; color: orange;">
                                    - {{ intval($product->discount) }}%
                                </span>
                                <span style="color: green; font-size: 1.2rem; font-weight: bold;">
                                    ₱{{ number_format($product->discountedPrice($product->discount), 2, '.', ',') }}
                                </span>
                                @else
                                <span style="color: red; font-weight: bold;">
                                    ₱{{ number_format($product->price, 2, '.', ',') }}
                                </span>
                                @endif
                                @if($product->isInStock())
                                <span style="font-size: 0.8rem;">In Stock: {{ $product->stock }}</span>
                                @else
                                <span style="color: red; font-size: 0.8rem;">Out of Stock</span>
                                @endif
                            </p>
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