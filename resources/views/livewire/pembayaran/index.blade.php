
<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('pembayarans.create') }} ">
            <x-button type="button">Catat Pembayaran</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('service_id')" sortable :sortDir="$sortField === 'service_id' ? $sortDir : null">ID Service</x-table.heading>
            <x-table.heading wire:click="setSort('tanggal')" sortable :sortDir="$sortField === 'tanggal' ? $sortDir : null">Tanggal</x-table.heading>
            <x-table.heading>Jumlah</x-table.heading>
            <x-table.heading wire:click="setSort('tipe_pembayaran')" sortable :sortDir="$sortField === 'tipe_pembayaran' ? $sortDir : null">Tipe Pembayaran</x-table.heading>
            <x-table.heading>Keterangan</x-table.heading>
            <x-table.heading>Bukti</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($pembayarans as $pembayaran)
            <x-table.row>
                <x-table.cell>{{ $pembayaran->service_id }}</x-table.cell>
                <x-table.cell>{{ $pembayaran->tanggal }}</x-table.cell>
                <x-table.cell>{{ $pembayaran->service->getGrandTotal() }}</x-table.cell>
                <x-table.cell class="uppercase text-xs font-bold">{{ $pembayaran->tipe_pembayaran }}</x-table.cell>
                <x-table.cell>{{ $pembayaran->keterangan }}</x-table.cell>
                <x-table.cell>
                    @if ($pembayaran->bukti_pembayaran)
                    <a href="{{asset('storage/'.$pembayaran->bukti_pembayaran)}}">
                        <img src="{{asset('storage/'.$pembayaran->bukti_pembayaran)}}" alt="bukti pembayaran" class="h-16 w-16 object-cover border border-gray-400">
                    </a>
                    @else
                    -
                    @endif
                </x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $pembayaran->service_id }})"
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



