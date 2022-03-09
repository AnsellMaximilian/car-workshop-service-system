<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
    </div>
    <x-modal :entangled="true" entangleKey="isModalOpen">
        <x-slot name="trigger">
            {{-- <x-button type="button" wire:click="setEditMode('tipe', false)">Tambah Tipe</x-button> --}}
        </x-slot>
        <div>
            <h3 class="font-semibold text-lg uppercase mb-4">
                Edit Peran
            </h3>

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form class="grid grid-cols-12 gap-4" wire:submit.prevent="update">
                @csrf
                <div class="col-span-6">
                    <x-label for="nama_peran" :value="__('Nama Peran')" />
                    <x-input id="nama_peran" class="block mt-1 w-full" type="text" wire:model="nama_peran" :value="old('nama_peran')" required autofocus />
                </div>

                <div class="flex items-center justify-end col-span-12">
                    <x-button class="ml-4">
                        Perbaharui
                    </x-button>
                </div>
            </form>
        </div>
    </x-modal>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('kode_peran')">Kode Peran</x-table.heading>
            <x-table.heading wire:click="setSort('nama_peran')">Nama Peran</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach ($perans as $peran)
            <x-table.row>
                <x-table.cell>{{ $peran->kode_peran }}</x-table.cell>
                <x-table.cell>{{ $peran->nama_peran }}</x-table.cell>
                <x-table.cell class="space-x-2">
                    <span class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        wire:click="edit('{{$peran->kode_peran}}')"
                    >Edit</span>
                    {{-- <span class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer">Delete</span> --}}
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
<div>