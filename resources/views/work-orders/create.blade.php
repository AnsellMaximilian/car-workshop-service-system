<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Work Order') }}
        </h2>
    </x-slot>
    <livewire:work-order.create />
    
</x-app-layout>
