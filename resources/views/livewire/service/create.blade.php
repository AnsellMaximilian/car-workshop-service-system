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
    </div>
</div>
