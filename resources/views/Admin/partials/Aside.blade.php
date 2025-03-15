@php
    $menuItems = [
        [
            'title' => 'Control',
            'icon' => '',
            'route' => 'dashboard',
            'submenu' => [
                ['title' => 'Dashboard', 'icon' => 'pi-home', 'route' => 'products.index'],
            ]
        ],
        [
            'title' => 'Shop',
            'icon' => '',
            'route' => 'dashboard',
            'submenu' => [
                ['title' => 'Products', 'icon' => 'pi-th-large', 'route' => 'products.index'],
                ['title' => 'Orders', 'icon' => 'pi-shopping-bag', 'route' => 'products.create'],
                ['title' => 'Customers', 'icon' => 'pi-users', 'route' => 'products.create']
            ]
        ],
        [
            'title' => 'Blog',
            'icon' => 'fas fa-shopping-cart',
            'route' => 'dashboard',
            'submenu' => [
                ['title' => 'Post', 'icon' => 'pi-file', 'route' => 'dashboard'],
                ['title' => 'Categories', 'icon' => 'pi-folder-open', 'route' => 'dashboard'],
                ['title' => 'Authors', 'icon' => 'pi-home', 'route' => 'dashboard'],
                ['title' => 'Links', 'icon' => 'pi-link', 'route' => 'dashboard']
            ]
        ]
    ];
@endphp

<aside x-data="{}"
    x-bind:class="$store.sidebar.isOpen ?
        'fi-sidebar-open w-[--sidebar-width] translate-x-0 shadow-xl ring-1 ring-gray-950\/5 dark:ring-white\/10 rtl:-translate-x-0 lg:sticky' :
        'w-[--sidebar-width] -translate-x-full rtl:translate-x-full lg:sticky'"
    class="fi-sidebar fixed inset-y-0 start-0 z-30 flex flex-col h-screen content-start bg-white transition-all dark:bg-gray-900 lg:z-0 lg:bg-transparent lg:shadow-none lg:ring-0 lg:transition-none dark:lg:bg-transparent lg:translate-x-0 rtl:lg:-translate-x-0 fi-main-sidebar w-[--sidebar-width] -translate-x-full rtl:translate-x-full lg:sticky">
    <div class="overflow-x-clip">
    </div>

    <nav class="fi-sidebar-nav flex-grow flex flex-col gap-y-7 overflow-y-auto overflow-x-hidden px-6 py-8">
        <ul class="fi-sidebar-nav-groups -mx-2 flex flex-col gap-y-7">
        @foreach ($menuItems as $item)
            <li class="fi-sidebar-group flex flex-col gap-y-1">
                <ul class="fi-sidebar-group-items flex flex-col gap-y-1">
                    <li class="fi-sidebar-item">
                        @if (isset($item['route']))
                        <a href="{{ route($item['route'] ?? '#') }}" class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                            <p class="pi {{ $item['icon'] }}"></p>
                            <span
                                class="fi-sidebar-group-label flex-1 text-sm font-medium leading-6 text-gray-500 dark:text-gray-400">
                                {{ $item['title'] }}
                            </span>
                            @if (isset($item['submenu']))
                            <button class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray fi-sidebar-group-collapse-button">
                                <p class="pi pi-angle-up"></p>
                            </button>
                            @endif
                        </a>
                        @endif
                        @if (isset($item['submenu']))
                            <ul class="ml-4">
                                @foreach ($item['submenu'] as $sub)
                                    <li>
                                        @if (isset($sub['route']))
                                        <a href="{{ route($sub['route'] ?? '#') }}" class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                            <p class="pi {{ $sub['icon'] }}"></p>
                                            <span
                                                class="fi-sidebar-item-label flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200">
                                            {{ $sub['title'] }}
                                            </span>
                                        </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                </ul>
            </li>
        @endforeach
    </ul>
</aside>
