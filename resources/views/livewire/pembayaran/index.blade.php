
<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('pembayarans.create') }} ">
            <x-button type="button">Catat Pembayaran</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('faktur_service_id')" sortable :sortDir="$sortField === 'faktur_service_id' ? $sortDir : null">No. Faktur</x-table.heading>
            <x-table.heading wire:click="setSort('jumlah')" sortable :sortDir="$sortField === 'jumlah' ? $sortDir : null">Jumlah</x-table.heading>
            <x-table.heading wire:click="setSort('kembali')" sortable :sortDir="$sortField === 'kembali' ? $sortDir : null">Kembali</x-table.heading>
            <x-table.heading>Test</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($pembayarans as $pembayaran)
            <x-table.row>
                <x-table.cell>{{ $pembayaran->id }}</x-table.cell>
                <x-table.cell>{{ $pembayaran->faktur_service_id }}</x-table.cell>
                <x-table.cell>{{ $pembayaran->jumlah }}</x-table.cell>
                <x-table.cell>{{ $pembayaran->kembali }}</x-table.cell>
                <x-table.cell>Tets</x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $pembayaran->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $pembayarans->links() }}
    </div>
    
<div>



