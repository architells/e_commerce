<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $categories = Category::all(); // Fetch all categories
        return view('products.categories.index', compact('categories')); // Return view with categories
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('products.categories.create'); // Return view to create a new category
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('products.categories.index')->with('success', 'Category created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $category = Category::findOrFail($id); // Fetch the category
        $products = $category->products; // Get the products for that category

        return view('products.categories.show', compact('category', 'products'));
    }




    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Fetch the category by its ID
        return view('products.categories.edit', compact('category')); // Return view to edit the category
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('products.categories.index')->with('success', 'Category updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('products.categories.index')->with('deleted_product', 'Category deleted successfully.');
    }
}
