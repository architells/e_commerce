@extends('layouts.customer')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center">
    <div class="card p-4 shadow-lg" style="border-radius: 10px; max-width: 500px; width: 100%; margin-top: 20px;">

        <!-- Title -->
        <h2 class="text-center mb-4" style="font-weight: 700; font-size: 1.8rem; letter-spacing: 1px;">
            {{ __('Register') }}
        </h2>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="px-2">
            @csrf

            <!-- Name Input -->
            <div class="mb-4">
                <label for="name" class="form-label" style="font-weight: 500;">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    style="padding: 1rem; border-radius: 5px; font-size: 1rem; border: 1px solid #ced4da;">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="form-label" style="font-weight: 500;">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
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
                    name="password" required autocomplete="new-password"
                    style="padding: 1rem; border-radius: 5px; font-size: 1rem; border: 1px solid #ced4da;">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Confirm Password Input -->
            <div class="mb-4">
                <label for="password-confirm" class="form-label" style="font-weight: 500;">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                    style="padding: 1rem; border-radius: 5px; font-size: 1rem; border: 1px solid #ced4da;">
            </div>

            <!-- Register Button -->
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-lg btn-dark"
                    style="padding: 0.75rem; font-size: 1.1rem; letter-spacing: 0.5px; border-radius: 5px;">
                    {{ __('Register') }}
                </button>
            </div>

            <!-- Already have an account Link -->
            <div class="text-center">
                <a class="text-muted" href="{{ route('login') }}"
                    style="font-size: 0.9rem; text-decoration: none; color: #6c757d;">
                    {{ __('Already have an account? Login') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection