@extends('layouts.customer')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 600px; margin: auto; border-radius: 10px;">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Your Notifications</h3>
        </div>
        <div class="card-body">
            @if ($latestNotification)
            <div class="alert alert-info">
                <strong>Latest Notification:</strong><br>
                <i class="bi bi-bell-fill"></i>
                Order ID: <strong>{{ $latestNotification->data['order_id'] }}</strong><br>
                Shipping Status: <strong>{{ $latestNotification->data['shipping_status'] }}</strong>
            </div>
            @else
            <div class="alert alert-secondary">
                No new notifications.
            </div>
            @endif

            <h5 class="mt-4">All Notifications</h5>
            <div style="max-height: 200px; overflow-y: auto;">
                @if ($notifications->isNotEmpty())
                @foreach ($notifications as $notification)
                <div class="alert alert-light">
                    <strong>Notification:</strong><br>
                    <i class="bi bi-bell-fill"></i>
                    Order ID: <strong>{{ $notification->data['order_id'] }}</strong><br>
                    Shipping Status: <strong>{{ $notification->data['shipping_status'] }}</strong>
                </div>
                @endforeach
                @else
                <div class="alert alert-secondary">
                    No notifications available.
                </div>
                @endif
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('customer.my-orders.index') }}" class="btn btn-primary">
                View All Orders
            </a>
        </div>
    </div>
</div>
@endsection