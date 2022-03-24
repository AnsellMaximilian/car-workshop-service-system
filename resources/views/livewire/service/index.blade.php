<div class="space-y-2">
    <div class="flex gap-2">
        <div class="flex gap-1 flex-col">
            <x-label for="status" value="Status Service" />
            <select id="status" 
                wire:model="statusSort"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="semua">Semua</option>
                <option value="cek">Dicek</option>
                <option value="service">Diservice</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

        <div class="flex gap-1 flex-col">
            <x-label for="status" value="Persetujuan" />
            <select id="status" 
                wire:model="persetujuanSort"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="semua">Semua</option>
                <option value="pending">Pending</option>
                <option value="setuju">Setuju</option>
                <option value="tolak">Tolak</option>
            </select>
        </div>

        <div class="flex gap-1 flex-col">
            <x-label for="status" value="Pembayaran" />
            <select id="status" 
                wire:model="pembayaranSort"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="semua">Semua</option>
                <option value="sudah">Sudah</option>
                <option value="belum">Belum</option>
            </select>
        </div>
    </div>
    <div class="flex justify-start gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        
        <a href="{{ route('services.create') }} " class="ml-auto">
            <x-button type="button">Mulai Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading>ID</x-table.heading>
            <x-table.heading wire:click="setSort('waktu_mulai')" sortable :sortDir="$sortField === 'waktu_mulai' ? $sortDir : null">Waktu Mulai</x-table.heading>
            <x-table.heading>No. Plat</x-table.heading>
            <x-table.heading>Pelanggan</x-table.heading>
            <x-table.heading>Total</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Persetujuan</x-table.heading>
            <x-table.heading>Pembayaran</x-table.heading>
            <x-table.heading>Actions</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($services as $service)
            <x-table.row>
                <x-table.cell>{{ $service->id }}</x-table.cell>
                <x-table.cell>{{ $service->waktu_mulai }}</x-table.cell>
                <x-table.cell>{{ $service->pendaftaran_service->no_plat }}</x-table.cell>
                <x-table.cell>{{ $service->pendaftaran_service->pelanggan->nama }}</x-table.cell>
                <x-table.cell>{{ $service->getGrandTotal() }}</x-table.cell>
                <x-table.cell class="uppercase font-bold text-xs">{{ $service->status_service }}</x-table.cell>
                <x-table.cell class="uppercase font-bold text-xs">
                    {{ $service->persetujuan_service ? $service->persetujuan_service->status_persetujuan : 'pending' }}
                </x-table.cell>
                <x-table.cell class="uppercase font-bold text-xs">
                    {{ $service->pembayaran ? 'sudah' : 'belum' }}
                </x-table.cell>
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



