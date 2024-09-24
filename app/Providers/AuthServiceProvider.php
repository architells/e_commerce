<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Gate; 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => 'App\Policies\ProductPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Define Gates
        Gate::define('manage-products', function (User $user) {
            return $user->roles->contains('role_name', 'Admin');
        });
    }
}
