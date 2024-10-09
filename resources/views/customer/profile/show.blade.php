@extends('layouts.customer')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Profile') }}
</h2>
@endsection

@section('content')
@if (session('success'))
<script>
    Swal.fire({
        title: 'Success',
        icon: 'success',
        text: "{{session('success')}}",
    });
</script>
@endif
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('customer.profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('customer.profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('customer.profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection