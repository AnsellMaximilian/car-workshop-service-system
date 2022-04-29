
<div class="space-y-2">
    <div class="flex gap-2">
        <div class="flex gap-1 flex-col">
            <x-label for="waktu-booking" value="Tanggal Booking" />
            <x-input id="waktu-booking" class="block mt-1 w-full" type="date" wire:model="waktuBookingSort"/>
            
        </div>
    </div>
    <div class="flex justify-between gap-2">
        <x-input wire:model="query" class="block md:w-1/3 w-16 grow md:grow-0" type="text" placeholder="Search"/>
    </div>
    <x-table.wrapper>
        <x-slot name="head">
            <x-table.heading wire:click="setSort('id')" sortable :sortDir="$sortField === 'id' ? $sortDir : null">ID</x-table.heading>
            <x-table.heading wire:click="setSort('nama')" sortable :sortDir="$sortField === 'nama' ? $sortDir : null">Nama</x-table.heading>
            <x-table.heading wire:click="setSort('no_telp')" sortable :sortDir="$sortField === 'no_telp' ? $sortDir : null">No. Telp</x-table.heading>
            <x-table.heading wire:click="setSort('waktu_booking')" sortable :sortDir="$sortField === 'waktu_booking' ? $sortDir : null">Waktu Booking</x-table.heading>
            <x-table.heading wire:click="setSort('waktu_request')" sortable :sortDir="$sortField === 'waktu_request' ? $sortDir : null">Waktu Request</x-table.heading>
            <x-table.heading wire:click="setSort('no_plat')" sortable :sortDir="$sortField === 'no_plat' ? $sortDir : null">No. Plat</x-table.heading>
            <x-table.heading wire:click="setSort('pernah_service')" sortable :sortDir="$sortField === 'pernah_service' ? $sortDir : null">Pernah Service</x-table.heading>
            <x-table.heading>Didaftar</x-table.heading>
            <x-table.heading>Aksi</x-table.heading>

        </x-slot>
        <x-slot name="body">
            @foreach ($bookings as $booking)
            <x-table.row wire:key="{{$booking->id}}">
                <x-table.cell>{{ $booking->id }}</x-table.cell>
                <x-table.cell>{{ $booking->nama }}</x-table.cell>
                <x-table.cell>{{ $booking->no_telp }}</x-table.cell>
                <x-table.cell>{{ $booking->waktu_booking }}</x-table.cell>
                <x-table.cell>{{ $booking->waktu_request }}</x-table.cell>
                <x-table.cell>{{ $booking->no_plat }}</x-table.cell>
                <x-table.cell>
                    @if ($booking->pernah_service)
                    <x-badge label="sudah" class="bg-green-500 text-white uppercase text-xs" />
                    @else
                    <x-badge label="belum" class="bg-gray-500 text-white uppercase text-xs" />
                    @endif
                </x-table.cell>
                <x-table.cell>
                    @if ($booking->pendaftaran_service)
                    <x-badge label="sudah" class="bg-green-500 text-white uppercase text-xs" />
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
                                href="{{ route('bookings.show', $booking->id) }}"    
                            ><x-icons.eye class="h-4"/> <span>Detil</span></x-dropdown-link>

                            <form class="" action="{{route('bookings.destroy', $booking->id)}}" method="POST">
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
        {{ $bookings->links() }}
    </div>
    
<div>



