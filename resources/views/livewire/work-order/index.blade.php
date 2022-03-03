<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('work-orders.create') }} ">
            <x-button type="button">Buat Work Order</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')">ID</x-table.heading>
            <x-table.heading wire:click="setSort('tanggal')">Tanggal</x-table.heading>
            <x-table.heading wire:click="setSort('kendaraan_id')">ID Kendaraan</x-table.heading>
            <x-table.heading wire:click="setSort('keluhan')">Keluhan</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($workOrders as $workOrder)
            <x-table.row>
                <x-table.cell>{{ $workOrder->id }}</x-table.cell>
                <x-table.cell>{{ $workOrder->tanggal }}</x-table.cell>
                <x-table.cell>{{ $workOrder->kendaraan_id }}</x-table.cell>
                <x-table.cell>{{ $workOrder->keluhan }}</x-table.cell>
                <x-table.cell>
                    <span>{{ $workOrder->dicek ? 'Dicek' : 'Belum Dicek'}}</span>
                </x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('work-orders.show', $workOrder->id) }}"    
                    >VIEW</a>
                    {{-- <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('work-orders.edit', $workOrder->id) }}"    
                    >Edit</a> --}}
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $workOrder->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $workOrders->links() }}
    </div>
    
<div>



