<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('jenis-services.create') }} ">
            <x-button type="button">Tambah Jenis Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')">ID</x-table.heading>
            <x-table.heading wire:click="setSort('nama')">Nama</x-table.heading>
            <x-table.heading wire:click="setSort('deskripsi')">Deskripsi</x-table.heading>
            <x-table.heading wire:click="setSort('harga')">Harga</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($jenisServices as $jenisService)
            <x-table.row>
                <x-table.cell>{{ $jenisService->id }}</x-table.cell>
                <x-table.cell>{{ $jenisService->nama }}</x-table.cell>
                <x-table.cell>{{ $jenisService->deskripsi }}</x-table.cell>
                <x-table.cell>{{ $jenisService->harga }}</x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('jenis-services.edit', $jenisService->id) }}"    
                    >Edit</a>
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $jenisService->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $jenisServices->links() }}
    </div>
    
<div>



