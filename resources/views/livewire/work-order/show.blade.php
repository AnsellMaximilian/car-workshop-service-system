<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Work Order '.$workOrder->id }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('suku-cadangs.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card>
        {{-- <h1 class="font-semibold mb-4 text-2xl">Detail Suku Cadang</h1> --}}
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 flex items-center">
                <div class="font-bold uppercase mr-4 text-sm">
                    Tanggal
                </div>
                <div>
                    {{ $workOrder->tanggal }}
                </div>
            </div>
            <div class="col-span-6 flex items-center">
                <div class="font-bold uppercase mr-4 text-sm">
                    Kendaraan
                </div>
                <div>
                    {{ $workOrder->kendaraan->no_plat }}
                </div>
            </div>
            <div class="col-span-6 flex items-center">
                <div class="font-bold uppercase mr-4 text-sm">
                    Pelanggan
                </div>
                <div>
                    {{ $workOrder->kendaraan->pelanggan->nama }}
                </div>
            </div>
            <div class="col-span-6 flex items-center">
                <div class="font-bold uppercase mr-4 text-sm">
                    Dicek
                </div>
                <div
                    @if(!$workOrder->dicek) wire:click="markAsChecked"  @endif
                    class="cursor-pointer px-2 rounded text-white font-semibold {{ $workOrder->dicek ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}">
                    {{ $workOrder->dicek ? 'Sudah' : 'Belum' }}
                </div>
            </div>

        </div>
        <hr class="my-4">
        @if (!$workOrder->dicek)
        <div>
            Dicek dulu mas... Baru bisa
        </div>
        @endif

        <div>
            <h3>Penjualan Servis</h3>
            <div>
                
            </div>
        </div>
    </x-card>

</div>

