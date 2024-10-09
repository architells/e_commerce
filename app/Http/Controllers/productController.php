<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class productController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $newOrdersCount = Order::where('shipping_status', 'Pending')->count();
        // Return a view with the products
        return view('products.home', compact('newOrdersCount'));
    }

    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->session()->has('filtered_products')) {
            $products = $products->whereIn('id', session('filtered_products'));
        } else {
            $products = $products->get();
        }

        $categories = Category::all();
        $user = Auth::user();

        $search = $request->input('search');
        $products = Product::where('product_name', 'LIKE', "%{$search}%")->get();

        return view('products.index', compact('products', 'categories', 'search', 'user'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.create', compact('categories', 'suppliers'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $this->authorize('create', Product::class);
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id');
        $product->supplier_id = $request->input('supplier_id');

        // Handle file upload if present
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagePath = $image->store('product_images', 'public'); // Store image in 'product_images' directory
            $product->product_image = $imagePath;
        }

        // Save the product to the database
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = Product::findOrFail($id);
        // Return a view to show the product details
        return view('products.show', compact('product'));
    }

    /**
     * Search for products based on a search query.
     */
    // public function search(Request $request)
    // {
    //     $search = $request->input('search', '');

    //     // Fetch products based on the search query
    //     $products = Product::where('product_name', 'like', "%$search%")
    //         ->orWhere('description', 'like', "%$search%")
    //         ->get();

    //     // Return the view with products data and search query
    //     return view('products.index', compact('products', 'search'));
    // }


    public function createCaterogy()
    {
        // Fetch all categories to pass to the view
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the product first before authorizing
        $product = Product::findOrFail($id);

        // Now you can authorize the update action
        $this->authorize('update', $product);

        // Fetch categories and suppliers
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Return the edit view with the fetched data
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }



    /**
     * Display product description (custom method).
     */
    public function description(string $id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);
        // Return a view with product description
        return view('products.description', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'discount' => 'required|numeric',
        ]);

        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Authorize the user to update the product
        $this->authorize('update', $product);

        // Update product attributes
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id');
        $product->supplier_id = $request->input('supplier_id');
        $product->discount = $request->input('discount');

        // Handle file upload if present
        if ($request->hasFile('product_image')) {
            // Delete the old image if it exists
            if ($product->product_image) {
                Storage::delete('public/' . $product->product_image);
            }

            $image = $request->file('product_image');
            $imagePath = $image->store('product_images', 'public');
            $product->product_image = $imagePath;
        }

        // Save the product to the database
        $product->save();

        // Redirect with success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Authorize the user to delete the product
        $this->authorize('delete', Product::class);
        // Delete the product image if it exists
        if ($product->product_image) {
            Storage::delete('public/' . $product->product_image);
        }

        // Delete the product from the database
        $product->delete();

        // Redirect to the index page with a success message
        return redirect()->route('products.index')->with('deleted_product', 'Product deleted successfully.');
    }
}
