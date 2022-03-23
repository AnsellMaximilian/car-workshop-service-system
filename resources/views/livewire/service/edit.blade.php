<div>

    <div class="mb-4">
        <x-icon-link href="{{ route('services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    
    <div class="grid grid-cols-12 gap-4">
        <x-card class="col-span-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6">
                    <div class="font-semibold">Waktu Pendaftaran</div>
                    <div>{{ \Carbon\Carbon::parse($service->pendaftaran_service->waktu_pendaftaran)->format('d/m/Y - H:i:s')}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Waktu Mulai</div>
                    <div>{{ \Carbon\Carbon::parse($service->waktu_mulai)->format('d/m/Y - H:i:s')}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Pelanggan</div>
                    <div>{{$service->pendaftaran_service->pelanggan->nama}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">No. Plat</div>
                    <div>{{$service->pendaftaran_service->no_plat}}</div>
                </div>
                <div class="col-span-12">
                    <div class="font-semibold">Keluhan</div>
                    <div>{{$service->pendaftaran_service->keluhan}}</div>
                </div>
            </div>
        </x-card>
        <x-card class="col-span-4 flex flex-col">
            <div class="flex justify-between">
                <div class="font-semibold">Service</div>
                <div>{{ $totalPenjualanServices}}</div>
            </div>
            <div class="flex justify-between">
                <div class="font-semibold">Suku Cadang</div>
                <div>{{ $totalPenggantianSukuCadangs}}</div>
            </div>

            <div class="flex justify-between mt-4">
                <div class="font-bold uppercase">Total Service</div>
                <div>{{$totalPenjualanServices + $totalPenggantianSukuCadangs}}</div>
            </div>

            <div class="mt-4">
                <x-label for="statusService" value="Status Service" />
                <select 
                    wire:model="statusService" 
                    id="statusService" 
                    class="rounded-md mt-1 shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    <option value="cek">Dicek</option>
                    <option value="service">Diservice</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{route('services.index')}}">
                    <x-button class="ml-4" overrideBgClasses="bg-gray-700 hover:bg-gray-800">
                        {{ __('Batal') }}
                    </x-button>
                </a>
                <x-button class="ml-4" wire:click="save">
                    {{ __('Simpan') }}
                </x-button>
            </div>
        </x-card>
        <x-card class="col-span-12">
            <h2 class="font-semibold mb-4 text-xl">Pemeriksaan Standar</h2>

        </x-card>
        <x-card class="col-span-12">
            <div class="flex justify-between">
                <h2 class="font-semibold mb-4 text-xl">Jasa Service</h2>
                <div>
                    <x-button overrideBgClasses="bg-gray-700 hover:bg-gray-800" wire:click="addPenjualanService">
                        {{ __('+') }}
                    </x-button>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($penjualanServices as $key => $index)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <select
                            wire:model="selectedJenisServiceId.{{ $index }}"
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
                            placeholder="Harga" disabled 
                            :value="$selectedJenisService[$index]->harga" 
                            required />
                    </div>
                    <div class="col-span-2">
                        <x-input
                            wire:model="jenisServiceAmount.{{ $index }}"
                            class="block min-w-0 w-full" 
                            type="number"
                            min="0"
                            placeholder="Jumlah" required />
                    </div>
                    <div class="col-span-3">
                        <x-input 
                            class="block min-w-0 w-full" 
                            type="number" 
                            placeholder="Subtotal" disabled 
                            :value="$selectedJenisService[$index]->harga * (is_numeric($jenisServiceAmount[$index]) ? $jenisServiceAmount[$index] : 0)" 
                            required />
                    </div>
                    <div class="col-span-2 flex items-center justify-end">
                        <x-button overrideBgClasses="bg-red-600 hover:bg-red-500" wire:click="removePenjualanService({{$key}})">
                            &times;
                        </x-button>
                    </div>
                </div>
                @endforeach
            </div>
        </x-card>
        <x-card class="col-span-12">
            <div class="flex justify-between">
                <h2 class="font-semibold mb-4 text-xl">Penggantian Suku Cadang</h2>
                <div>
                    <x-button overrideBgClasses="bg-gray-700 hover:bg-gray-800" wire:click="addPenggantianSukuCadang">
                        {{ __('+') }}
                    </x-button>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($penggantianSukuCadangs as $key => $index)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <select
                            wire:model="selectedSukuCadangId.{{ $index }}"
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
                            placeholder="Harga" disabled 
                            :value="$selectedSukuCadang[$index]->harga" 
                            required />
                    </div>
                    <div class="col-span-2">
                        <x-input
                            wire:model="sukuCadangAmount.{{ $index }}"
                            class="block min-w-0 w-full" 
                            type="number"
                            min="0"
                            placeholder="Jumlah" required />
                    </div>
                    <div class="col-span-3">
                        <x-input 
                            class="block min-w-0 w-full" 
                            type="number" 
                            placeholder="Subtotal" disabled 
                            :value="$selectedSukuCadang[$index]->harga * (is_numeric($sukuCadangAmount[$index]) ? $sukuCadangAmount[$index] : 0)" 
                            required />
                    </div>
                    <div class="col-span-2 flex items-center justify-end">
                        <x-button overrideBgClasses="bg-red-600 hover:bg-red-500" wire:click="removePenggantianSukuCadang({{$key}})">
                            &times;
                        </x-button>
                    </div>
                </div>
                @endforeach
            </div>
        </x-card>
    </div>
</div>
