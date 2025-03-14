<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @vite(['resources/css/app.css'])
    @vite(['primeicons/primeicons.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen bg-dots selection:bg-gray-300 selection:text-black">

    @include('admin.partials.header')

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
