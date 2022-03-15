<div>
    <div class="flex flex-wrap gap-4 mb-8">
        <x-dashboard-module label="Pending" :value="$approvalPendingAmount" class="bg-white" >
            <x-slot name="icon">
                <x-icons.checkmarked-clipboard class="h-6"/>
            </x-slot>
            <x-slot name="actions">
                <a href="/" class="text-primary font-semibold hover:text-red-600 hover:bg-gray-100 block px-4 py-2">Lihat</a>
            </x-slot>
        </x-dashboard-module>
        <x-dashboard-module label="Suku Cadang" :value="$totalSukuCadang" class="bg-white" >
            <x-slot name="icon">
                <x-icons.checkmarked-clipboard class="h-6"/>
            </x-slot>
            <x-slot name="actions">
                <a href="{{ route('suku-cadangs.index') }}" class="text-primary font-semibold hover:text-red-600 hover:bg-gray-100 block px-4 py-2">Lihat</a>
            </x-slot>
        </x-dashboard-module>
        <x-dashboard-module label="Pelanggan" :value="$totalPelanggan" class="bg-white" >
            <x-slot name="icon">
                <x-icons.checkmarked-clipboard class="h-6"/>
            </x-slot>
            <x-slot name="actions">
                <a href="{{ route('pelanggans.index') }}" class="text-primary font-semibold hover:text-red-600 hover:bg-gray-100 block px-4 py-2">Lihat</a>
            </x-slot>
        </x-dashboard-module>
        {{-- <x-dashboard-module label="User" :value="$totalUser" class="bg-white" >
            <x-slot name="icon">
                <x-icons.checkmarked-clipboard class="h-6"/>
            </x-slot>
            <x-slot name="actions">
                <a href="/" class="text-primary font-semibold hover:text-red-600 hover:bg-gray-100 block px-4 py-2">Lihat</a>
            </x-slot>
        </x-dashboard-module> --}}
    </div>

    <div class="flex flex-wrap gap-4 mb-8">
        <div class="bg-primary p-4 shadow-lg rounded-lg text-white h-48 grow">
            <div class="text-3xl font-bold mb-4">{{$totalSales}}</div>
            <div class="text-xl font-semibold">Total Penjualan Service</div>
        </div>
        <div class="bg-primary p-4 shadow-lg rounded-lg text-white h-48 grow">
            <div class="text-3xl font-bold mb-4">{{$totalSalesToday}}</div>
            <div class="text-xl font-semibold">Total Penjualan Service Hari Ini</div>
        </div>
    </div>
    <div class="print-out">
        <x-print-header class="only-print"/>
        <h2 class="text-xl font-semibold mb-4 print-out__hide">Laporan Penjualan Service</h2>
        <h2 class="text-3xl font-bold mb-4 only-print text-center">Laporan Penjualan Service</h2>
        <div class="only-print mb-4 text-center">
            {{ \Carbon\Carbon::parse($reportStartDate)->format('d-m-Y') }} sampai {{ \Carbon\Carbon::parse($reportEndDate)->format('d-m-Y') }}
        </div>
        <div class="flex mb-4 items-end print-out__hide">
            <div class="mr-4">
                <x-label value="Mulai" for="reportStartDate" />
                <x-input type="date" id="reportStartDate" class="mt-1 block" wire:model="reportStartDate"/>
            </div>
            <div>
                <x-label value="Sampai" for="reportEndDate" />
                <x-input type="date" id="reportEndDate" class="mt-1 block" wire:model="reportEndDate"/>
            </div>
            <div class="ml-auto">
                <x-button onclick="window.print()">Print</x-button>
            </div>
        </div>
        <x-table.wrapper>
            <x-slot name="head">
                <x-table.heading >ID</x-table.heading>
                <x-table.heading >Tanggal Daftar</x-table.heading>
                <x-table.heading >No. Plat</x-table.heading>
                <x-table.heading >Pelanggan</x-table.heading>
                <x-table.heading>Total</x-table.heading>
    
            </x-slot>
            <x-slot name="body">
                @foreach ($reportServices as $service)
                <x-table.row>
                    <x-table.cell>{{ $service->id }}</x-table.cell>
                    <x-table.cell>{{ $service->tanggal }}</x-table.cell>
                    <x-table.cell>{{ $service->no_plat }}</x-table.cell>
                    <x-table.cell>{{ $service->pelanggan->nama }}</x-table.cell>
                    <x-table.cell>{{ $service->getGrandTotal() }}</x-table.cell>
                </x-table.row>
                @endforeach
                <x-table.row class="font-bold uppercase">
                    <x-table.cell colspan="4" class="text-right">Total</x-table.cell>
                    <x-table.cell>{{ $reportServices->reduce(function($total, $service){
                        return $total + $service->getGrandTotal();
                    }, 0) }}</x-table.cell>
                </x-table.row>
            </x-slot>
    
        </x-table.wrapper>
    </div>
</div>
