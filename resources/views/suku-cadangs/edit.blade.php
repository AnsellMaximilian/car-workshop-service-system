<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Suku Cadang '.$sukuCadang->id) }}
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

        <form method="POST" action="{{ route('suku-cadangs.update', $sukuCadang->id) }}" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PATCH')
            <div class="col-span-12">
                <x-label for="nama" :value="__('Nama')" />

                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama') ?? $sukuCadang->nama" required autofocus />
            </div>

            <div class="col-span-12">
                <x-label for="harga" value="Harga" />

                <x-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga') ?? $sukuCadang->harga" required />
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Perbaharui') }}
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
