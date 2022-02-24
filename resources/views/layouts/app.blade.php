<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="flex">
            <aside class="bg-gray-800 fixed top-0 left-0 w-48 min-h-screen p-2">
                <nav>
                    <ul class="flex flex-col">
                        <li>
                            <x-sidebar-nav-link 
                                :href="route('dashboard')" 
                                :active="request()->routeIs('dashboard')"
                            >Dashboard</x-sidebar-nav-link>
                        </li>
                        <li>
                            <x-sidebar-nav-link 
                                :href="route('dashboard')" 
                                :active="request()->routeIs('work-order')"
                            >Work Order</x-sidebar-nav-link>
                        </li>
                        <li>
                            <x-sidebar-nav-link 
                                :href="route('dashboard')" 
                                :active="request()->routeIs('fg')"
                            >Servis</x-sidebar-nav-link>
                        </li>
                        <li>
                            <x-sidebar-nav-link 
                                :href="route('dashboard')" 
                                :active="request()->routeIs('fg')"
                            >Merk dan Tipe</x-sidebar-nav-link>
                        </li>
                    </ul>
                    <hr>
                    <div class="mt-4">
                        <x-dropdown align="top" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-white hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                    <div class="flex items-center">
                                        <img src="data:image/jpeg;base64,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"
                                            class="w-8 h-8 object-cover rounded-full mr-2"
                                        />
                                        <span>{{ Auth::user()->name }}</span>
                                    </div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
        
                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
        
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </nav>
            </aside>
    
            <!-- Page Content -->
            <main class="ml-48 w-full">
                @include('layouts.navigation')
    
                <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
