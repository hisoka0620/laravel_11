<!-- resources/views/layouts/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Todo Dashboard')

@section('content')

<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">📋 My ToDo List</h1>
        <nav class="space-x-4">
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-500">Dashboard</a>
            {{-- <a href="{{ route('tasks.index') }}" class="text-gray-700 hover:text-blue-500">To-Do List</a> --}}
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="text-red-500 hover:underline bg-transparent appearance-none">Logout</button>
            </form>
        </nav>
    </div>
</header>

<main class="max-w-5xl mx-auto mt-6 px-4">

</main>
@endsection
