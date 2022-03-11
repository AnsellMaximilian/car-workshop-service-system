<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <x-card class="mb-8 bg-primary text-white">
        Selamat datang, {{Auth::user()->name}}!
    </x-card> --}}

    <livewire:dashboard/>
</x-app-layout>
