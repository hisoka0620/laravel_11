@extends('layouts.app')

@section('title', 'Register Page')

@section('content')

<div class="min-h-screen flex items-center justify-center">
    <form action="{{ route('register') }}" method="POST"
        class="w-full max-w-sm bg-white shadow-md rounded-lg p-6 space-y-3">
        @csrf

        <h2 class="text-2xl font-semibold text-center text-gray-800">Create an Account</h2>

        {{-- Name --}}
        <div x-data="{ value: @js(old('name')) }">
            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Name</label>
            <div class="relative">
                <input type="text" name="name" id="name" placeholder="Your name" x-model="value" :value="value"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" x-show="value" @click="value=''"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            @error('name')
            <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 border border-red-300 px-3 py-2 rounded">
                <span>{{ $message }}</span>
            </div>
            @enderror
        </div>

        {{-- Email --}}
        <div x-data="{ value: @js(old('email')) }">
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <div class="relative">
                <input type="email" name="email" id="email" placeholder="you@example.com" x-model="value" :value="value"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" x-show="value" @click="value=''"
                    class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            @error('email')
            <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 border border-red-300 px-3 py-2 rounded">
                <span>{{ $message }}</span>
            </div>
            @enderror
        </div>

        {{-- Password --}}
        <div x-data="{ value: '' }">
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="••••••••" x-model="value"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" x-show="value" @click="value=''"
                    class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            @error('password')
            <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 border border-red-300 px-3 py-2 rounded">
                <span>{{ $message }}</span>
            </div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div x-data="{ value: '' }">
            <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">Confirm
                Password</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                    x-model="value" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" x-show="value" @click="value=''"
                    class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-400 hover:text-gray-600">&times;</button>
            </div>
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150">
                Register
            </button>
        </div>
    </form>
</div>

@endsection
