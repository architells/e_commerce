<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class cartController extends Controller
{
    
    public function index()
    {
        
        return view('customer.shopping-cart.index');
    }
}
