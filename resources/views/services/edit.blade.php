<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengelolaan Service') }}
        </h2>
    </x-slot>

    <livewire:service.edit :service="$service"/>
    
</x-app-layout>
