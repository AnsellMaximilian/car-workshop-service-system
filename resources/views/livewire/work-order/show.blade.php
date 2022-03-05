<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Work Order '.$workOrder->id }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('work-orders.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="mb-4">
        {{-- <h1 class="font-semibold mb-4 text-2xl">Detail Suku Cadang</h1> --}}
        @if ($workOrder->dicek && $workOrder->isApprovalPending())
        <div class="flex justify-end items-center gap-4">
            <div class="font-semibold uppercase">
                Mau Diservice?
            </div>
            <div>
                <x-button overrideBgClasses="bg-green-500 hover:bg-green-600" wire:click="markApproveStatus(true)">Mau</x-button>
                <x-button overrideBgClasses="bg-red-500 hover:bg-red-600" wire:click="markApproveStatus(false)">Batal</x-button>
            </div>
        </div>
        <hr class="my-4">
        @endif
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 flex items-start">
                <div class="font-bold uppercase mr-4 text-sm">
                    Tanggal
                </div>
                <div>
                    {{ $workOrder->tanggal }}
                </div>
            </div>
            <div class="col-span-6 flex items-start">
                <div class="font-bold uppercase mr-4 text-sm">
                    Kendaraan
                </div>
                <div>
                    {{ $workOrder->kendaraan->no_plat }}
                </div>
            </div>
            <div class="col-span-6 flex items-start">
                <div class="font-bold uppercase mr-4 text-sm">
                    Pelanggan
                </div>
                <div>
                    {{ $workOrder->kendaraan->pelanggan->nama }}
                </div>
            </div>
            <div class="col-span-6 flex items-start">
                <div class="font-bold uppercase mr-4 text-sm">
                    Status
                </div>
                <div class="flex gap-4">
                    <x-boolean-button
                        class="px-2 rounded text-white font-semibold" trueLabel="Dicek" falseLabel="Dicek"
                        trueClass="bg-green-500 hover:bg-green-600" falseClass="bg-gray-300 hover:bg-gray-400" 
                        :state="$workOrder->dicek" wire:click="markAsChecked"
                    />
                    {{-- <x-boolean-button
                        class="px-2 rounded text-white font-semibold" trueLabel="Disetujui" 
                        falseLabel="{{$workOrder->isServiceCancelled() ? 'Dibatalkan' : 'Disetujui'  }}"
                        trueClass="bg-green-500 hover:bg-green-600" 
                        falseClass="{{$workOrder->isServiceCancelled() ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-300 hover:bg-gray-400'  }}" 
                        :state="$workOrder->mau_diservice" 
                    /> --}}
                    <x-boolean-button
                        class="px-2 rounded text-white font-semibold" trueLabel="Selesai" falseLabel="Selesai"
                        trueClass="bg-green-500 hover:bg-green-600" falseClass="bg-gray-300 hover:bg-gray-400" 
                        :state="$workOrder->service_selesai" 
                    />
                </div>
            </div>

        </div>
        <hr class="my-4">
        @if (!$workOrder->dicek)
        <div>
            Dicek dulu mas... Baru bisa
        </div>
        @else
        {{-- PENJUALAN SERVIS --}}
        <div class="">
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

            <form class="grid grid-cols-12 gap-4 mb-4" wire:submit.prevent="addJenisService">
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
            <div class="grid grid-cols-12 py-2 gap-4">
                <div class="col-span-9 col-start-4 border-t-4 border-primary"></div>
                <div class="col-span-4 col-start-4 uppercase font-bold text-xl">TOTAL SERVICE</div>
                <div class="col-span-5 col-start-8 text-xl">{{ $workOrder->getTotalPenjualanServices()}}</div>
            </div>
        </div>
        <hr class="my-4">
        {{-- SUKU CADANG --}}
        <div>
            <h3 class="font-semibold text-lg uppercase mb-4">Penggantian Suku Cadang</h3>
            <div class="mb-4">
                <div class="border-b-2 border-primary grid grid-cols-12 py-2 font-semibold gap-4">
                    <div class="col-span-3">Suku Cadang</div>
                    <div class="col-span-2">Harga</div>
                    <div class="col-span-2">Jumlah</div>
                    <div class="col-span-3">Subtotal</div>
                    <div class="col-span-2">Aksi</div>
                </div>
                @foreach ($workOrder->penggantian_suku_cadangs as $penggantianSukuCadang)
                    <div class="border-b border-primary grid grid-cols-12 py-2 gap-4">
                        <div class="col-span-3">{{$penggantianSukuCadang->suku_cadang->nama}}</div>
                        <div class="col-span-2">{{$penggantianSukuCadang->harga}}</div>
                        <div class="col-span-2">{{$penggantianSukuCadang->jumlah}}</div>
                        <div class="col-span-3">{{$penggantianSukuCadang->getTotal()}}</div>
                        <div class="col-span-2">
                            <button
                                wire:click="deletePenggantianSukuCadang({{$penggantianSukuCadang->id}})" 
                                class="uppercase text-red-600 hover:text-red-800 font-semibold text-sm">
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <form class="grid grid-cols-12 gap-4" wire:submit.prevent="addSukuCadang">
                <div class="col-span-3">
                    <select
                        wire:model="selectedSukuCadangId"
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                        @foreach ($sukuCadangs as $sukuCadang)
                            <option 
                                value="{{ $sukuCadang->id }}" 
                            >{{ $sukuCadang->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <x-input 
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Harga" disabled :value="$selectedSukuCadang->harga" required />
                </div>
                <div class="col-span-2">
                    <x-input
                        wire:model="sukuCadangAmount"
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Jumlah" required />
                </div>
                <div class="col-span-3">
                    <x-input 
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Subtotal" disabled :value="$selectedSukuCadang->harga * $sukuCadangAmount" required />
                </div>
                <div class="col-span-2 flex items-center justify-end">
                    <x-button class="">
                        {{ __('Tambah') }}
                    </x-button>
                </div>
            </form>
            <div class="grid grid-cols-12 py-2 gap-4">
                <div class="col-span-9 col-start-4 border-t-4 border-primary"></div>
                <div class="col-span-4 col-start-4 uppercase font-bold text-xl">TOTAL SUKU CADANG</div>
                <div class="col-span-5 col-start-8 text-xl">{{ $workOrder->getTotalPenggantianSukuCadangs()}}</div>
            </div>
        </div>
        <hr class="my-4">

        <div class="grid grid-cols-12 py-2 gap-4">
            <div class="col-span-12 border-t-8 border-primary"></div>
            <div class="col-span-4 col-start-4 uppercase font-bold text-xl">Grandtotal</div>
            <div class="col-span-5 col-start-8 text-xl">{{ $workOrder->getGrandTotal()}}</div>
        </div>
        @endif

    </x-card>

</div>
