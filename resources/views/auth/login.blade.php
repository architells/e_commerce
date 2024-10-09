@extends('layouts.customer')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center">
    <div class="card p-4 shadow-lg" style="border-radius: 10px; max-width: 500px; width: 100%; margin-top: 100px;">

        <!-- Title -->
        <h2 class="text-center mb-4" style="font-weight: 700; font-size: 1.8rem; letter-spacing: 1px;">
            {{ __('Login') }}
        </h2>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="px-2">
            @csrf

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="form-label" style="font-weight: 500;">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                    style="padding: 1rem; border-radius: 5px; font-size: 1rem; border: 1px solid #ced4da;">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="form-label" style="font-weight: 500;">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                    name="password" autocomplete="current-password"
                    style="padding: 1rem; border-radius: 5px; font-size: 1rem; border: 1px solid #ced4da;">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <!-- Login Button -->
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-lg btn-dark"
                    style="padding: 0.75rem; font-size: 1.1rem; letter-spacing: 0.5px; border-radius: 5px;">
                    {{ __('Login') }}
                </button>
            </div>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
            <div class="text-center">
                <a class="text-muted" href="{{ route('password.request') }}"
                    style="font-size: 0.9rem; text-decoration: none; color: #6c757d;">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection