<!-- resources/views/layouts/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ToDo Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">📋 My ToDo List</h1>

            <!-- mobile navi menu -->
            <div x-data="{ open: false }" class="md:hidden">
                <button @click="open = !open" class="focus:outline-none text-gray-700">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div x-show="open" x-transition class="absolute right-4 mt-2 w-48 bg-white shadow-md rounded-lg py-2 z-50">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <a href="{{ route('tasks.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">To-Do List</a>
                    <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                        @csrf
                        <button type="submit" class="text-red-500 hover:underline">Logout</button>
                    </form>
                </div>
            </div>

            <nav class="hidden md:flex gap-4 text-gray-700">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500">Dashboard</a>
                <a href="{{ route('tasks.index') }}" class="hover:text-blue-500">To-Do List</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline hover:cursor-pointer">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto mt-6 px-4">
        @yield('content')
    </main>
</body>

</html>
