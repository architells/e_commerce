@extends('layouts.consumer')
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

    .product-card:hover {
        transform: translateY(-10px);
        /* Move the card 10px up */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        /* Add shadow */
    }

    .card-body {
        flex-grow: 1;
        padding: 10px;
    }

    .card-text {
        margin-top: 10px;
    }

    .card-title {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 150px;
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
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="search" name="search" value="{{ $search ?? '' }}" class="rounded border-gray-300 form-control form-control-lg" placeholder="Type your keywords here">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary" href="{{ route('products.create') }}">Create New Products</a>
            </div>

            <ul class="list-unstyled d-flex flex-row">
                @foreach($categories as $category)
                <li class="mb-2 me-2">
                    <a href="{{ route('products.categories.show', $category->id) }}" class="btn btn-outline-secondary btn-sm skew-button">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>


            <div class="table-responsive mt-3">
                <div class="row">
                    @if($products->isEmpty())
                    <div class="col-12">
                        <p class="text-center">No products found.</p>
                    </div>
                    @else
                    @foreach($products as $product)
                    <div class="col-md-3 mb-4 d-flex">
                        <div class="card product-card w-100 shadow-sm"
                            data-url="{{ route('products.description', $product->id) }}">
                            @if($product->product_image)
                            <img src="{{ Storage::url($product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                            @else
                            <img src="{{ Storage::url('product_images/Ez91CRHRsqTsxoG0DXslTrqYA0FrzjlvG37jFJox.jpg') }}" class="card-img-top" alt="Product Image">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="card-title mb-0">{{ $product->product_name }}</span>
                                </div>
                                <p class="card-text mt-2">
                                    @if($product->discount)
                                    <span style="color: red; font-size: 1rem; font-weight: bold; text-decoration: line-through;">
                                        ₱{{ number_format($product->price, 2, '.', ',') }}
                                    </span>
                                    <span style="font-size: 0.8rem; color: orange; margin-left: 5px;">
                                        - {{ intval($product->discount) }}%
                                    </span><br>
                                    <span style="color: green; font-size: 1.2rem; font-weight: bold;">
                                        ₱{{ number_format($product->discountedPrice($product->discount), 2, '.', ',') }}
                                    </span>
                                    <br>
                                    @else
                                    <span style="color: red; font-size: 1rem; font-weight: bold;">
                                        ₱{{ number_format($product->price, 2, '.', ',') }}
                                    </span><br>
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