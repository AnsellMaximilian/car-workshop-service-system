
<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('pendaftaran-services.create') }} ">
            <x-button type="button">Daftar Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('waktu_pendaftaran')" sortable :sortDir="$sortField === 'waktu_pendaftaran' ? $sortDir : null">Waktu Daftar</x-table.heading>
            <x-table.heading wire:click="setSort('no_plat')" sortable :sortDir="$sortField === 'no_plat' ? $sortDir : null">No. Plat</x-table.heading>
            <x-table.heading wire:click="setSort('pelanggan_id')" sortable :sortDir="$sortField === 'pelanggan_id' ? $sortDir : null">ID Pelanggan</x-table.heading>
            <x-table.heading wire:click="setSort('keluhan')" sortable :sortDir="$sortField === 'keluhan' ? $sortDir : null">Keluhan</x-table.heading>
            {{-- <x-table.heading wire:click="setSort('alamat')" sortable :sortDir="$sortField === 'alamat' ? $sortDir : null">Alamat</x-table.heading>
            <x-table.heading>Piutang</x-table.heading> --}}
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($pendaftaranServices as $pendaftaranService)
            <x-table.row>
                <x-table.cell>{{ $pendaftaranService->id }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->waktu_pendaftaran }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->no_plat }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->pelanggan_id }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->keluhan }}</x-table.cell>
                {{-- <x-table.cell>{{ $pendaftaranService->alamat }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->getTotalAR() }}</x-table.cell> --}}
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('pendaftaran-services.show', $pendaftaranService->id) }}"    
                    >View</a>
                    {{-- <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('pendaftaran-services.edit', $pendaftaranService->id) }}"    
                    >Edit</a> --}}
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $pendaftaranService->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $pendaftaranServices->links() }}
    </div>
    
<div>



