<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function show()
    {
        // Fetch the most recent order for the authenticated customer
        $order = Order::with('orderItems')
            ->where('user_id', Auth::id())
            ->latest()
            ->first(); // Assuming this method shows the most recent order

        // Get unread notifications for the logged-in user
        $notifications = Auth::user()->unreadNotifications;

        // Get the latest unread notification (if any)
        $latestNotification = $notifications->first();
        $unreadCount = $notifications->count(); // Get the count of unread notifications

        // Pass the correct variable names in compact
        return view('customer.emails.order_confirmation', compact('order', 'latestNotification', 'unreadCount', 'notifications'));
    }




    public function myOrders()
    {
        $orders = Order::with('orderItems')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Get unread notifications for the logged-in user
        $notifications = Auth::user()->unreadNotifications;

        return view('customer.my-orders.index', compact('orders', 'notifications'));
    }
}
