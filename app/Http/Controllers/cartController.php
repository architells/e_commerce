<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class cartController extends Controller
{
    /**
     * Display the current items in the cart.
     */
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $cartCount = count($cart); // Count the number of items in the cart
        return view('customer.shopping-cart.index', compact('cart', 'cartCount')); // Pass the count to the view
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            // Redirect to login page with a return URL
            return redirect()->route('login')->with('redirect_url', url()->previous());
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // If product already exists in cart, update the quantity
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $cart[$id] = [
                "name"     => $product->product_name,
                "quantity" => $quantity,
                "price"    => $product->price,
                "image"    => $product->product_image,
                "discount" => $product->discount ?? 0,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('customer.shopping-cart.view')->with('success', 'Product added to cart!');
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity  = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->route('customer.shopping-cart.view')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('customer.shopping-cart.view')->with('error', 'Product not found in cart.');
    }

    /**
     * Remove a product from the cart.
     */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('customer.shopping-cart.view')->with('success', 'Product removed from cart!');
        }

        return redirect()->route('customer.shopping-cart.view')->with('error', 'Product not found in cart.');
    }
}
