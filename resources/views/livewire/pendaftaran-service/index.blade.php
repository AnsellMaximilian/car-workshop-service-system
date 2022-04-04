
<div class="space-y-2">
    <div class="flex gap-2">
        <div class="flex gap-1 flex-col">
            <x-label for="status" value="Service" />
            <select id="status" 
                wire:model="contSort"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="semua">Semua</option>
                <option value="lanjut">Lanjut</option>
                <option value="belum">Belum</option>
            </select>
        </div>
    </div>
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
        <a href="{{ route('pendaftaran-services.create') }} ">
            <x-button type="button">Daftar Service</x-button>
        </a>
        
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('waktu_pendaftaran')" sortable :sortDir="$sortField === 'waktu_pendaftaran' ? $sortDir : null">Waktu Daftar</x-table.heading>
            <x-table.heading wire:click="setSort('no_plat')" sortable :sortDir="$sortField === 'no_plat' ? $sortDir : null">No. Plat</x-table.heading>
            <x-table.heading>Pelanggan</x-table.heading>
            <x-table.heading wire:click="setSort('keluhan')" sortable :sortDir="$sortField === 'keluhan' ? $sortDir : null">Keluhan</x-table.heading>
            <x-table.heading>Service</x-table.heading>
            <x-table.heading>Aksi</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($pendaftaranServices as $pendaftaranService)
            <x-table.row wire:key="{{$pendaftaranService->id}}">
                <x-table.cell>{{ $pendaftaranService->id }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->waktu_pendaftaran }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->no_plat }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->pelanggan->nama }}</x-table.cell>
                <x-table.cell>{{ $pendaftaranService->keluhan }}</x-table.cell>
                <x-table.cell>
                    @if ($pendaftaranService->isContinued())
                    <x-badge label="lanjut" class="bg-green-500 text-white uppercase text-xs" />
                    @else
                    <x-badge label="belum" class="bg-gray-500 text-white uppercase text-xs" />
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
                                href="{{ route('pendaftaran-services.show', $pendaftaranService->id) }}"    
                            ><x-icons.eye class="h-4"/> <span>Detil</span></x-dropdown-link>

                            @if ($pendaftaranService->isContinued())
                            <x-dropdown-link class="flex items-center gap-3"
                                href="{{ route('services.show', $pendaftaranService->service->id) }}"    
                            ><x-icons.gear class="h-4"/> <span>Service</span></x-dropdown-link>
                            @else
                            <form action="{{route('services.store')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$pendaftaranService->id}}" name="pendaftaran_service_id">
                                <button type="submit" class="with-cont-conf w-full flex items-center gap-3 px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" >
                                    <x-icons.gear class="h-4"/> <span>Lanjut Service</span>
                                </button>
                            </form>
                            @endif

                            <form class="" action="{{route('pendaftaran-services.destroy', $pendaftaranService->id)}}" method="POST">
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
        {{ $pendaftaranServices->links() }}
    </div>
    
<div>



