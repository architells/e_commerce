@extends('layouts.customer')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Your Shopping Cart</h1>

    @if (session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            icon: 'success',
            text: "{{ session('success') }}",
        });
    </script>
    @endif
    @if (session('deleted_product'))
    <script>
        Swal.fire({
            title: 'Success',
            icon: 'success',
            text: "{{ session('deleted_product') }}",
        });
    </script>
    @endif

    @if(empty($cart))
    <div class="text-center">
        <p>Your cart is empty.</p>
        <a href="{{ route('customer.index') }}" class="btn btn-primary">Continue Shopping</a>
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                @php
                $discount = $item['discount'] ?? 0;
                $discountedPrice = $discount > 0 ? $item['price'] * (1 - $discount / 100) : $item['price'];
                $subtotal = $discountedPrice * $item['quantity'];
                $total += $subtotal;
                @endphp
                <tr>
                    <td>
                        @if($item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="50" class="me-2">
                        @endif
                        {{ $item['name'] }}
                    </td>
                    <td>
                        @if($discount > 0)
                        <span class="text-decoration-line-through text-danger">₱{{ number_format($item['price'], 2) }}</span>
                        @else
                        ₱{{ number_format($item['price'], 2) }}
                        @endif
                    </td>
                    <td>
                        @if($discount > 0)
                        {{ $discount }}%
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('customer.shopping-cart.update') }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control me-2" required>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                    <td>
                        ₱{{ number_format($subtotal, 2) }}
                    </td>
                    <td>
                        <form action="{{ route('customer.shopping-cart.remove', ['id' => $id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>₱{{ number_format($total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('customer.index') }}" class="btn btn-primary">Continue Shopping</a>
        <a href="{{ route('checkout.form') }}" class="btn btn-success">Proceed to Checkout</a>
    </div>
    @endif
</div>
@endsection