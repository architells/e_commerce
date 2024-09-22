<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    // Display a listing of the suppliers.
    public function index()
    {
        $suppliers = Supplier::all(); // Fetch all suppliers
        return view('products.supplier.index', compact('suppliers'));
    }

    // Show the form for creating a new supplier.
    public function create()
    {
        return view('products.supplier.create'); // Return view to create a new supplier
    }

    // Store a newly created supplier in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Supplier::create($request->all()); // Create new supplier

        return redirect()->route('products.supplier.index')->with('success', 'Supplier created successfully.');
    }

    // Show the form for editing the specified supplier.
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id); // Fetch the supplier by its ID
        return view('products.supplier.edit', compact('supplier'));
    }

    // Update the specified supplier in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $supplier = Supplier::findOrFail($id); // Fetch supplier by its ID
        $supplier->update($request->all()); // Update supplier details

        return redirect()->route('products.supplier.index')->with('success', 'Supplier updated successfully.');
    }

    // Remove the specified supplier from storage.
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id); // Fetch supplier by its ID
        $supplier->delete(); // Delete the supplier

        return redirect()->route('suppliers.index')->with('deleted_supplier', 'Supplier deleted successfully.');
    }
}
