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
                <x-table.cell>{{ $fakturService->service->pelanggan->nama }}</x-table.cell>
                <x-table.cell>{{ $fakturService->getGrandTotal()}}</x-table.cell>
                {{-- <x-table.cell>
                    @if ($fakturService->isPaid())
                        <x-badge label="Sudah" class="bg-green-400 text-white" />
                    @else
                        <x-badge label="Belum" class="bg-red-600 text-white" />
                    @endif
                </x-table.cell> --}}
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('faktur-services.show', $fakturService->id) }}"    
                    >VIEW</a>
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $fakturService->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $fakturServices->links() }}
    </div>
    
<div>



