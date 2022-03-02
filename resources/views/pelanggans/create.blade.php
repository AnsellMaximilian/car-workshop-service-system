<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pelanggan') }}
        </h2>
    </x-slot>
    <x-card class="">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('pelanggans.store') }}" class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-6">
                <x-label for="nama" :value="__('Nama')" />

                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
            </div>

            <div class="col-span-6">
                <x-label for="noTelp" value="No. Telp" />

                <x-input id="noTelp" class="block mt-1 w-full" type="tel" name="noTelp" :value="old('noTelp')" required />
            </div>

            <div class="col-span-6">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
            </div>

            <div class="col-span-12">
                <x-label for="alamat" value="Alamat" />
                <textarea 
                    id="alamat" 
                    name="alamat" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{old('alamat')}}</textarea>
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
