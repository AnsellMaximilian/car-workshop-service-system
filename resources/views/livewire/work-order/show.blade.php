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
    @if ($workOrder->dicek)
    <x-card class="mb-4 relative">
        @if($workOrder->isServiceCancelled())<x-obscurer/>@endif
        <div class="flex items-end">
            <x-label class="">
                <span class="block mb-1">Mode Edit</span>
                <x-toggle :state="$isEditMode" wire:click="toggleEditMode"/>
            </x-label>
            <div class="ml-auto flex items-end gap-4">
                @if (!$isEditMode && $workOrder->dicek)
                <x-button overrideBgClasses="bg-red-500 hover:bg-red-600 active:bg-gray-900">
                    <x-icons.trash class="fill-white inline-block h-5"/>
                </x-button>
                <x-button onclick="window.print()">
                    <x-icons.print class="h-5 fill-white inline-block"/>
                </x-button>
                @endif
            </div>
        </div>
    </x-card>
    @endif
    <x-card class="mb-4 relative print-out">
        @if ($workOrder->isServiceCancelled())
        <x-stamp label="BATAL" />
        @endif
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6">
                <div class="grid grid-cols-12 mb-4 font-semibold">
                    <div class="font-bold uppercase col-span-4">
                        Tanggal
                    </div>
                    <div class="col-span-8">
                        : {{ $workOrder->tanggal }}
                    </div>
                </div>
                <div class="grid grid-cols-12 mb-4 font-semibold">
                    <div class="font-bold uppercase col-span-4">
                        Kendaraan
                    </div>
                    <div class="col-span-8">
                        : {{ $workOrder->kendaraan->getFullName() }}
                    </div>
                </div>
                <div class="grid grid-cols-12 mb-4 font-semibold">
                    <div class="font-bold uppercase col-span-4">
                        No. Plat
                    </div>
                    <div class="col-span-8">
                        : {{ $workOrder->kendaraan->no_plat }}
                    </div>
                </div>
                <div class="grid grid-cols-12 mb-4 font-semibold">
                    <div class="font-bold uppercase col-span-4">
                        Pelanggan
                    </div>
                    <div class="col-span-8">
                        : {{ $workOrder->kendaraan->pelanggan->nama }}
                    </div>
                </div>
                <div class="grid grid-cols-12 mb-4 font-semibold">
                    <div class="font-bold uppercase col-span-4">
                        Keluhan
                    </div>
                    <div class="col-span-8">
                        : {{ $workOrder->keluhan }}
                    </div>
                </div>
            </div>
            <div class="col-span-6">
                <div class="font-bold uppercase mb-4">
                    Status
                </div>
                <div>
                    <div class="grid-cols-12 grid gap-4 mb-4">
                        <div class="col-span-3">Dicek</div>
                        <x-checkbox :checked="$workOrder->dicek" wire:click="markAsChecked" class="col-span-9"/>
                    </div>
                    <div class="grid-cols-12 grid gap-4">
                        <div class="col-span-3">Selesai</div>
                        <x-checkbox :checked="$workOrder->service_selesai" wire:click="markAsFinished" class="col-span-9"/>
                    </div>
                </div>
                {{-- <div class="flex gap-4">
                    <x-boolean-button
                        class="px-2 rounded text-white font-semibold" trueLabel="Dicek" falseLabel="Dicek"
                        trueClass="bg-green-500 hover:bg-green-600" falseClass="bg-gray-300 hover:bg-gray-400" 
                        :state="$workOrder->dicek" wire:click="markAsChecked"
                    />
                    <x-boolean-button
                        class="px-2 rounded text-white font-semibold" trueLabel="Selesai" falseLabel="Selesai"
                        trueClass="bg-green-500 hover:bg-green-600" falseClass="bg-gray-300 hover:bg-gray-400" 
                        :state="$workOrder->service_selesai" wire:click="markAsFinished"
                    />
                </div> --}}
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
                <div class="border-b-2 border-primary grid {{ !$isEditMode ? 'grid-cols-10' : 'grid-cols-12' }} py-2 font-semibold gap-4">
                    <div class="col-span-3">Jenis Service</div>
                    <div class="col-span-2">Harga</div>
                    <div class="col-span-2">Jumlah</div>
                    <div class="col-span-3">Subtotal</div>
                    @if($isEditMode)<div class="col-span-2">Aksi</div>@endif
                </div>
                @foreach ($workOrder->penjualan_services as $penjualanService)
                    <div class="border-b border-primary grid {{ !$isEditMode ? 'grid-cols-10' : 'grid-cols-12' }} py-2 gap-4">
                        <div class="col-span-3">{{$penjualanService->jenis_service->nama}}</div>
                        <div class="col-span-2">{{$penjualanService->harga}}</div>
                        <div class="col-span-2">{{$penjualanService->jumlah}}</div>
                        <div class="col-span-3">{{$penjualanService->getTotal()}}</div>
                        @if ($isEditMode)
                        <div class="col-span-2">
                            <button
                                wire:click="deletePenjualanService({{$penjualanService->id}})" 
                                class="uppercase text-red-600 hover:text-red-800 font-semibold text-sm">
                                Delete
                            </button>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            @if ($isEditMode)
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
                        min="0"
                        placeholder="Jumlah" required />
                </div>
                <div class="col-span-3">
                    <x-input 
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Subtotal" disabled :value="$selectedJenisService->harga * (is_numeric($jenisServiceAmount) ? $jenisServiceAmount : 0)" required />
                </div>
                <div class="col-span-2 flex items-center justify-end">
                    <x-button class="">
                        {{ __('Tambah') }}
                    </x-button>
                </div>
            </form>
            @endif
            <div class="grid {{ !$isEditMode ? 'grid-cols-10' : 'grid-cols-12' }} py-2 gap-4">
                <div class="{{ !$isEditMode ? 'col-span-7' : 'col-span-9' }} col-start-4 border-t-4 border-primary"></div>
                <div class="col-span-4 col-start-4 uppercase font-bold text-xl">TOTAL SERVICE</div>
                <div class="{{ !$isEditMode ? 'col-span-3' : 'col-span-5' }} col-start-8 text-xl">{{ $workOrder->getTotalPenjualanServices()}}</div>
            </div>
        </div>
        <hr class="my-4">
        {{-- SUKU CADANG --}}
        <div>
            <h3 class="font-semibold text-lg uppercase mb-4">Penggantian Suku Cadang</h3>
            <div class="mb-4">
                <div class="border-b-2 border-primary grid {{ !$isEditMode ? 'grid-cols-10' : 'grid-cols-12' }} py-2 font-semibold gap-4">
                    <div class="col-span-3">Suku Cadang</div>
                    <div class="col-span-2">Harga</div>
                    <div class="col-span-2">Jumlah</div>
                    <div class="col-span-3">Subtotal</div>
                    @if($isEditMode)<div class="col-span-2">Aksi</div>@endif
                </div>
                @foreach ($workOrder->penggantian_suku_cadangs as $penggantianSukuCadang)
                    <div class="border-b border-primary grid {{ !$isEditMode ? 'grid-cols-10' : 'grid-cols-12' }} py-2 gap-4">
                        <div class="col-span-3">{{$penggantianSukuCadang->suku_cadang->nama}}</div>
                        <div class="col-span-2">{{$penggantianSukuCadang->harga}}</div>
                        <div class="col-span-2">{{$penggantianSukuCadang->jumlah}}</div>
                        <div class="col-span-3">{{$penggantianSukuCadang->getTotal()}}</div>
                        @if ($isEditMode)
                        <div class="col-span-2">
                            <button
                                wire:click="deletePenggantianSukuCadang({{$penggantianSukuCadang->id}})" 
                                class="uppercase text-red-600 hover:text-red-800 font-semibold text-sm">
                                Delete
                            </button>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @if ($isEditMode)
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
                        min="0"
                        placeholder="Jumlah" required />
                </div>
                <div class="col-span-3">
                    <x-input 
                        class="block min-w-0 w-full" 
                        type="number" 
                        placeholder="Subtotal" disabled :value="$selectedSukuCadang->harga * (is_numeric($sukuCadangAmount) ? $sukuCadangAmount : 0)" required />
                </div>
                <div class="col-span-2 flex items-center justify-end">
                    <x-button class="">
                        {{ __('Tambah') }}
                    </x-button>
                </div>
            </form>  
            @endif
            <div class="grid {{ !$isEditMode ? 'grid-cols-10' : 'grid-cols-12' }} py-2 gap-4">
                <div class="{{ !$isEditMode ? 'col-span-7' : 'col-span-9' }} col-start-4 border-t-4 border-primary"></div>
                <div class="col-span-4 col-start-4 uppercase font-bold text-xl">TOTAL SUKU CADANG</div>
                <div class="{{ !$isEditMode ? 'col-span-3' : 'col-span-5' }} col-start-8 text-xl">{{ $workOrder->getTotalPenggantianSukuCadangs()}}</div>
            </div>
        </div>
        <hr class="my-4">

        <div class="grid {{ !$isEditMode ? 'grid-cols-10' : 'grid-cols-12' }} py-2 gap-4">
            <div class="{{ !$isEditMode ? 'col-span-10' : 'col-span-12' }} border-t-8 border-primary"></div>
            <div class="col-span-4 col-start-4 uppercase font-bold text-xl">Grandtotal</div>
            <div class="{{ !$isEditMode ? 'col-span-3' : 'col-span-5' }} col-start-8 text-xl">{{ $workOrder->getGrandTotal()}}</div>
        </div>
        @endif

    </x-card>
    @if ($workOrder->dicek && $workOrder->isApprovalPending())
    <x-card>
        <div class="flex justify-end items-center gap-4">
            {{-- <div class="font-semibold uppercase">
                Mau Diservice?
            </div> --}}
            <div>
                <x-button overrideBgClasses="bg-green-500 hover:bg-green-600" wire:click="markApproveStatus(true)">Setuju Service</x-button>
                <x-button overrideBgClasses="bg-red-500 hover:bg-red-600" wire:click="markApproveStatus(false)">Batal Service</x-button>
            </div>
        </div>
        {{-- <hr class="my-4"> --}}
    </x-card>
    @endif

</div>

