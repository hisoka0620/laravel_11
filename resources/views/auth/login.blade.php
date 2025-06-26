@extends('layouts.app')

@section('title', 'Login Page')

@section('content')

<div class="min-h-screen flex items-center justify-center">
    <form action="{{ route('login') }}" method="POST"
        class="w-full max-w-sm bg-white shadow-md rounded-lg p-6 space-y-3">
        @csrf
        <h2 class="text-2xl font-semibold text-center text-gray-800">Sign In</h2>

        {{-- Email --}}
        <div x-cloak x-data="{ value: @js(old('email')) }">
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <div class="relative">
                <input type="email" name="email" id="email" x-model="value" :value="value" placeholder="you@example.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
                <button type="button" x-show="value" @click="value = ''"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            @error('email')
            <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 border border-red-300 px-4 py-2 rounded">
                <span>{{ $message }}</span>
            </div>
            @enderror
        </div>

        {{-- Password --}}
        <div x-cloak x-data="{ password: '' }">
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="••••••••" x-model="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
                <button x-show="password" @click="password = ''" type="button"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            @error('password')
            <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 border border-red-300 px-3 py-2 rounded">
                <span>{{ $message }}</span>
            </div>
            @enderror
        </div>

        <div class="flex justify-between">
            {{-- Remember me --}}
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="remember" id="remember" class="accent-blue-600 h-4 w-4">
                <label for="remember" class="text-sm text-gray-700">Remember Me</label>
            </div>

            {{-- forgot password --}}
            <div>
                <a href="{{ route('password.request') }}" class="text-sm hover:text-red-500 transition">Forgot your password?</a>
            </div>
        </div>


        {{-- Submit --}}
        <div>
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-150">
                Login
            </button>
        </div>
    </form>
</div>

@endsection
