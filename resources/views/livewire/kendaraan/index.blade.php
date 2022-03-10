<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <div>
            <a href="{{ route('merks-dan-tipes') }} ">
                <x-button type="button" overrideBgClasses="bg-gray-600 hover:bg-gray-700 active:bg-gray-900">Merk dan Tipe</x-button>
            </a>
            <a href="{{ route('kendaraans.create') }} ">
                <x-button type="button">Tambah Kendaraan</x-button>
            </a>
        </div>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('no_plat')" sortable :sortDir="$sortField === 'no_plat' ? $sortDir : null">No. Plat</x-table.heading>
            <x-table.heading wire:click="setSort('pelanggan_id')" sortable :sortDir="$sortField === 'pelanggan_id' ? $sortDir : null">ID Pemilik</x-table.heading>
            <x-table.heading wire:click="setSort('tipe_id')" sortable :sortDir="$sortField === 'tipe_id' ? $sortDir : null">ID Tipe</x-table.heading>
            <x-table.heading wire:click="setSort('warna')" sortable :sortDir="$sortField === 'warna' ? $sortDir : null">Warna</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($kendaraans as $kendaraan)
            <x-table.row>
                <x-table.cell>{{ $kendaraan->id }}</x-table.cell>
                <x-table.cell>{{ $kendaraan->no_plat }}</x-table.cell>
                <x-table.cell class="relative group cursor-pointer">
                    {{ $kendaraan->pelanggan_id }}
                    <x-tooltip class="bg-primary text-white w-max" align="left">
                        {{ $kendaraan->pelanggan->nama }}
                    </x-tooltip>
                </x-table.cell>
                <x-table.cell class="relative group cursor-pointer">
                    {{ $kendaraan->tipe_id }}
                    <x-tooltip class="bg-primary text-white w-max" align="left">
                        {{ $kendaraan->tipe->tipe }}
                    </x-tooltip>
                </x-table.cell>
                <x-table.cell>{{ $kendaraan->warna }}</x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('kendaraans.edit', $kendaraan->id) }}"    
                    >Edit</a>
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $kendaraan->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $kendaraans->links() }}
    </div>
    
<div>