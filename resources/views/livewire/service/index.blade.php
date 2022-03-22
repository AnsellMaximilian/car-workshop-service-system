<div class="space-y-2">
    <div class="flex justify-start gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        
        <div class="flex gap-2 items-center">
            <x-label for="status" value="Status" />
            <select id="status" 
                wire:model="statusSort"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="all">Semua</option>
                <option value="pending">Pending</option>
                <option value="setuju">Setuju</option>
                <option value="tolak">Tolak</option>
            </select>
        </div>
        <a href="{{ route('services.create') }} " class="ml-auto">
            <x-button type="button">Mulai Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading>ID</x-table.heading>
            <x-table.heading>Waktu Daftar</x-table.heading>
            <x-table.heading>No. Plat</x-table.heading>
            <x-table.heading>Pelanggan</x-table.heading>
            <x-table.heading>Perkiraan</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($services as $service)
            <x-table.row>
                <x-table.cell>{{ $service->id }}</x-table.cell>
                <x-table.cell>{{ $service->pendaftaran_service->waktu_pendaftaran }}</x-table.cell>
                <x-table.cell>{{ $service->pendaftaran_service->no_plat }}</x-table.cell>
                <x-table.cell>{{ $service->pendaftaran_service->pelanggan->nama }}</x-table.cell>
                <x-table.cell>{{ $service->pendaftaran_service->getTotalPerkiraan() }}</x-table.cell>
                <x-table.cell>{{ $service->status_service }}</x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('services.show', $service->id) }}"    
                    >VIEW</a>
                    <a class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                        href="{{ route('services.edit', $service->id) }}"    
                    >Edit</a>
                    <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                        wire:click="destroy({{ $service->id }})"
                    >Delete</button>
                </x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>

    </x-table.wrapper>
    <div>
        {{ $services->links() }}
    </div>
    
<div>



