@extends('layouts.customer')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Checkout</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Billing Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.checkout.process') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="Enter your full name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" required placeholder="Enter your email address">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Shipping Address</label>
                            <textarea class="form-control" name="address" required placeholder="Enter your shipping address" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="" disabled selected>Select your payment method</option>
                                <option value="mock">Mock Payment</option>
                                <option value="paypal">PayPal</option>
                                <option value="stripe">Stripe</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Complete Checkout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Your Cart</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalAmount = 0; @endphp
                            @foreach($cart as $item)
                            @php
                            $discountedPrice = $item['discount'] > 0 ? $item['price'] * (1 - $item['discount'] / 100) : $item['price'];
                            $itemTotal = $discountedPrice * $item['quantity'];
                            $totalAmount += $itemTotal;
                            @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>₱{{ number_format($item['price'], 2) }}</td>
                                <td>{{ $item['discount'] }}%</td>
                                <td>₱{{ number_format($itemTotal, 2) }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-primary">
                                <td colspan="4" class="text-end"><strong>Total Amount:</strong></td>
                                <td>₱{{ number_format($totalAmount, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection