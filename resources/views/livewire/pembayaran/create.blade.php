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
    <x-card class="">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form wire:submit.prevent="savePembayaran" class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12">
                <span class="block font-medium text-sm text-gray-700">Tanggal Pembayaran</span>
                <span class="block mt-1">{{ now()->format('d/m/Y')}}</span>
            </div>

            <div class="col-span-6">
                <x-label for="selectedFakturServiceId" value="Faktur Service" />
                <select 
                    id="selectedFakturServiceId" 
                    wire:model="selectedFakturServiceId"
                    class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    @foreach ($fakturServices as $fakturService)
                        <option 
                            value="{{ $fakturService->id }}" 
                            {{ old('selectedFakturServiceId') === $fakturService->id  ? 'selected' : '' }}
                        >{{ $fakturService->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6">
                <x-label for="pelanggan" value="Pelanggan" />
                <x-input id="pelanggan" class="block mt-1 w-full" type="text" disabled :value="$selectedFakturService->service->pelanggan->nama" />
            </div>
            
            <div class="col-span-6">
                <x-label for="totalAwal" value="Total Awal" />
                <x-input id="totalAwal" class="block mt-1 w-full" type="text" disabled :value="$selectedFakturService->getGrandTotal()" />
            </div>

            <div class="col-span-6">
                <x-label for="totalSisa" value="Total Sisa" />
                <x-input id="totalSisa" class="block mt-1 w-full" type="text" disabled :value="$selectedFakturService->getAmountToBePaid()" />
            </div>

            <div class="col-span-6">
                <x-label for="jumlah" value="Jumlah" />
                <x-input placeholder="Jumlah" id="jumlah" type="number" wire:model="jumlah" class="block mt-1 min-w-0 w-full" />
            </div>

            <div class="col-span-6">
                <x-label for="kembali" value="Kembali" />
                <x-input placeholder="Kembali" id="kembali" type="number" class="block mt-1 min-w-0 w-full" :value="(is_numeric($jumlah) ? $selectedFakturService->getChange($jumlah) : 0)"/>
            </div>

            <div class="col-span-12">
                <x-label for="keterangan" value="Keterangan" />
                <textarea 
                    id="keterangan" 
                    wire:model="keterangan" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{ old('keterangan')}}</textarea>
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Catat') }}
                </x-button>
            </div>
        </form>
    </x-card>
</div>
