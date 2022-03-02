<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kendaraan '.$kendaraan->no_plat) }}
        </h2>
    </x-slot>

    <livewire:kendaraan.edit :kendaraan="$kendaraan"/>
    
</x-app-layout>
