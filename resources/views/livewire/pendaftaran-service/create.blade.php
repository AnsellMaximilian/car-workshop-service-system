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
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('pendaftaran-services.store') }}" class="grid grid-cols-12 gap-4">
                @csrf
                <div class="col-span-12">
                    <span class="block font-medium text-sm text-gray-700">Waktu Pendaftaran</span>
                    <span class="block mt-1">{{ now()->format('d/m/Y - H:i:s')}}</span>
                </div>
                <div class="col-span-6">
                    <x-label for="pelanggan_id" value="Pelanggan" />
                    <select 
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
        
                    <x-input id="no_plat" name="no_plat" class="block mt-1 w-full" type="text" :value="old('no_plat')" />
                </div>
                <div class="col-span-12">
                    <x-label for="keluhan" value="Keluhan" />
                    <textarea 
                        id="keluhan" 
                        name="keluhan" 
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >{{ old('keluhan')}}</textarea>
                </div>
                <div class="flex items-center justify-end col-span-12">
                    <x-button class="ml-4">
                        {{ __('Buat') }}
                    </x-button>
                </div>
            </form>
        </x-card>
        <x-card class="col-span-4">
            Total: {{ $totalPerkiraanService}}
        </x-card>
        <x-card class="col-span-12">
            <h2>Perkiraan Service</h2>
            <div class="flex flex-col gap-4">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <select
                            wire:model="selectedJenisServiceId.0"
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
                            :value="$selectedJenisService[0]->harga" 
                            required />
                    </div>
                    <div class="col-span-2">
                        <x-input
                            wire:model="jenisServiceAmount.0"
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
                            :value="$selectedJenisService[0]->harga * (is_numeric($jenisServiceAmount[0]) ? $jenisServiceAmount[0] : 0)" 
                            required />
                    </div>
                    <div class="col-span-2 flex items-center justify-end">
                        <x-button class="" wire:click="addServicePrediction">
                            {{ __('Tambah') }}
                        </x-button>
                    </div>
                </div>
                @foreach ($servicePredictions as $key => $index)
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
                        <x-button class="" wire:click="removeServicePrediction({{$key}})">
                            &times;
                        </x-button>
                    </div>
                </div>
                @endforeach
            </div>
        
        </x-card>
    </div>
    
</div>