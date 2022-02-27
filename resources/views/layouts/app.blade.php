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
                                :active="request()->routeIs('users')"
                            >Users</x-sidebar-nav-link>
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
                    <div class="mt-4 cursor-pointer">
                        <x-dropdown align="top" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-white hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/'.Auth::user()->photo) }}"
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
                {{-- @include('layouts.navigation') --}}
    
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
