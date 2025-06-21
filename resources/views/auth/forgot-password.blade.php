@extends('layouts.app')
@section('title', 'forgot-password')
@section('content')
<div class="min-h-screen flex items-center justify-center">
    <form action="{{ route('password.email') }}" method="POST"
        class="w-full max-w-sm bg-white shadow-md rounded-lg p-6">
        @csrf
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Forgot Password Form</h2>
        @if (session('status'))
        <div class="mb-3 text-blue-500 font-semibold">{{ session('status') }}</div>
        @endif
        <div class="flex flex-col mb-1">
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required placeholder="sample@co.jp">
        </div>
        @error('email')
        <p class="text-red-600">{{ $message }}</p>
        @enderror
        <button type="submit"
            class="w-full mt-3 px-2 py-1 border border-gray-400 rounded hover:bg-gray-400 text-gray-400 hover:text-white cursor-pointer transition">Send Reset Link</button>
    </form>
</div>
@endsection
