<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('services.create') }} ">
            <x-button type="button">Daftar Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('tanggal')" sortable :sortDir="$sortField === 'tanggal' ? $sortDir : null">Tanggal Daftar</x-table.heading>
            <x-table.heading wire:click="setSort('kendaraan_id')" sortable :sortDir="$sortField === 'kendaraan_id' ? $sortDir : null">No. Plat</x-table.heading>
            <x-table.heading wire:click="setSort('keluhan')" sortable :sortDir="$sortField === 'keluhan' ? $sortDir : null">Keluhan</x-table.heading>
            <x-table.heading>Total</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($services as $service)
            <x-table.row>
                <x-table.cell>{{ $service->id }}</x-table.cell>
                <x-table.cell>{{ $service->tanggal }}</x-table.cell>
                <x-table.cell>{{ $service->no_plat }}</x-table.cell>
                <x-table.cell>{{ $service->keluhan }}</x-table.cell>
                <x-table.cell>{{ $service->getGrandTotal() }}</x-table.cell>
                <x-table.cell>
                    @if ($service->isApprovalPending())
                        <x-badge label="Menunggu" class="text-white bg-gray-500" />
                    @else
                        @if ($service->isServiceCancelled())
                        <x-badge label="Batal" class="text-white bg-red-600" />
                        @else
                            @if ($service->invoiced())
                            <x-badge label="Selesai" class="bg-green-400 text-white" />
                            @else
                            <x-badge label="Siap Difaktur" class="bg-yellow-400 text-white" />
                            @endif
                        @endif
                    @endif
                </x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('services.show', $service->id) }}"    
                    >VIEW</a>
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $service->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $services->links() }}
    </div>
    
<div>



