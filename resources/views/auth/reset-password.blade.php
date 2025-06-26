@extends('layouts.app')
@section('title', 'reset-password')
@section('content')
<div class="min-h-screen flex items-center justify-center">

    <form action="{{ route('password.update') }}" method="POST"
        class="w-full max-w-sm bg-white shadow-md rounded-lg p-6">
        @csrf
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Reset Password Form</h2>
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="flex flex-col gap-y-3">
            <div>
                <label for="email">Email</label>
                <input
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    name="email" type="email" placeholder="Enter your email" required>
                @error('email')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    name="password" type="password" placeholder="New password" required>
                @error('password')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirm password</label>
                <input
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    name="password_confirmation" type="password" placeholder="Confirm password" required>
            </div>
        </div>

        <button type="submit"
            class="w-full px-2 py-1 mt-3 rounded border border-gray-400 hover:bg-gray-400 text-gray-400 hover:text-white cursor-pointer transition">Reset
            Password</button>
    </form>
</div>
@endsection
