<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('faktur-services.create') }} ">
            <x-button type="button">Buat Faktur Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('tanggal')" sortable :sortDir="$sortField === 'tanggal' ? $sortDir : null">Tanggal</x-table.heading>
            <x-table.heading>Pelanggan</x-table.heading>
            <x-table.heading>Total</x-table.heading>
            {{-- <x-table.heading>Pembayaran</x-table.heading> --}}
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($fakturServices as $fakturService)
            <x-table.row>
                <x-table.cell>{{ $fakturService->id }}</x-table.cell>
                <x-table.cell>{{ $fakturService->tanggal }}</x-table.cell>
                <x-table.cell>{{ $fakturService->service->pendaftaran_service->pelanggan->nama }}</x-table.cell>
                <x-table.cell>{{ $fakturService->getGrandTotal()}}</x-table.cell>
                {{-- <x-table.cell>
                    @if ($fakturService->isPaid())
                        <x-badge label="Sudah" class="bg-green-400 text-white" />
                    @else
                        <x-badge label="Belum" class="bg-red-600 text-white" />
                    @endif
                </x-table.cell> --}}
                <x-table.cell class="space-x-2 flex">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-white hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                <x-icons.more class="h-4"/>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-dropdown-link class="flex items-center gap-3"
                                href="{{ route('faktur-services.show', $fakturService->id) }}"    
                            ><x-icons.eye class="h-4"/> <span>Lihat</span></x-dropdown-link>
                            <form class="" action="{{route('faktur-services.destroy', $fakturService->id)}}" method="POST">
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
        {{ $fakturServices->links() }}
    </div>
    
<div>



