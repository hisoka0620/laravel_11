<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 font-sans antialiased">
    @yield('content')
</body>

</html>
