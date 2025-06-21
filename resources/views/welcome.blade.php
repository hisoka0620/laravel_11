<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to To-do List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex justify-center items-center min-h-screen px-4">
        <div class="w-full max-w-md text-center space-y-6">
            <h1 class="text-4xl font-bold text-gray-900">Welcome to To-do List!</h1>

            @guest
            <div class="space-y-4">
                <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
                    <p class="text-lg text-gray-700 mb-3">Start managing your tasks efficiently.</p>
                    <a href="{{ route('register') }}"
                        class="inline-block w-full bg-blue-600 text-white font-medium py-2 rounded hover:bg-blue-700 transition">
                        Create an Account
                    </a>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
                    <p class="text-sm text-gray-600 mb-2">Already have an account?</p>
                    <a href="{{ route('login') }}"
                        class="inline-block w-full border border-blue-600 text-blue-600 font-medium py-2 rounded hover:bg-blue-50 transition">
                        Sign In
                    </a>
                </div>
            </div>
            @else
            <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
                <p class="text-lg mb-3">Hello, <span class="font-semibold">{{ Auth::user()->name }}</span>! 👋</p>
                <a href="{{ route('dashboard') }}"
                    class="inline-block w-full bg-green-600 text-white font-medium py-2 rounded hover:bg-green-700 transition">
                    Go to Dashboard
                </a>
            </div>
            @endguest
        </div>
    </div>
</body>

</html>
