<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\ShippingStatusUpdated;

class adminOrderController extends Controller
{
    public function index()
    {
        // Fetch all orders with user details
        $orders = Order::with('user')->get();
        return view('products.orders.index', compact('orders'));
    }

    public function update(Request $request, $order_id)
{
    // Validate the request
    $request->validate([
        'shipping_status' => 'required|string|in:Pending,Shipped,Delivered,Canceled',
    ]);

    $order = Order::where('order_id', $order_id)->firstOrFail();
    $order->update([
        'shipping_status' => $request->input('shipping_status'),
    ]);

    // Notify the user
    $order->user->notify(new ShippingStatusUpdated($order));

    return redirect()->route('products.orders.index')->with('success', 'Order status updated and user notified!');
}


    public function report()
    {
        // Generate report logic here
        return view('products.orders.report');
    }
}
