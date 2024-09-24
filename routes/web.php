<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\productController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default route for entering the website
Route::get('/', [customerController::class, 'index'])->name('home');

// Route for customers
Route::resource('customer', customerController::class);
Route::get('customer/{id}/description', [customerController::class, 'description'])->name('customer.description');
Route::get('/products/category/{id}', [CustomerController::class, 'category'])->name('customer.category');

route::resource('shopping-cart', cartController::class);
route::get('shopping-cart',[cartController::class, 'index'])->name('customer.shopping-cart.index');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/show', [profileController::class, 'show'])->name('customer.profile.edit');
Route::post('/profile/update', [profileController::class, 'update'])->name('customer.profile.update');
Route::get('/profile/destroy', [profileController::class, 'destroy'])->name('customer.profile.destroy');
Route::get('/profile/edit', [profileController::class, 'edit'])->name('customer.profile.edit');
Route::put('/customer/password/update', [profileController::class, 'updatePassword'])->name('customer.password.update');



// Route for products with admin middleware
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':Admin'])->group(function () {
    Route::resource('products', productController::class);
    Route::get('products', [productController::class, 'index'])->name('products.index');
    Route::get('products/dashboard', [productController::class, 'dashboard'])->name('products.dashboard');
    Route::get('/products/{id}/description', [productController::class, 'description'])->name('products.description');

    Route::resource('users', UserController::class);
    Route::get('/products/users/index', [UserController::class, 'index'])->name('products.users.index');
    Route::get('/products/users', [UserController::class, 'create'])->name('products.users.create');
    Route::post('/products/users', [UserController::class, 'store'])->name('products.users.store');
    Route::post('/products/users', [UserController::class, 'update'])->name('products.users.update');

    // Route for categories with admin middleware
    Route::resource('categories', categoryController::class);
    Route::get('categories', [categoryController::class, 'index'])->name('products.categories.index');
    Route::get('categories/create', [categoryController::class, 'create'])->name('categories.create');
    Route::get('products/categories/index', [categoryController::class, 'index'])->name('products.categories.index');
    Route::get('products/categories/{id}', [categoryController::class, 'show'])->name('products.categories.show');
    Route::put('products/categories/{id}', [categoryController::class, 'update'])->name('products.categories.update');

    // Supplier route with admin middleware
    Route::resource('suppliers', supplierController::class);
    Route::get('products/supplier/index', [supplierController::class, 'index'])->name('products.supplier.index');
    Route::post('products/supplier/store', [supplierController::class, 'store'])->name('products.supplier.store');
    
});

Auth::routes();

