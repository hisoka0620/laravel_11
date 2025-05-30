<!-- resources/views/layouts/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ToDo Dashboard')</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">📋 My ToDo List</h1>
            <nav class="flex gap-4 text-gray-700">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500">Dashboard</a>
                <a href="{{ route('tasks.index') }}" class="hover:text-blue-500">To-Do List</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline ">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto mt-6 px-4">
        @yield('content')
    </main>
</body>

</html>