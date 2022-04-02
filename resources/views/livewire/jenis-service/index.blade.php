<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('jenis-services.create') }} ">
            <x-button type="button">Tambah Jenis Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('nama')" sortable :sortDir="$sortField === 'nama' ? $sortDir : null">Nama</x-table.heading>
            <x-table.heading wire:click="setSort('deskripsi')" sortable :sortDir="$sortField === 'deskripsi' ? $sortDir : null">Deskripsi</x-table.heading>
            <x-table.heading wire:click="setSort('harga')" sortable :sortDir="$sortField === 'harga' ? $sortDir : null">Harga</x-table.heading>
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
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-white hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                <x-icons.more class="h-4"/>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-dropdown-link class="flex items-center gap-3"
                                href="{{ route('jenis-services.edit', $jenisService->id) }}"    
                            ><x-icons.edit class="h-4"/> <span>Edit</span></x-dropdown-link>
                            <form class="" action="{{route('jenis-services.destroy', $jenisService->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="with-del-conf w-full flex items-center gap-3 px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" type="submit"
                                ><x-icons.trash class="h-4"/> <span>Hapus</span></button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $jenisServices->links() }}
    </div>
    
<div>



