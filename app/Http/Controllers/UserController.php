<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('products.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('products.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
        ]);

        // Create the user with the hashed password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Attach roles to the user
        $user->roles()->attach($request->roles);

        return redirect()->route('products.users.index')->with('success', 'User created successfully.');
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('products.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        $user->update($request->only('name', 'email'));
        $user->roles()->sync($request->roles);

        return redirect()->route('products.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('products.users.index')->with('success', 'User deleted successfully.');
    }
}
