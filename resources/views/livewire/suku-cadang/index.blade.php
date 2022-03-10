<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('suku-cadangs.create') }} ">
            <x-button type="button">Tambah Suku Cadang</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('nama')" sortable :sortDir="$sortField === 'nama' ? $sortDir : null">Nama</x-table.heading>
            <x-table.heading wire:click="setSort('harga')" sortable :sortDir="$sortField === 'harga' ? $sortDir : null">Harga</x-table.heading>
            <x-table.heading>Stok</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($sukuCadangs as $sukuCadang)
            <x-table.row>
                <x-table.cell>{{ $sukuCadang->id }}</x-table.cell>
                <x-table.cell>{{ $sukuCadang->nama }}</x-table.cell>
                <x-table.cell>{{ $sukuCadang->harga }}</x-table.cell>
                <x-table.cell>{{ $sukuCadang->current_stock }}</x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('suku-cadangs.show', $sukuCadang->id) }}"    
                    >Detail</a>
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('suku-cadangs.edit', $sukuCadang->id) }}"    
                    >Edit</a>
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $sukuCadang->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $sukuCadangs->links() }}
    </div>
    
<div>



