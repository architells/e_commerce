<?php

use App\Http\Controllers\Admin\adminOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\checkOutController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\productController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\UserController;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default route for entering the website
Route::get('/', [customerController::class, 'index'])->name('home');


Route::get('/login', [LoginController::class, 'authenticated'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route for customers
Route::resource('customer', customerController::class);
Route::get('customer/{id}/description', [customerController::class, 'description'])->name('customer.description');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/products/category/{id}', [CustomerController::class, 'category'])->name('customer.category');

    Route::resource('shopping-cart', cartController::class);
    Route::post('/shopping-cart', [cartController::class, 'add'])->name('customer.shopping-cart.index');
    Route::post('/shopping-cart/add/{id}', [cartController::class, 'add'])->name('customer.shopping-cart.add');
    Route::get('/shopping-cart', [cartController::class, 'viewCart'])->name('customer.shopping-cart.view');
    Route::post('/shopping-cart/update', [cartController::class, 'updateCart'])->name('customer.shopping-cart.update');
    Route::delete('/shopping-cart/remove/{id}', [cartController::class, 'removeFromCart'])->name('customer.shopping-cart.remove');

    Route::get('/checkout', [checkOutController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout/process', [checkOutController::class, 'processCheckout'])->name('customer.checkout.process');


    Route::resource('my-orders', orderController::class);
    route::get('my-orders', [orderController::class, 'myOrders'])->name('customer.my-orders.index');

  

    Route::get('/customer/profile/show', [profileController::class, 'show'])->name('customer.profile.show');
    Route::get('/customer/profile/edit', [profileController::class, 'edit'])->name('customer.profile.edit');
    Route::post('/customer/profile/update', [profileController::class, 'update'])->name('customer.profile.update');
    Route::delete('/customer/profile/destroy', [profileController::class, 'destroy'])->name('customer.profile.destroy');

    Route::post('/password/update', [PasswordReset::class, 'update'])->name('password.update');
    Route::get('/customer/emails/order-confirmation', [orderController::class, 'show'])->name('customer.emails.order_confirmation');
});



// Route for products with admin middleware
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':Admin'])->group(function () {
    Route::resource('products', productController::class);
    Route::get('products', [productController::class, 'index'])->name('products.index');
    Route::get('/home', [productController::class, 'dashboard'])->name('products.home');
    Route::get('/products/{id}/description', [productController::class, 'description'])->name('products.description');

    //route for user manangement
    Route::resource('users', UserController::class);
    Route::get('/products/users/index', [UserController::class, 'index'])->name('products.users.index');
    Route::get('/products/users', [UserController::class, 'create'])->name('products.users.create');
    Route::post('/products/users/store', [UserController::class, 'store'])->name('products.users.store');
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


    // Order management route with admin middleware
    Route::resource('products/orders',adminOrderController::class);
    Route::get('/orders', [adminOrderController::class, 'index'])->name('products.orders.index');
    Route::patch('/orders/{order_id}', [adminOrderController::class, 'update'])->name('products.orders.update');
    Route::get('/orders/report', [adminOrderController::class, 'report'])->name('products.orders.report');

});

Auth::routes();
