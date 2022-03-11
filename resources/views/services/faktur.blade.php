<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faktur Service') }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="flex mb-4">
        <div class="ml-auto">
            <x-button onclick="window.print()" overrideBgClasses="bg-gray-800 hover:bg-gray-900 active:bg-gray-900">
                <x-icons.print class="h-5 fill-white inline-block"/>
            </x-button>
        </div>
    </x-card>
    <x-card class="mb-4 relative print-out">
        <div class="mb-4 flex justify-between">
            <div class="">
                <div class="text-2xl font-semibold mb-4">
                    Tangerang, {{ \Carbon\Carbon::parse($service->tanggal_faktur)->format('d-m-Y') }}
                </div>
                <div class="mb-4 grid grid-cols-12">
                    <div class="col-span-6">Kendaraan</div>
                    <div class="font-semibold col-span-6">: {{ $service->kendaraan->getFullName() }}</div>
                </div>
                <div class="mb-4 grid grid-cols-12">
                    <div class="col-span-6">No. Plat</div>
                    <div class="font-semibold col-span-6">: {{ $service->kendaraan->no_plat }}</div>
                </div>
                <div class="mb-4 grid grid-cols-12">
                    <div class="col-span-6">Pemilik</div>
                    <div class="font-semibold col-span-6">: {{ $service->kendaraan->pelanggan->nama }}</div>
                </div>
            </div>
            <div>
                <img src="{{asset('images/sogojayalogo.png')}}" alt="logo" class="ml-auto mb-4">
                <div class="font-semibold">
                    Office: Jl. Teuku Umar, No. 18
                    Cimone, Tangerang
                </div>
            </div>
        </div>
        <div class="text-2xl font-bold">
            Faktur No. {{ $service->id }}
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
                @foreach ($service->penjualan_services as $penjualanService)
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
                <div class="col-span-4 col-start-9 text-xl">{{ $service->getTotalPenjualanServices()}}</div>
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
                @foreach ($service->penggantian_suku_cadangs as $penggantianSukuCadang)
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
                <div class="col-span-4 col-start-9 text-xl">{{ $service->getTotalPenggantianSukuCadangs()}}</div>
            </div>
        </div>
        <hr class="my-4">

        <div class="grid grid-cols-12 py-2 gap-4">
            <div class="col-span-12 border-t-8 border-primary"></div>
            <div class="col-span-4 col-start-5 uppercase font-bold text-xl">Grandtotal</div>
            <div class="col-span-4 col-start-9 text-xl">{{ $service->getGrandTotal()}}</div>
        </div>

    </x-card>

</x-app-layout>

