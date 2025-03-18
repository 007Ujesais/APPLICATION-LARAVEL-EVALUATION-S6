<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/js/import.js'])
</head>

<body class="fi-body fi-panel-admin min-h-screen bg-gray-50 font-normal text-gray-950 bg-dots antialiased dark:bg-gray-950 dark:text-white">


    <div class="fi-layout flex min-h-screen w-full flex-row-reverse overflow-x-clip">
        <div class="fi-main-ctn w-screen flex-1 flex-col">
            <div class="fi-topbar sticky top-0 z-20 overflow-x-clip">
                @include('admin.partials.header')
            </div>
            <main class="fixed overflow-auto mx-auto h-full w-full px-4 md:px-6 lg:px-8 max-w-[88rem]">
                <div>
                    <section class="flex h-[100000px] flex-col gap-y-8 py-8">
                        @yield('content')
                    </section>
                </div>
            </main>
        </div>
        <div x-data="{}" x-on:click="$store.sidebar.close()" x-show="$store.sidebar.isOpen"
            x-transition.opacity.300ms=""
            class="fi-sidebar-close-overlay fixed inset-0 z-30 bg-gray-950/50 transition duration-500 dark:bg-gray-950/75 lg:hidden"
            style="display: none;"></div>
        @include('admin.partials.aside')
    </div>
</body>
</html>
