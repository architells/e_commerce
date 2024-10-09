<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class checkOutController extends Controller
{
    // Display checkout form
    public function showCheckoutForm()
    {
        // Retrieve the user's cart
        $cart = session()->get('cart', []);
        $totalAmount = $this->calculateTotal($cart);

        return view('customer.checkout.form', compact('cart', 'totalAmount'));
    }

    // Calculate total amount from the cart
    private function calculateTotal($cart)
    {
        $total = 0;

        foreach ($cart as $item) {
            // Calculate discounted price if applicable
            $discountedPrice = $item['discount'] > 0 ? $item['price'] * (1 - $item['discount'] / 100) : $item['price'];
            $total += $discountedPrice * $item['quantity'];
        }

        return $total;
    }

    // Process checkout form submission
    public function processCheckout(Request $request)
    {
        // Validate the form fields
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'payment_method' => 'required|in:mock,paypal,stripe'
        ]);

        // Get the user's cart from the session
        $cart = session()->get('cart', []);

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $this->calculateTotal($cart),
            'payment_status' => 'Pending',
            'shipping_status' => 'Pending',
        ]);


        foreach ($cart as $item) {

            $discountedPrice = $item['discount'] > 0 ? $item['price'] * (1 - $item['discount'] / 100) : $item['price'];

            OrderItem::create([
                'order_id' => $order->order_id,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $discountedPrice,
            ]);
        }


        session()->forget('cart');

        return redirect()->route('customer.index')->with('success', 'Checkout completed successfully!');
    }
}
