@extends('layouts.app')

@section('title', 'Login Page')

@section('content')

{{-- Display when session expired --}}

@if (session('message'))
<div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
    class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded shadow-lg z-50 flex items-center space-x-4">
    <span>{{ session('message') }}</span>
    <button @click="show = false" class="text-white hover:text-gray-200 text-xl leading-none">&times;</button>
</div>
@endif

{{-- Display when login authentication fails --}}

@if ($errors->any())
<div class="max-w-sm mx-auto mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('login') }}" method="POST" class="max-w-sm mx-auto mt-10 space-y-4">
    @csrf
    <div>
        <label for="email">Email</label>
        <div class="relative">
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="xxx@xx" required
                class="w-full border border-gray-300 px-3 py-2 rounded" oninput="toggleClearButton(this)">
            <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                onclick="clearInput(this)" style="display: none;">&times;</button>
        </div>
    </div>

    <div>
        <label for="password">Password</label>
        <div class="relative">
            <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="xxxxxxxx"
                required class="w-full border border-gray-300 px-3 py-2 rounded" oninput="toggleClearButton(this)">
            <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                onclick="clearInput(this)" style="display: none;">&times;</button>
        </div>
    </div>

    <div class="mt-4">
        <label class="inline-flex items-center">
            <input type="checkbox" name="remember" class="form-checkbox text-blue-600">
            <span class="ml-2 text-sm text-gray-700">Remember Me</span>
        </label>
    </div>

    <div class="flex justify-center">
        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
    </div>

</form>

@endsection

<script>
    function toggleClearButton(input) {
    const button = input.parentElement.querySelector('button');
    button.style.display = input.value ? 'block' : 'none';
    }

    function clearInput(button) {
    const input = button.parentElement.querySelector('input');
    input.value = '';
    input.focus();
    button.style.display = 'none';
    }
</script>
