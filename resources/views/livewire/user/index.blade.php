
<div class="space-y-2">
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('users.register') }} ">
            <x-button type="button">Tambah User</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('name')" sortable :sortDir="$sortField === 'name' ? $sortDir : null">Name</x-table.heading>
            <x-table.heading>Peran</x-table.heading>
            <x-table.heading wire:click="setSort('email')" sortable :sortDir="$sortField === 'email' ? $sortDir : null">Email</x-table.heading>
            <x-table.heading wire:click="setSort('noTelp')" sortable :sortDir="$sortField === 'noTelp' ? $sortDir : null">No. Telp</x-table.heading>
            <x-table.heading wire:click="setSort('alamat')" sortable :sortDir="$sortField === 'alamat' ? $sortDir : null">Alamat</x-table.heading>
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
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-white hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                <x-icons.more class="h-4"/>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-dropdown-link class="flex items-center gap-3"
                                href="{{ route('users.show', $user->id) }}"    
                            ><x-icons.eye class="h-4"/> <span>Detil</span></x-dropdown-link>
                            <x-dropdown-link class="flex items-center gap-3"
                                href="{{ route('users.edit', $user->id) }}"    
                            ><x-icons.edit class="h-4"/> <span>Edit</span></x-dropdown-link>
                            <form class="" action="{{route('users.destroy', $user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="with-del-conf w-full flex items-center gap-3 px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" type="submit"
                                ><x-icons.trash class="h-4"/> <span>Hapus</span></button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $users->links() }}
    </div>
    
<div>



