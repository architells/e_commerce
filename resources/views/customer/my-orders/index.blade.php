@extends('layouts.customer')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">My Orders</h2>

    @forelse($orders as $order)
    <div class="card mb-4 border-secondary">
        <div class="card-body">
            <!-- <h5 class="card-title">Order {{ $order->order_id }}</h5> -->

            <!-- <h6 class="mt-2">Products:</h6> -->
            <ul class="list-group mb-3">
                @foreach($order->orderItems as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div>
                            <strong>{{ $item->product_name }}</strong><br>
                            <small class="text-muted">Quantity: {{ $item->quantity }} pcs</small>
                        </div>
                    </div>
                    <span class="text-success">₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                </li>
                @endforeach
            </ul>

            <p><strong>Total Amount:</strong> <span class="text-success">₱{{ number_format($order->total_amount, 2) }}</span></p>
            <p><strong>Payment Status:</strong> <span class="{{ $order->payment_status == 'Paid' ? 'text-success' : 'text-danger' }}">{{ ucfirst($order->payment_status) }}</span></p>
            <p><strong>Shipping Status:</strong> <span class="{{ $order->shipping_status == 'Shipped' ? 'text-success' : 'text-warning' }}">{{ ucfirst($order->shipping_status) }}</span></p>

        </div>
    </div>
    @empty
    <div class="alert alert-info">You have no orders yet.</div>
    @endforelse
</div>
@endsection