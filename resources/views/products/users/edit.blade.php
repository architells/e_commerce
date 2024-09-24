@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit User</h3>

    <form action="{{ route('products.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="roles" class="form-label">Roles</label>
            @foreach($roles as $role)
            <div class="form-check">
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input"
                    @if($user->roles->contains($role)) checked @endif>
                <label class="form-check-label">{{ $role->role_name }}</label>
            </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">
                Update User
            </button>
            <a href="{{ route('products.users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection