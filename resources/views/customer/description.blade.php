@extends('layouts.customer')

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

                    @if($product->isInStock())
                    <span style="font-size: 0.8rem;">In Stock: {{ $product->stock }}</span>
                    @else
                    <span style="color: red; font-size: 0.8rem;">Out of Stock</span>
                    @endif

                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <p class="card-text mt-2">
                                    @if($product->discount)
                                    <span style="color: green; font-size: 1.2rem; font-weight: bold;">
                                        ₱{{ number_format($product->discountedPrice($product->discount), 2, '.', ',') }}
                                    </span>
                                    <br>
                                    @else
                                    <span style="color: red; font-size: 1rem; font-weight: bold;">
                                        ₱{{ number_format($product->price, 2, '.', ',') }}
                                    </span><br>
                                    @endif
                                </p>
                            </h5>

                            <form action="#" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                            </form>
                        </div>
                    </div>

                    <a href="{{ route('customer.index') }}" class="btn btn-secondary mt-2">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection