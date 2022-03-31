<div>
    <div class="mb-4">
        <x-icon-link href="{{ route('services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <div class="grid grid-cols-12 gap-4">
        <x-card class="col-span-5">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="grid grid-cols-12 gap-4">
                @csrf

                <div class="col-span-12">
                    <span class="block font-medium text-sm text-gray-700">Waktu Mulai</span>
                    <span class="block mt-1">{{now()->format('d/m/Y - H:i:s') }}</span>
                </div>
                <div class="col-span-12">
                    <x-label for="pendaftaran_service_id" value="Pendaftaran Service" />
                    <select 
                        wire:model="selectedPendaftaranServiceId"
                        name="pendaftaran_service_id" 
                        id="pendaftaran_service_id" 
                        class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                        @foreach ($pendaftaranServices as $pendaftaranService)
                            <option 
                                value="{{ $pendaftaranService->id }}" 
                            >{{ $pendaftaranService->id }} ({{$pendaftaranService->no_plat}})</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-center justify-end col-span-12">
                    <x-button class="ml-4" wire:click="save">
                        {{ __('Mulai') }}
                    </x-button>
                </div>
            </div>
        </x-card>

        <x-card class="col-span-7">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6">
                    <span class="font-semibold">Waktu Daftar</span>
                    <span class="block mt-1">{{\Carbon\Carbon::parse($selectedPendaftaranService->waktu_pendaftaran)->format('d/m/Y - H:i:s') }}</span>
                </div>
    
                <div class="col-span-6">
                    <div class="font-semibold">Pelanggan</div>
                    <div>{{$selectedPendaftaranService->pelanggan->nama}}</div>
                </div>
    
                <div class="col-span-6">
                    <div class="font-semibold">No. Plat</div>
                    <div>{{$selectedPendaftaranService->no_plat}}</div>
                </div>
    
                <div class="col-span-6">
                    <div class="font-semibold">Keluhan</div>
                    <div>{{$selectedPendaftaranService->keluhan}}</div>
                </div>

                <div class="col-span-6">
                    <div class="font-semibold">Total Perkiraan</div>
                    <div>{{ $selectedPendaftaranService->getTotalPerkiraan()}}</div>
                </div>

            </div>
            
        </x-card>
        <x-card class="col-span-12">
            <h2 class="font-semibold mb-4 text-xl">Perkiraan Service</h2>
            <x-table.wrapper>
                <x-slot name="head">
                    <x-table.heading class="bg-primary text-white">Jenis Service</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Harga</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Jumlah</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Subtotal</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($selectedPendaftaranService->perkiraan_penjualan_services as $perkiraanPenjualanService)
                    <x-table.row>
                        <x-table.cell>{{ $perkiraanPenjualanService->jenis_service->nama }}</x-table.cell>
                        <x-table.cell>{{ $perkiraanPenjualanService->harga }}</x-table.cell>
                        <x-table.cell>{{ $perkiraanPenjualanService->jumlah }}</x-table.cell>
                        <x-table.cell>{{ $perkiraanPenjualanService->getTotal() }}</x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table.wrapper>
        </x-card>
        <x-card class="col-span-12">
            <h2 class="font-semibold mb-4 text-xl">Perkiraan Penggantian</h2>
            <x-table.wrapper>
                <x-slot name="head">
                    <x-table.heading class="bg-primary text-white">Suku Cadang</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Harga</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Jumlah</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Subtotal</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($selectedPendaftaranService->perkiraan_suku_cadangs as $perkiraanSukuCadang)
                    <x-table.row>
                        <x-table.cell>{{ $perkiraanSukuCadang->suku_cadang->nama }}</x-table.cell>
                        <x-table.cell>{{ $perkiraanSukuCadang->harga }}</x-table.cell>
                        <x-table.cell>{{ $perkiraanSukuCadang->jumlah }}</x-table.cell>
                        <x-table.cell>{{ $perkiraanSukuCadang->getTotal() }}</x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table.wrapper>
        </x-card>
    </div>
</div>
