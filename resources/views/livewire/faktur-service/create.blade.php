<div>
    <div class="mb-4">
        <x-icon-link href="{{ route('faktur-services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>

    <div class="flex items-center justify-end mb-4">
        <x-button class="ml-4 shadow-lg" wire:click="saveFakturService">
            {{ __('Buat Faktur Service') }}
        </x-button>
    </div>
    
    <x-card class="mb-4 relative">
        <div class="">
            <img src="{{asset('images/sogojayalogo.png')}}" alt="logo" class="ml-auto">
        </div>
        <hr class="my-4">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 grid grid-cols-12">
                <div class="font-bold uppercase mr-4 text-sm col-span-4">
                    Work Order
                </div>
                <div class="col-span-8">
                    <select 
                        wire:model="selectedWorkOrderId"
                        name="selectedWorkOrderId" 
                        id="selectedWorkOrderId" 
                        class="w-32 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                        @foreach ($workOrders as $workOrder)
                            <option 
                                value="{{ $workOrder->id }}" 
                                {{ old('selectedWorkOrderId') === $workOrder->id  ? 'selected' : '' }}
                            >{{ $workOrder->id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-6"></div>
            <div class="col-span-6 grid grid-cols-12">
                <div class="font-bold uppercase mr-4 text-sm col-span-4">
                    Tanggal
                </div>
                <div class="col-span-8">
                    {{ now()->format('d/m/Y') }}
                </div>
            </div>
            <div class="col-span-6 grid grid-cols-12">
                <div class="font-bold uppercase mr-4 text-sm col-span-4">
                    Kendaraan
                </div>
                <div class="col-span-8">
                    {{ $selectedWorkOrder->kendaraan->no_plat }}
                </div>
            </div>
            <div class="col-span-6 grid grid-cols-12">
                <div class="font-bold uppercase mr-4 text-sm col-span-4">
                    Pelanggan
                </div>
                <div class="col-span-8">
                    {{ $selectedWorkOrder->kendaraan->pelanggan->nama }}
                </div>
            </div>

        </div>
        <hr class="my-4">
        {{-- PENJUALAN SERVIS --}}
        <div class="">
            <h3 class="font-semibold text-lg uppercase mb-4">Penjualan Servis</h3>
            
            <div class="mb-4">
                <div class="border-b-2 border-primary grid grid-cols-12 py-2 font-semibold gap-4">
                    <div class="col-span-4">Jenis Service</div>
                    <div class="col-span-2">Harga</div>
                    <div class="col-span-2">Jumlah</div>
                    <div class="col-span-4">Subtotal</div>
                </div>
                @foreach ($selectedWorkOrder->penjualan_services as $penjualanService)
                    <div class="border-b border-primary grid grid-cols-12 py-2 gap-4">
                        <div class="col-span-4">{{$penjualanService->jenis_service->nama}}</div>
                        <div class="col-span-2">{{$penjualanService->harga}}</div>
                        <div class="col-span-2">{{$penjualanService->jumlah}}</div>
                        <div class="col-span-4">{{$penjualanService->getTotal()}}</div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-12 py-2 gap-4">
                <div class="col-span-9 col-start-5 border-t-4 border-primary"></div>
                <div class="col-span-4 col-start-5 uppercase font-bold text-xl">TOTAL SERVICE</div>
                <div class="col-span-4 col-start-9 text-xl">{{ $selectedWorkOrder->getTotalPenjualanServices()}}</div>
            </div>
        </div>
        <hr class="my-4">
        {{-- SUKU CADANG --}}
        <div>
            <h3 class="font-semibold text-lg uppercase mb-4">Penggantian Suku Cadang</h3>
            <div class="mb-4">
                <div class="border-b-2 border-primary grid grid-cols-12 py-2 font-semibold gap-4">
                    <div class="col-span-4">Suku Cadang</div>
                    <div class="col-span-2">Harga</div>
                    <div class="col-span-2">Jumlah</div>
                    <div class="col-span-4">Subtotal</div>
                </div>
                @foreach ($selectedWorkOrder->penggantian_suku_cadangs as $penggantianSukuCadang)
                    <div class="border-b border-primary grid grid-cols-12 py-2 gap-4">
                        <div class="col-span-4">{{$penggantianSukuCadang->suku_cadang->nama}}</div>
                        <div class="col-span-2">{{$penggantianSukuCadang->harga}}</div>
                        <div class="col-span-2">{{$penggantianSukuCadang->jumlah}}</div>
                        <div class="col-span-4">{{$penggantianSukuCadang->getTotal()}}</div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-12 py-2 gap-4">
                <div class="col-span-9 col-start-5 border-t-4 border-primary"></div>
                <div class="col-span-4 col-start-5 uppercase font-bold text-xl">TOTAL SUKU CADANG</div>
                <div class="col-span-4 col-start-9 text-xl">{{ $selectedWorkOrder->getTotalPenggantianSukuCadangs()}}</div>
            </div>
        </div>
        <hr class="my-4">

        <div class="grid grid-cols-12 py-2 gap-4">
            <div class="col-span-12 border-t-8 border-primary"></div>
            <div class="col-span-4 col-start-5 uppercase font-bold text-xl">Grandtotal</div>
            <div class="col-span-4 col-start-9 text-xl">{{ $selectedWorkOrder->getGrandTotal()}}</div>
        </div>

    </x-card>

</div>

