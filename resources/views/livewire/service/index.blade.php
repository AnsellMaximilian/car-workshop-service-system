<div class="space-y-2">
    <div class="flex gap-2">
        <div class="flex gap-1 flex-col">
            <x-label for="status" value="Status Service" />
            <select id="status" 
                wire:model="statusSort"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="semua">Semua</option>
                <option value="mulai">Mulai</option>
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
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('waktu_mulai')" sortable :sortDir="$sortField === 'waktu_mulai' ? $sortDir : null">Waktu Mulai</x-table.heading>
            <x-table.heading>No. Plat</x-table.heading>
            <x-table.heading>Pelanggan</x-table.heading>
            <x-table.heading>Total</x-table.heading>
            <x-table.heading wire:click="setSort('status_service')" sortable :sortDir="$sortField === 'status_service' ? $sortDir : null">Status</x-table.heading>
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
                <x-table.cell class="uppercase font-bold text-xs"><x-stages :count="3" :stage="$service->getStatusIndex() - 1" /></x-table.cell>
                <x-table.cell class="uppercase font-bold text-xs">
                    @if ($service->isApprovalPending())
                        <x-badge class="bg-gray-500 text-white" label="pending"/>
                    @else
                        <x-badge :label="$service->persetujuan_service->status_persetujuan" 
                            class="text-white {{$service->persetujuan_service->status_persetujuan === 'setuju' ? 'bg-green-500' : 'bg-red-500'}}"/>
                    @endif
                </x-table.cell>
                <x-table.cell class="uppercase font-bold text-xs">
                    @if ($service->isPaymentPending())
                        <x-badge class="bg-gray-500 text-white" label="Belum"/>
                    @else
                        <x-badge label="sudah" class="text-white bg-green-500"/>
                    @endif
                </x-table.cell>
                <x-table.cell class="space-x-2 flex">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-white hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                <x-icons.more class="h-4"/>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-dropdown-link class="flex items-center gap-3"
                                href="{{ route('services.show', $service->id) }}"    
                            ><x-icons.eye class="h-4"/> <span>Detil</span></x-dropdown-link>
                            <x-dropdown-link class="flex items-center gap-3"
                                href="{{ route('services.edit', $service->id) }}"    
                            ><x-icons.edit class="h-4"/> <span>Edit</span></x-dropdown-link>
                            <form class="" action="{{route('services.destroy', $service->id)}}" method="POST">
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
        {{ $services->links() }}
    </div>
    
<div>



