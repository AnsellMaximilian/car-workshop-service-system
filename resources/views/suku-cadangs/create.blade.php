<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Suku Cadang') }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('suku-cadangs.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('suku-cadangs.store') }}" class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12">
                <x-label for="nama" :value="__('Nama')" />

                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
            </div>

            <div class="col-span-12">
                <x-label for="harga" value="Harga" />

                <x-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga')" required />
            </div>

            <div class="col-span-12">
                <x-label for="stok_awal" value="Stok Awal" />

                <x-input id="stok_awal" class="block mt-1 w-full" type="number" name="stok_awal" :value="old('stok_awal') ?? 0" />
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
