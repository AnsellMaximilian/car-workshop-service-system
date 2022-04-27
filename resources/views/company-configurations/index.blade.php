<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfigurasi') }}
        </h2>
    </x-slot>

    <div>
        <form method="POST" action="{{ route('configurations.update', $config) }}" enctype="multipart/form-data" class="grid grid-cols gap-4">
            @csrf
            @method('PATCH')

            <div class="col-span-6">
                <x-label for="rekening_bca" :value="__('Rek. BCA')" />

                <x-input id="rekening_bca" class="block mt-1 w-full" type="text" name="rekening_bca" :value="old('rekening_bca') ?? $config->rekening_bca" required  />
            </div>

            <div class="col-span-6">
                <x-label for="rekening_bni" :value="__('Rek. BNI')" />
                <x-input id="rekening_bni" class="block mt-1 w-full" type="text" name="rekening_bni" :value="old('rekening_bni') ?? $config->rekening_bni" required  />
            </div>

            <div class="col-span-6">
                <x-label for="no_telp" :value="__('No. Telp')" />
                <x-input id="no_telp" class="block mt-1 w-full" type="text" name="no_telp" :value="old('no_telp') ?? $config->no_telp" required  />
            </div>

            <div class="col-span-6">
                <x-label for="hp_1" :value="__('HP. 1')" />
                <x-input id="hp_1" class="block mt-1 w-full" type="text" name="hp_1" :value="old('hp_1') ?? $config->hp_1" required  />
            </div>

            <div class="col-span-6">
                <x-label for="hp_2" :value="__('HP. 2')" />
                <x-input id="hp_2" class="block mt-1 w-full" type="text" name="hp_2" :value="old('hp_2') ?? $config->hp_2" required  />
            </div>


            <div class="col-span-6">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ?? $config->email" required />
            </div>

            <div class="col-span-12">
                <x-label for="alamat" value="Alamat" />
                <textarea 
                    id="alamat" 
                    name="alamat" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{old('alamat') ?? $config->alamat}}</textarea>
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>

    </div>
    
    
</x-app-layout>
