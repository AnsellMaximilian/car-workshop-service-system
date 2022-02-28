<div class="space-y-2">
    <div class="">
        <x-input wire:model="query" class="block w-full md:w-1/3" type="text" placeholder="Search"/>
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort(id)">ID</x-table.heading>
            <x-table.heading wire:click="setSort(name)">Name</x-table.heading>
            <x-table.heading wire:click="setSort(email)">Email</x-table.heading>
            <x-table.heading wire:click="setSort(noTelp)">No. Telp</x-table.heading>
            <x-table.heading wire:click="setSort(alamat)">Alamat</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
            <x-table.row>
                <x-table.cell>{{ $user->id }}</x-table.cell>
                <x-table.cell>{{ $user->name }}</x-table.cell>
                <x-table.cell>{{ $user->email }}</x-table.cell>
                <x-table.cell>{{ $user->noTelp }}</x-table.cell>
                <x-table.cell>{{ $user->alamat }}</x-table.cell>
                <x-table.cell>Delete</x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
<div>