<div>
    <div class="mb-4">
        <x-icon-link href="{{ route('pendaftaran-services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <div class="grid grid-cols-12 gap-4">
        <x-card class="col-span-8">
            <form method="POST" action="{{ route('pendaftaran-services.store') }}" class="grid grid-cols-12 gap-4">
                @csrf
                <div class="col-span-12">
                    <span class="block font-medium text-sm text-gray-700">Waktu Pendaftaran</span>
                    <span class="block mt-1">{{ now()->format('d/m/Y - H:i:s')}}</span>
                </div>
                <div class="col-span-6">
                    <x-label for="pelanggan_id" value="Pelanggan" />
                    <select
                        wire:model="pelanggan_id"
                        name="pelanggan_id" 
                        id="pelanggan_id" 
                        class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach ($pelanggans as $pelanggan)
                            <option 
                                value="{{ $pelanggan->id }}" 
                                {{ old('pelanggan_id') === $pelanggan->id  ? 'selected' : '' }}
                            >{{ $pelanggan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6">
                    <x-label for="no_plat" value="No. Plat" />
                    <x-input id="no_plat" class="block mt-1 w-full" type="text" :value="old('no_plat')" wire:model="no_plat" />
                </div>
                <div class="col-span-12">
                    <x-label for="keluhan" value="Keluhan" />
                    <textarea
                        wire:model="keluhan"
                        id="keluhan" 
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >{{ old('keluhan')}}</textarea>
                </div>
            </form>
        </x-card>
        <x-card class="col-span-4 flex flex-col">
            <div class="flex justify-between">
                <div class="font-semibold">Service</div>
                <div>{{ $totalPerkiraanService}}</div>
            </div>
            <div class="flex justify-between">
                <div class="font-semibold">Suku Cadang</div>
                <div>{{ $totalPerkiraanSukuCadang}}</div>
            </div>

            <div class="flex justify-between mt-4">
                <div class="font-bold uppercase">Total Perkiraan</div>
                <div>{{ $totalPerkiraanSukuCadang + $totalPerkiraanService}}</div>
            </div>
            <div class="flex items-center justify-end mt-auto">
                <a href="{{route('pendaftaran-services.index')}}">
                    <x-button class="ml-4" overrideBgClasses="bg-gray-700 hover:bg-gray-800">
                        {{ __('Batal') }}
                    </x-button>
                </a>
                <x-button class="ml-4" wire:click="save">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </x-card>
        <x-card class="col-span-12">
            <div class="flex justify-between">
                <h2 class="font-semibold mb-4 text-xl">Perkiraan Service</h2>
                <div>
                    <x-button wire:loading.attr="disabled" overrideBgClasses="bg-gray-700 hover:bg-gray-800" wire:click="addServicePrediction">
                        {{ __('+') }}
                    </x-button>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($servicePredictions as $key => $index)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <select
                            wire:model="selectedJenisServiceId.{{ $index }}"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            @foreach ($jenisServices[$index] as $jenisService)
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
                        <x-button wire:loading.attr="disabled" overrideBgClasses="bg-red-600 hover:bg-red-500" wire:click="removeServicePrediction({{$key}})">
                            &times;
                        </x-button>
                    </div>
                </div>
                @endforeach
            </div>
        
        </x-card>
        <x-card class="col-span-12">
            <div class="flex justify-between">
                <h2 class="font-semibold mb-4 text-xl">Perkiraan Pengantian</h2>
                <div>
                    <x-button wire:loading.attr="disabled" overrideBgClasses="bg-gray-700 hover:bg-gray-800" wire:click="addSukuCadangPrediction">
                        {{ __('+') }}
                    </x-button>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($sukuCadangPredictions as $key => $index)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <select
                            wire:model="selectedSukuCadangId.{{ $index }}"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            @foreach ($sukuCadangs[$index] as $sukuCadang)
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
                        <x-button wire:loading.attr="disabled" overrideBgClasses="bg-red-600 hover:bg-red-500" wire:click="removeSukuCadangPrediction({{$key}})">
                            &times;
                        </x-button>
                    </div>
                </div>
                @endforeach
            </div>
        </x-card>
    </div>
    
</div>