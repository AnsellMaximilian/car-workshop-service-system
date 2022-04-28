<div>
    <div class="flex flex-wrap gap-4 mb-8">
        <x-dashboard-module label="Pendaftaran" sublabel="Service Siap Dimulai" :value="$totalPendaftaranPending" class="bg-white" >
            <x-slot name="icon">
                <x-icons.form class="h-8"/>
            </x-slot>
            <x-slot name="actions">
                <a href="{{route('pendaftaran-services.index')}}" class="text-primary font-semibold hover:text-red-600 hover:bg-gray-100 block px-4 py-2">Lihat</a>
            </x-slot>
        </x-dashboard-module>
        <x-dashboard-module label="Approval" sublabel="Persetujuan Diperlukan" :value="$totalApprovalPending" class="bg-white" >
            <x-slot name="icon">
                <x-icons.checkmarked-clipboard class="h-8"/>
            </x-slot>
            <x-slot name="actions">
                <a href="{{ route('services.index') }}" class="text-primary font-semibold hover:text-red-600 hover:bg-gray-100 block px-4 py-2">Lihat</a>
            </x-slot>
        </x-dashboard-module>
        <x-dashboard-module label="Pembayaran" sublabel="Pembayaran Belum Lunas" :value="$totalPembayaranPending" class="bg-white" >
            <x-slot name="icon">
                <x-icons.money class="h-8"/>
            </x-slot>
            <x-slot name="actions">
                <a href="{{ route('services.index') }}" class="text-primary font-semibold hover:text-red-600 hover:bg-gray-100 block px-4 py-2">Lihat</a>
            </x-slot>
        </x-dashboard-module>
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

    <div class="max-w-md mb-4">
        <h3 class="text-xl font-semibold mb-2">Penjualan Tahun {{now()->year}}</h3>
        <canvas id="chartPenjualan" width="400" height="400"></canvas>
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
                <x-table.heading >Waktu Service</x-table.heading>
                <x-table.heading >No. Plat</x-table.heading>
                <x-table.heading >Pelanggan</x-table.heading>
                <x-table.heading>Total</x-table.heading>
    
            </x-slot>
            <x-slot name="body">
                @foreach ($reportServices as $service)
                <x-table.row>
                    <x-table.cell>{{ $service->id }}</x-table.cell>
                    <x-table.cell>{{ $service->waktu_mulai }}</x-table.cell>
                    <x-table.cell>{{ $service->pendaftaran_service->no_plat }}</x-table.cell>
                    <x-table.cell>{{ $service->pendaftaran_service->pelanggan->nama }}</x-table.cell>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const ctx = document.getElementById('chartPenjualan').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Total Penjualan',
                    data: JSON.parse('{!! json_encode($chartData) !!}'),
                    backgroundColor: '#b51919'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
