<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pemeriksaan Standar '.$pemeriksaanStandar->id) }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('pemeriksaan-standars.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('pemeriksaan-standars.update', $pemeriksaanStandar->id) }}" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PATCH')
            <div class="col-span-6">
                <x-label for="nama" :value="__('Nama')" />

                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama') ?? $pemeriksaanStandar->nama" required autofocus />
            </div>

            <div class="col-span-12">
                <x-label for="deskripsi" value="Deskripsi" />
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{old('deskripsi') ?? $pemeriksaanStandar->deskripsi }}</textarea>
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Perbaharui') }}
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
