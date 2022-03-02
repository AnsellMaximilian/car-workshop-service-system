
<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('users.register') }} ">
            <x-button type="button">Tambah User</x-button>
        </a>
        
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
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('users.edit', $user->id) }}"    
                    >Edit</a>
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $user->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $users->links() }}
    </div>
    
<div>


