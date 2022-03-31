<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" href="{{ asset('images/sogojayaicon.png')}}">

        <title>@yield('title', config("app.name", "Sogo Jaya AC") )</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        @livewireStyles
    </head>
    <body class="font-sans antialiased min-h-screen bg-gray-100">
        <div class="flex">
            <aside class="bg-gray-800 fixed top-0 left-0 w-52 min-h-screen p-2 flex flex-col">
                <nav class="flex flex-col grow">
                    <ul class="flex flex-col grow">
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('dashboard')" 
                                :active="request()->routeIs('dashboard')"
                            >
                            <x-slot name="icon"><x-icons.dashboard class="h-4"/></x-slot>
                            Dashboard</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('users.index')" 
                                :active="request()->routeIs('users.*')"
                            >
                            <x-slot name="icon"><x-icons.user class="h-4"/></x-slot>
                            Users</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('perans')" 
                                :active="request()->routeIs('perans')"
                            >
                            <x-slot name="icon"><x-icons.nametag class="h-4"/></x-slot>
                            Peran</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('pelanggans.index')" 
                                :active="request()->routeIs('pelanggans.*')"
                            >
                            <x-slot name="icon"><x-icons.customer class="h-4"/></x-slot>
                            Pelanggan</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('suku-cadangs.index')" 
                                :active="request()->routeIs('suku-cadangs.*')"
                            >
                            <x-slot name="icon"><x-icons.fan class="h-4"/></x-slot>
                            Suku Cadang</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('jenis-services.index')" 
                                :active="request()->routeIs('jenis-services.*')"
                            >
                            <x-slot name="icon"><x-icons.wrench class="h-4"/></x-slot>
                            Jenis Service</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('pemeriksaan-standars.index')" 
                                :active="request()->routeIs('pemeriksaan-standars.*')"
                            >
                            <x-slot name="icon"><x-icons.magnifying-glass class="h-4"/></x-slot>
                            Pemeriksaan Standar</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('pendaftaran-services.index')" 
                                :active="request()->routeIs('pendaftaran-services.*')"
                            >
                            <x-slot name="icon"><x-icons.form class="h-4"/></x-slot>
                            Pendaftaran Service</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('services.index')" 
                                {{-- :active="request()->routeIs('services.*') || request()->routeIs('faktur-services.*')" --}}
                                :active="request()->routeIs('services.*')"
                            >
                            <x-slot name="icon"><x-icons.gear class="h-4"/></x-slot>
                            Service</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('faktur-services.index')" 
                                :active="request()->routeIs('faktur-services.*')"
                            >
                            <x-slot name="icon"><x-icons.document class="h-4"/></x-slot>
                            Faktur Service</x-sidebar-nav-link>
                        </li>
                        <li class="group">
                            <x-sidebar-nav-link 
                                :href="route('pembayarans.index')" 
                                :active="request()->routeIs('pembayarans.*')"
                            >
                            <x-slot name="icon"><x-icons.money class="h-4"/></x-slot>
                            Pembayaran</x-sidebar-nav-link>
                        </li>
                    </ul>
                    <hr>
                    <div class="mt-4 cursor-pointer">
                        <x-dropdown align="top" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-white hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                    <div class="flex items-center">
                                        <img src="{{ asset(Auth::user()->getPhotoPath()) }}"
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
            <main class="ml-52 w-full overflow-x-hidden">
                {{-- @include('layouts.navigation') --}}
    
                <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="py-6 px-4 sm:px-6 lg:px-8 flex">
                        <div class="grow">
                            {{ $header }}
                        </div>
                        <div>
                            @php
                                $unreadNotifications = Auth::user()->unreadNotifications;
                            @endphp
                            <x-dropdown align="right" width="96">
                                <x-slot name="trigger">
                                    <button class="relative flex items-center hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                        <x-icons.bell class="h-5"/>
                                        <span class="absolute block w-3 h-3 top-0 -right-1 bg-primary rounded-full text-white text-[0.5rem]">
                                            {{ count($unreadNotifications) }}
                                        </span>
                                    </button>
                                </x-slot>
            
                                <x-slot name="content">
                                    @forelse ($unreadNotifications as $notification)
                                    {{-- {{dd(class_basename($notification->type))}} --}}
                                    <x-dropdown-link href="{{ route('notifications.'.class_basename($notification->type), $notification) }}">
                                        <x-notifications.switch :notification="$notification"/>
                                    </x-dropdown-link>
                                    @empty
                                    <x-dropdown-link >
                                        Tidak ada notifikasi
                                    </x-dropdown-link>
                                    @endforelse
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                {{-- Error Bar --}}
                <div 
                    x-data="{ open: {{ session()->exists('error') ? 'true' : 'false' }} }"
                    x-show="open"
                    style="display: none"
                    class="bg-red-500 text-white font-semibold py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center"
                >
                    <span>{{ session('error') }}</span>
                    <x-icons.cross class="h-3 fill-white hover:fill-gray-300 cursor-pointer" x-on:click="open = false"/>
                </div>
                <div class="py-6 px-4 sm:px-6 lg:px-8 overflow-x-hidden">
                    {{ $slot }}
                </div>
            </main>
        </div>
        @livewireScripts
    </body>
</html>
