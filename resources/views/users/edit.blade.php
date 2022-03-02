<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Edit User '.$user->id }}
        </h2>
    </x-slot>
    <x-card class="max-w-xl">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $user->name" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="kode_peran" value="Peran" />
                <select 
                    name="kode_peran" 
                    id="kode_peran" 
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    @foreach ($perans as $peran)
                        <option 
                            value="{{ $peran->kode_peran }}" 
                            {{ (old('kode_peran') ? old('kode_peran') === $peran->kode_peran : $user->kode_peran === $peran->kode_peran ) ? 'selected' : '' }}
                        >{{ $peran->nama_peran }}</option>
                    @endforeach
                </select>

                {{-- <x-input id="peran" class="block mt-1 w-full" type="tel" name="peran" :value="old('peran')" required /> --}}
            </div>

            <div class="mt-4">
                <x-label for="noTelp" value="No. Telp" />

                <x-input id="noTelp" class="block mt-1 w-full" type="tel" name="noTelp" :value="old('noTelp') ?? $user->noTelp" required />
            </div>

            <div class="mt-4">
                <x-label for="alamat" value="Alamat" />
                <textarea 
                    id="alamat" 
                    name="alamat" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{ old('alamat') ?? $user->alamat }}</textarea>
            </div>

            <div class="mt-4">
                <x-file-input 
                    name="photo" 
                    label="Photo" 
                    defaultFile="{{ asset($user->getPhotoPath()) }}"
                    accept=".jpg,.png,.jpeg"
                 />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Perbaharui') }}
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
