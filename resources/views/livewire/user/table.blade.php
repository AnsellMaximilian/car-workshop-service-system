<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <x-modal>
            <x-slot name="trigger">
                <button class="bg-primary shadow-lg h-full text-white rounded-md flex items-center px-2 md:px-6 font-semibold text-sm">
                    Tambah User
                </button>
            </x-slot>
            
            <div class="max-w-full w-[32rem]">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <h1 class="text-xl font-bold mb-4">Daftar User</h1>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
    
                    <div>
                        <x-label for="name" :value="__('Name')" />
    
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>
    
                    <div class="mt-4">
                        <x-label for="kode_peran" value="Peran" />
                        <select name="kode_peran" id="kode_peran" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ($perans as $peran)
                                <option value="{{ $peran->kode_peran }}">{{ $peran->nama_peran }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="mt-4">
                        <x-label for="noTelp" value="No. Telp" />
    
                        <x-input id="noTelp" class="block mt-1 w-full" type="tel" name="noTelp" :value="old('noTelp')" required />
                    </div>
    
                    <div class="mt-4">
                        <x-label for="alamat" value="Alamat" />
                        <textarea 
                            id="alamat" 
                            name="alamat" 
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >{{old('alamat')}}</textarea>
                    </div>
    
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
    
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>
    
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />
    
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>
    
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
    
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>
    
                    <div class="mt-4">
                        <x-file-input name="photo" label="Photo" />
                    </div>
    
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-modal>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')">ID</x-table.heading>
            <x-table.heading wire:click="setSort('name')">Name</x-table.heading>
            <x-table.heading wire:click="setSort('name')">Peran</x-table.heading>
            <x-table.heading wire:click="setSort('email')">Email</x-table.heading>
            <x-table.heading wire:click="setSort('noTelp')">No. Telp</x-table.heading>
            <x-table.heading wire:click="setSort('alamat')">Alamat</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
            <x-table.row>
                <x-table.cell>{{ $user->id }}</x-table.cell>
                <x-table.cell>{{ $user->name }}</x-table.cell>
                <x-table.cell>{{ $user->peran->nama_peran }}</x-table.cell>
                <x-table.cell>{{ $user->email }}</x-table.cell>
                <x-table.cell>{{ $user->noTelp }}</x-table.cell>
                <x-table.cell>{{ $user->alamat }}</x-table.cell>
                <x-table.cell class="space-x-2">
                    <span class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer">Edit</span>
                    <span class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer">Delete</span>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $users->links() }}
    </div>
    
<div>