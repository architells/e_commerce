@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 100px;">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="img-fluid mb-3" style="max-height: 400px; object-fit: contain; border-radius: 8px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">

                    <!-- Add to Cart Card below the Image -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Add to Cart</h5>

                            <form action="{{ route('customer.shopping-cart.add', $product->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <h3 class="font-weight-bold">{{ $product->product_name }}</h3>

                    <div class="price mt-2">
                        @if($product->discount)
                        <span class="text-danger" style="font-size: 1rem; font-weight: bold; text-decoration: line-through;">
                            ₱{{ number_format($product->price, 2, '.', ',') }}
                        </span>
                        <br>
                        <span class="text-success" style="font-size: 1.5rem; font-weight: bold;">
                            ₱{{ number_format($product->discountedPrice($product->discount), 2, '.', ',') }}
                        </span>
                        <span class="text-warning" style="font-size: 0.9rem;"> - {{ intval($product->discount) }}%</span>
                        @else
                        <span class="text-danger" style="font-size: 1.5rem; font-weight: bold;">
                            ₱{{ number_format($product->price, 2, '.', ',') }}
                        </span>
                        @endif
                    </div>

                    <p class="mt-3"><strong>Description:</strong> {{ $product->description }}</p>

                    <div class="stock-status">
                        @if($product->isInStock())
                        <span class="text-muted" style="font-size: 0.9rem;">In Stock: {{ $product->stock }}</span>
                        @else
                        <span class="text-danger" style="font-size: 0.9rem;">Out of Stock</span>
                        @endif
                    </div>

                    <a href="{{ route('customer.index') }}" class="btn btn-secondary mt-2">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection