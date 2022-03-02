<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peran') }}
        </h2>
    </x-slot>

    <div class="space-y-2">
        <x-table.wrapper>
            <x-slot name="head">
                <x-table.heading>Kode Peran</x-table.heading>
                <x-table.heading>Nama Peran</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
    
            </x-slot>
            <x-slot name="body">
                @foreach ($perans as $peran)
                <x-table.row>
                    <x-table.cell>{{ $peran->kode_peran }}</x-table.cell>
                    <x-table.cell>{{ $peran->nama_peran }}</x-table.cell>
                    <x-table.cell class="space-x-2">
                        <span class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer">Edit</span>
                        <span class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer">Delete</span>
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
    
        </x-table.wrapper>
    <div>
</x-app-layout>

