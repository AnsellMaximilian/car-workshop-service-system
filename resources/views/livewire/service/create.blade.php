<div>
    <div class="mb-4">
        <x-icon-link href="{{ route('services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('services.store') }}" class="grid grid-cols-12 gap-4">
            @csrf

            <div class="col-span-12">
                <span class="block font-medium text-sm text-gray-700">Tanggal Pendaftaran</span>
                <span class="block mt-1">{{ now()->format('d/m/Y')}}</span>
            </div>

            <div class="col-span-6">
                <x-label for="pelanggan_id" value="Pelanggan" />
                <select 
                    name="pelanggan_id" 
                    id="pelanggan_id" 
                    class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
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
</div>
