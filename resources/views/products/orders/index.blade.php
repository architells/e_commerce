@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Orders</h1>

    @if (session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            icon: 'success',
            text: "{{session('success')}}",
        });
    </script>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">User</th>
                <th scope="col">Order Date</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Update Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td> <!-- Display order date in 24-hour format -->
                <td>₱{{ number_format($order->total_amount, 2) }}</td> <!-- Display total amount -->
                <td>{{ $order->shipping_status }}</td>
                <td>
                    <form action="{{ route('products.orders.update', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <select name="shipping_status" class="form-select d-inline" style="width: auto;">
                            <option value="Pending" {{ $order->shipping_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Shipped" {{ $order->shipping_status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="Delivered" {{ $order->shipping_status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm ml-4">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection