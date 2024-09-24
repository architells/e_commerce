<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/customer';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated($request, $user)
    {
        // Check the user's role and redirect accordingly
        if ($user->roles->contains('role_name', 'Admin')) {
            return redirect()->route('products.index');
        }

        return redirect()->intended($this->redirectTo); 
    }
}
