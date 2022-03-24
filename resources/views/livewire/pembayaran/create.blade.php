<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catat Pembayaran') }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('pembayarans.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <div class="grid grid-cols-12 gap-4">
        <x-card class="col-span-12 md:col-span-6">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form wire:submit.prevent="savePembayaran" class="grid grid-cols-12 gap-4">
                @csrf
                
                <div class="col-span-12">
                    <x-label for="selectedServiceId" value="Service" />
                    <select 
                        id="selectedServiceId" 
                        wire:model="selectedServiceId"
                        class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                        @foreach ($services as $service)
                            <option 
                                value="{{ $service->id }}" 
                            >{{ $service->id }} - {{ $service->pendaftaran_service->no_plat }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-span-6">
                    {{-- <span class="block font-medium text-sm text-gray-700">Tanggal Pembayaran</span>
                    <span class="block mt-1">{{ now()->format('d/m/Y')}}</span> --}}
                    <x-label for="tanggalPembayaran" value="Tanggal Pembayaran" />
                    <x-input
                        type="date"
                        wire:model="tanggalPembayaran"
                        class="mt-1 w-full" 
                        id="tanggalPembayaran" />
                </div>
    
                {{-- <div class="col-span-6">
                    <x-label for="pelanggan" value="Pelanggan" />
                    <x-input id="pelanggan" class="block mt-1 w-full" type="text" disabled :value="$selectedService->pendaftaran_service->pelanggan->nama" />
                </div> --}}
    
                <div class="col-span-6">
                    <x-label for="tipePembayaran" value="Tipe Pembayaran" />
                    <select 
                        wire:model="tipePembayaran" 
                        id="tipePembayaran" 
                        class="rounded-md mt-1 w-full shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                        <option value="cash">Cash</option>
                        <option value="debit">Debit</option>
                    </select>
                </div>
                
                {{-- <div class="col-span-6">
                    <x-label for="totalAwal" value="Total" />
                    <x-input id="totalAwal" class="block mt-1 w-full" type="text" disabled :value="$selectedService->getGrandTotal()" />
                </div> --}}
    
                {{-- <div class="col-span-6">
                    <x-label for="totalSisa" value="Total Sisa" />
                    <x-input id="totalSisa" class="block mt-1 w-full" type="text" disabled :value="$selectedService->getAmountToBePaid()" />
                </div> --}}
    
                {{-- <div class="col-span-6">
                    <x-label for="jumlah" value="Jumlah" />
                    <x-input placeholder="Jumlah" id="jumlah" type="number" wire:model="jumlah" class="block mt-1 min-w-0 w-full" />
                </div> --}}
    
                {{-- <div class="col-span-6">
                    <x-label for="kembali" value="Kembali" />
                    <x-input placeholder="Kembali" id="kembali" type="number" class="block mt-1 min-w-0 w-full" disabled :value="(is_numeric($jumlah) ? $selectedService->getChange($jumlah) : 0)"/>
                </div> --}}
    
                <div class="col-span-12">
                    <x-label for="keterangan" value="Keterangan" />
                    <textarea 
                        id="keterangan" 
                        wire:model="keterangan" 
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >{{ old('keterangan')}}</textarea>
                </div>

                <div class="col-span-12">
                    <x-label for="buktiPembayaran" value="Bukti Pembayaran" />
                    <x-input
                        type="file" 
                        class="mt-1"
                        wire:model="buktiPembayaran"
                        id="buktiPembayaran" 
                        accept=".jpg,.png,.jpeg"/>
                </div>
    
                <div class="flex items-center justify-end col-span-12">
                    <x-button class="ml-4">
                        {{ __('Catat') }}
                    </x-button>
                </div>
            </form>
        </x-card>
        <x-card class="col-span-6">
            <div class="grid grid-cols-12 gap-4">
                <h2 class="font-semibold text-lg col-span-12">Info Service</h2>
                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">Pelanggan</div>
                    <div class="font-bold">{{$selectedService->pendaftaran_service->pelanggan->nama}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">No. Plat</div>
                    <div class="font-bold">{{$selectedService->pendaftaran_service->no_plat}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">Waktu Pendaftaran</div>
                    <div class="font-bold">{{ \Carbon\Carbon::parse($selectedService->pendaftaran_service->waktu_pendaftaran)->format('d M, Y - H:i:s')}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">Waktu Mulai</div>
                    <div class="font-bold">{{ \Carbon\Carbon::parse($selectedService->waktu_mulai)->format('d M, Y - H:i:s')}}</div>
                </div>
                <div class="col-span-12">
                    <div class="font-medium text-gray-700 text-sm">Keluhan</div>
                    <div class="">{{$selectedService->pendaftaran_service->keluhan}}</div>
                </div>
            </div>
        </x-card>
    </div>
</div>
