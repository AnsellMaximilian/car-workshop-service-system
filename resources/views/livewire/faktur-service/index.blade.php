<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('faktur-services.create') }} ">
            <x-button type="button">Buat Faktur Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')">ID</x-table.heading>
            <x-table.heading wire:click="setSort('tanggal')">Tanggal</x-table.heading>
            <x-table.heading>Pelanggan</x-table.heading>
            <x-table.heading>Total</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($fakturServices as $fakturService)
            <x-table.row>
                <x-table.cell>{{ $fakturService->id }}</x-table.cell>
                <x-table.cell>{{ $fakturService->tanggal }}</x-table.cell>
                <x-table.cell>Johnny Guitar</x-table.cell>
                <x-table.cell>400000</x-table.cell>
                <x-table.cell>
                    {{-- @if ($fakturService->isServiceCancelled())
                        <x-badge label="Batal" class="bg-red-600 text-white" />
                    @else
                        @if ($fakturService->service_selesai)
                        <x-badge label="Selesai" class="bg-green-400 text-white" />
                        @else
                            @if ($fakturService->dicek)
                            <x-badge label="Dicek" class="bg-green-400 text-white" />
                            @else
                            <x-badge label="Dicek" class="bg-gray-400 text-white" />
                            @endif
                            <x-badge label="Selesai" class="bg-gray-400 text-white" />
                        @endif
                    @endif --}}
                    Paid
                </x-table.cell>
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


