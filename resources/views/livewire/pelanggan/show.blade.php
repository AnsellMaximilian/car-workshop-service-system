<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Pelanggan '.$pelanggan->id }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('pelanggans.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="mb-8">
        <div class="mb-4 flex gap-4 justify-end">
            <a href="{{ route('pelanggans.edit', $pelanggan->id)}}">
                <x-icons.edit class="h-6 hover:fill-gray-600"/>
            </a>
            <form action="{{ route('pelanggans.destroy', $pelanggan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>
                    <x-icons.trash class="h-6 hover:fill-gray-600"/>
                </button>
            </form>
        </div>
        <div class="font-bold text-2xl mb-4">
            {{ $pelanggan->nama }}
        </div>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6">
                <div class="font-bold">
                    No. Telp
                </div>
                <div>
                    {{ $pelanggan->noTelp }}
                </div>
            </div>

            <div class="col-span-6">
                <div class="font-bold">
                    Email
                </div>
                <div>
                    {{ $pelanggan->email }}
                </div>
            </div>
            <div class="col-span-6">
                <div class="font-bold">
                    Alamat
                </div>
                <div>
                    {{ $pelanggan->alamat }}
                </div>
            </div>

            <div class="col-span-6">
                <div class="font-bold">
                    Piutang
                </div>
                <div>
                    {{ $pelanggan->getTotalAR() }}
                </div>
            </div>
            
        </div>
    </x-card>

    <div>
        <h2 class="text-2xl font-bold mb-4">Transaksi Service</h2>
        <x-table.wrapper>
            <x-slot name="head">
                <x-table.heading >ID</x-table.heading>
                <x-table.heading >Daftar</x-table.heading>
                <x-table.heading >No. Plat</x-table.heading>
                <x-table.heading>Total</x-table.heading>
                <x-table.heading >Status Service</x-table.heading>
                <x-table.heading >Aksi</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach ($pelanggan->pendaftaran_services as $pendaftaran)
                <x-table.row>
                    <x-table.cell>{{ $pendaftaran->id }}</x-table.cell>
                    <x-table.cell>{{ $pendaftaran->waktu_pendaftaran }}</x-table.cell>
                    <x-table.cell>{{ $pendaftaran->no_plat }}</x-table.cell>
                    <x-table.cell>{{ $pendaftaran->service ? $pendaftaran->service->getGrandTotal() : '-' }}</x-table.cell>
                    <x-table.cell>
                        @if ($pendaftaran->getStatus() === 'selesai')
                        <x-badge label="selesai" 
                            class="text-white bg-green-500 uppercase"/>
                        @else
                        <x-badge class="{{$pendaftaran->getStatus() === 'belum' ? 'bg-gray-500' : 'bg-yellow-400'}} text-white uppercase" :label="$pendaftaran->getStatus()"/>
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
                                    href="{{ $pendaftaran->service ? route('services.show', $pendaftaran->service->id) : route('pendaftaran-services.show', $pendaftaran->id) }}"    
                                ><x-icons.eye class="h-4"/> <span>Detil {{$pendaftaran->service ? 'Service' : 'Pendaftaran'}}</span></x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
    
        </x-table.wrapper>
    </div>

</div>

