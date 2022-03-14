<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Pelanggan '.$pelanggan->id }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('pelanggans.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="mb-8">
        <div class="font-bold text-2xl mb-4">
            {{ $pelanggan->nama }}
        </div>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6">
                <div class="font-bold">
                    No. Telp
                </div>
                <div>
                    {{ $pelanggan->noTelp }}
                </div>
            </div>

            <div class="col-span-6">
                <div class="font-bold">
                    Email
                </div>
                <div>
                    {{ $pelanggan->email }}
                </div>
            </div>
            <div class="col-span-6">
                <div class="font-bold">
                    Alamat
                </div>
                <div>
                    {{ $pelanggan->alamat }}
                </div>
            </div>

            <div class="col-span-6">
                <div class="font-bold">
                    Piutang
                </div>
                <div>
                    {{ $pelanggan->getTotalAR() }}
                </div>
            </div>
            
        </div>
    </x-card>

    <div>
        <h2 class="text-2xl font-bold mb-4">Transaksi Service</h2>
        <x-table.wrapper>
            <x-slot name="head">
                <x-table.heading >ID</x-table.heading>
                <x-table.heading >Tanggal Daftar</x-table.heading>
                <x-table.heading >No. Plat</x-table.heading>
                <x-table.heading>Total</x-table.heading>
                <x-table.heading >Dibayar</x-table.heading>
                <x-table.heading >Sisa</x-table.heading>
    
            </x-slot>
            <x-slot name="body">
                @foreach ($pelanggan->services as $service)
                <x-table.row>
                    <x-table.cell>{{ $service->id }}</x-table.cell>
                    <x-table.cell>{{ $service->tanggal }}</x-table.cell>
                    <x-table.cell>{{ $service->no_plat }}</x-table.cell>
                    <x-table.cell>{{ $service->getGrandTotal() }}</x-table.cell>
                    <x-table.cell>{{ $service->invoiced() ? $service->faktur_service->getTotalPembayaran() : 'Faktur belum dibuat' }}</x-table.cell>
                    <x-table.cell>{{ $service->invoiced() ? $service->faktur_service->getAmountToBePaid() : 'Faktur belum dibuat' }}</x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
    
        </x-table.wrapper>
    </div>

</div>

