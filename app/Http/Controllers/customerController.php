<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all();

        $search = $request->input('search');
        $products = Product::where('product_name', 'LIKE', "%{$search}%")->get();

        return view('customer.index', compact('products', 'categories'));
    }

    public function category(Request $request, string $id)
    {
        $products = Product::where('category_id', $id);

        if ($request->session()->has('filtered_products')) {
            $products = $products->whereIn('id', session('filtered_products'));
        }

        $products = $products->get();
        $categories = Category::all();

        return view('customer.index', compact('products', 'categories'));
    }

    public function description(string $id)
    {

        $product = Product::findOrFail($id);

        return view('customer.description', compact('product'));
    }
}
