<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/js/import.js'])
</head>

<body
    class="bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen bg-dots selection:bg-gray-300 selection:text-black">

    @include('admin.partials.header')



    <div class="fi-layout flex min-h-screen w-full flex-row-reverse overflow-x-clip">
        <div x-data="{}" x-bind:style="'display: flex; opacity:1;'"
            class="fi-main-ctn w-screen flex-1 flex-col opacity-0" style="display: flex; opacity:1;">
            <main class="fi-main mx-auto h-full w-full px-4 md:px-6 lg:px-8 max-w-7xl">
                @yield('content')
            </main>
        </div>

        @include('admin.partials.aside')

    </div>
</body>

</html>