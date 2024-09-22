<?php

use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\supplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Default route for entering the website
Route::get('/', [productController::class, 'index'])->name('home');

//Route for products
Route::resource('products', productController::class);
Route::get('products', [productController::class, 'index'])->name('products.index');
Route::get('/products/{id}/description', [productController::class, 'description'])->name('products.description');




//Route for categories
Route::resource('categories', categoryController::class);
Route::get('categories', [categoryController::class, 'index'])->name('products.categories.index');
Route::get('categories', [categoryController::class, 'create'])->name('products.categories.create');
Route::get('products/categories/index', [categoryController::class, 'index'])->name('products.categories.index');
Route::get('products/categories/{id}', [categoryController::class, 'show'])->name('products.categories.show');
Route::put('products/categories/{id}', [categoryController::class, 'update'])->name('products.categories.update');

//Supplier route
Route::resource('suppliers', supplierController::class);
Route::get('products/supplier/index', [supplierController::class, 'index'])->name('products.supplier.index');
Route::post('products/supplier/store', [supplierController::class, 'store'])->name('products.supplier.store');

Auth::routes();
