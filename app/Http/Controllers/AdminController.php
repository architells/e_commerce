<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class AdminController extends Controller
{
    public function index(){

        $productsCount = Product::count();
        $products = Product::all();
        return view('admin.main-dashboard', compact('products', 'productsCount'));
    }
}
