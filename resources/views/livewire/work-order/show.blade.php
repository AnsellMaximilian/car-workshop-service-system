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
    <x-card class="mb-4">
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
        @else
        <div>
            <h3 class="font-semibold text-lg uppercase mb-4">Penjualan Servis</h3>
            
            <div class="mb-4">
                <div class="border-b-2 border-primary grid grid-cols-12 py-2 font-semibold gap-4">
                    <div class="col-span-3">Jenis Service</div>
                    <div class="col-span-2">Harga</div>
                    <div class="col-span-2">Jumlah</div>
                    <div class="col-span-3">Subtotal</div>
                    <div class="col-span-2">Aksi</div>
                </div>
                @foreach ($workOrder->penjualan_services as $penjualanService)
                    <div class="border-b border-primary grid grid-cols-12 py-2 gap-4">
                        <div class="col-span-3">{{$penjualanService->jenis_service->nama}}</div>
                        <div class="col-span-2">{{$penjualanService->harga}}</div>
                        <div class="col-span-2">{{$penjualanService->jumlah}}</div>
                        <div class="col-span-3">{{$penjualanService->getTotal()}}</div>
                        <div class="col-span-2">
                            <button
                                wire:click="deletePenjualanService({{$penjualanService->id}})" 
                                class="uppercase text-red-600 hover:text-red-800 font-semibold text-sm">
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form class="grid grid-cols-12 gap-4" wire:submit.prevent="addJenisService">
                <div class="col-span-3">
                    <select
                        wire:model="selectedJenisServiceId"
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                        @foreach ($jenisServices as $jenisService)
                            <option 
                                value="{{ $jenisService->id }}" 
                            >{{ $jenisService->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <x-input 
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Harga" disabled :value="$selectedJenisService->harga" required />
                </div>
                <div class="col-span-2">
                    <x-input
                        wire:model="jenisServiceAmount"
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Jumlah" required />
                </div>
                <div class="col-span-3">
                    <x-input 
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Subtotal" disabled :value="$selectedJenisService->harga * $jenisServiceAmount" required />
                </div>
                <div class="col-span-2 flex items-center justify-end">
                    <x-button class="">
                        {{ __('Tambah') }}
                    </x-button>
                </div>
            </form>
        </div>
        @endif

    </x-card>

</div>

