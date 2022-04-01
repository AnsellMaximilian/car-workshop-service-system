<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Service ').$pendaftaranService->id }}
        </h2>
    </x-slot>

    <div class="mb-4">
        <x-icon-link href="{{ route('pendaftaran-services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    
    <div class="grid grid-cols-12 gap-4">
        <x-card class="col-span-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <div class="font-semibold">Waktu Pendaftaran</div>
                    <div>{{ \Carbon\Carbon::parse($pendaftaranService->waktu_pendaftaran)->format('d/m/Y - H:i:s')}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Pelanggan</div>
                    <div>{{$pendaftaranService->pelanggan->nama}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">No. Plat</div>
                    <div>{{$pendaftaranService->no_plat}}</div>
                </div>
                <div class="col-span-12">
                    <div class="font-semibold">Keluhan</div>
                    <div>{{$pendaftaranService->keluhan}}</div>
                </div>
            </div>
        </x-card>
        <x-card class="col-span-4 flex flex-col">
            <div class="flex justify-between">
                <div class="font-semibold">Service</div>
                <div>{{ $pendaftaranService->getTotalPerkiraanPenjualanServices()}}</div>
            </div>
            <div class="flex justify-between">
                <div class="font-semibold">Suku Cadang</div>
                <div>{{ $pendaftaranService->getTotalPerkiraanSukuCadangs()}}</div>
            </div>

            <div class="flex justify-between mt-4">
                <div class="font-bold uppercase">Total Perkiraan</div>
                <div>{{$pendaftaranService->getTotalPerkiraan()}}</div>
            </div>
            <div class="flex items-center justify-end mt-auto">
                <a href="{{route('pendaftaran-services.index')}}">
                    <x-button class="ml-4" overrideBgClasses="bg-gray-700 hover:bg-gray-800">
                        {{ __('Hapus') }}
                    </x-button>
                </a>
                @if ($pendaftaranService->isContinued())
                    <a href="{{route('services.show', $pendaftaranService->service->id)}}">
                        <x-button class="ml-4" >
                            {{ __('Service') }}
                        </x-button>
                    </a>
                @else
                <form action="{{route('services.store')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$pendaftaranService->id}}" name="pendaftaran_service_id">
                    <x-button class="ml-4" >
                        {{ __('Service') }}
                    </x-button>
                </form>
                @endif
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
                    @foreach ($pendaftaranService->perkiraan_penjualan_services as $perkiraanPenjualanService)
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
                    @foreach ($pendaftaranService->perkiraan_suku_cadangs as $perkiraanSukuCadang)
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
</x-app-layout>