@extends('layouts.app')

@section('title', 'Register Page')

@section('content')

@if ($errors->any())

@endif

<form action="{{ route('register') }}" method="POST" class="max-w-sm mx-auto mt-10 space-y-4">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="taro yamada" value="{{ old('name') }}"
            class="w-full border border-gray-300 px-3 py-2 rounded">
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="xxx@xx" value="{{ old('email') }}"
            class="w-full border border-gray-300 px-3 py-2 rounded">
        @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="xxxxxxxx"
            class="w-full border border-gray-300 px-3 py-2 rounded">
        @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" required
            class="w-full border border-gray-300 px-3 py-2 rounded">
    </div>

    <div class="flex justify-center">
        <button type="submit"
            class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</button>
    </div>

</form>
@endsection
