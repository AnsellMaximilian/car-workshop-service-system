<div>
    <div class="mb-4">
        <x-icon-link href="{{ route('kendaraans.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('kendaraans.update', $kendaraan->id) }}" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PATCH')
            <div class="col-span-6">
                <x-label for="no_plat" :value="__('No. Plat')" />

                <x-input id="no_plat" class="block mt-1 w-full" type="text" name="no_plat" :value="$kendaraan->no_plat" disabled />
            </div>

            <div class="col-span-6">
                <x-label for="pelanggan_id" value="Pemilik" />
                <select 
                    name="pelanggan_id" 
                    id="pelanggan_id" 
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    @foreach ($pelanggans as $pelanggan)
                        <option 
                            value="{{ $pelanggan->id }}" 
                            {{ (old('pelanggan_id') ? old('pelanggan_id') === $pelanggan->id : $kendaraan->pelanggan_id === $pelanggan->id ) ? 'selected' : '' }}

                        >{{ $pelanggan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6">
                <x-label for="merk_id" value="Merk" />
                <select 
                    wire:model="selectedMerkId"
                    name="merk_id" 
                    id="merk_id" 
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    @foreach ($merks as $merk)
                        <option 
                            value="{{ $merk->id }}" 
                            {{-- {{ old('merk_id') === $merk->id  ? 'selected' : '' }} --}}
                        >{{ $merk->merk }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6">
                <x-label for="tipe_id" value="Tipe" />
                <select 
                    name="tipe_id" 
                    id="tipe_id" 
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    @foreach ($tipes as $tipe)
                        <option 
                            value="{{ $tipe->id }}" 
                            {{ (old('tipe_id') ? old('tipe_id') === $tipe->id : $kendaraan->tipe_id === $tipe->id ) ? 'selected' : '' }}
                        >{{ $tipe->tipe }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6">
                <x-label for="warna" value="Warna" />

                <x-input id="warna" class="block mt-1 w-full" type="tel" name="warna" :value="old('warna') ?? $kendaraan->warna" />
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
    </x-card>
</div>
