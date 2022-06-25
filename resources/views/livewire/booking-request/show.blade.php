<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Pendaftaran ').$booking->id }}
        </h2>
    </x-slot>

    <div class="mb-4">
        <x-icon-link href="{{ route('services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 bg-white shadow-md overflow-hidden sm:rounded-lg flex">
            <div class="p-2 grow flex gap-2">
                @if ($booking->pendaftaran_service)
                <a href="{{route('pendaftaran-services.show', $booking->pendaftaran_service->id)}}">
                    <x-button>
                        {{ __('Pendaftaran') }}
                    </x-button>
                </a>
                @endif
            </div>
            <div class="border-l border-gray-300 flex">
                {{-- <div class="flex items-center py-2 px-3 text-xs uppercase rounded-tr-full rounded-br-full {{ true ? 'bg-gray-200 text-primary font-bold' : 'text-gray-400 font-semibold' }}">Persetujuan</div> --}}
                <div class="flex items-center py-2 px-3 text-xs uppercase {{ $booking->pendaftaran_service ? 'bg-gray-200 text-primary font-bold' : 'text-gray-400 font-semibold' }}">Pendaftaran</div>
            </div>
        </div>
        <x-card class="col-span-12">
            <div class="grid grid-cols-12 gap-4">
                <h2 class="font-semibold text-lg col-span-12">Info Request</h2>

                <div class="col-span-6">
                    <div class="font-semibold">Nama</div>
                    <div class="">{{$booking->nama}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Email</div>
                    <div class="">{{$booking->email}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">No. Telp</div>
                    <div class="">{{$booking->no_telp}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">No. Plat</div>
                    <div class="">{{$booking->no_plat}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Waktu Request</div>
                    <div class="">{{ \Carbon\Carbon::parse($booking->waktu_request)->format('d M, Y - H:i:s')}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Waktu Booking</div>
                    <div class="">{{ \Carbon\Carbon::parse($booking->waktu_booking)->format('d M, Y - H:i:s')}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Keluhan</div>
                    <div class="">{{$booking->keluhan}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-semibold">Pernah Service</div>
                    <div class="">{{$booking->pernah_service ? "Sudah" : "Belum"}}</div>
                </div>
            </div>
            @if(!$booking->pendaftaran_service)
                <hr class="my-4">
                @if ($registeredPelanggan)
                <div>
                    <h2 class="font-semibold text-lg col-span-12 mb-4">Pelanggan Sudah Terdaftar</h2>
                    @if (session()->has('error'))
                        <div class="px-4 py-2 rounded-md bg-red-200 text-red-700 mb-2">{{session()->get('error')}}</div>
                    @endif
                    <div>Pelanggan #{{$registeredPelanggan->id}} - <a href="{{route('pelanggans.show', $registeredPelanggan->id)}}" class="underline text-primary">{{$registeredPelanggan->nama}}</a></div>
                    
                </div>
                @else
                <div>
                    <h2 class="font-semibold col-span-12 mb-4">Pelanggan Belum Terdaftar</h2>
                    {{-- <h3>P</h3> --}}
                </div>
                @endif
                <div class="flex items-center justify-end col-span-12 mt-4">
                    <x-button class="ml-4" wire:click="savePendaftaran">
                        {{ __('Buat Pendaftaran') }}
                    </x-button>
                </div>
            @endif
            {{-- @if(!$booking->pendaftaran_service)
            <hr class="my-4">
            <div>
                <h2 class="font-semibold text-lg col-span-12 mb-4">Info Pelanggan</h2>
                @if (session()->has('error'))
                    <div class="px-4 py-2 rounded-md bg-red-200 text-red-700 mb-2">{{session()->get('error')}}</div>
                @endif
                <div class="col-span-6 flex flex-col mb-4">
                    <x-label value="Pelanggan Lama atau Baru" />
                    <div class="flex grow items-center gap-4 mt-1">
                        <div class="flex gap-2">
                            <input type="radio" id="pelanggan-baru" value="baru" wire:model="pelangganMode">
                            <x-label for="pelanggan-baru" value="Baru" />
                        </div>
                        <div class="flex gap-2">
                            <input type="radio" id="pelanggan-lama" value="lama" wire:model="pelangganMode">
                            <x-label for="pelanggan-lama" value="Lama" />
                        </div>
                    </div>
                </div>
                <div>
                    @if($pelangganMode === 'lama')
                    <div>
                        <div class="col-span-6">
                            <x-label for="pelanggan_id" value="Pelanggan" />
                            <select
                                name="pelanggan_id" 
                                id="pelanggan_id" 
                                wire:model="pelangganId"
                                class="mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($pelanggans as $pelanggan)
                                    <option 
                                        value="{{ $pelanggan->id }}" 
                                        {{ old('pelanggan_id') === $pelanggan->id  ? 'selected' : '' }}
                                    >{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    <div>
                        @if($booking->pelanggan)
                        <div>
                            <x-label value="Dibuat Berdasarkan Info Request" />
                            <div>
                                {{$booking->pelanggan->nama}}
                            </div>
                        </div>
                        @else
                        <div class="">
                            <x-label value="Buat Berdasarkan Info Request" />
                            <x-secondary-button class="mt-1" wire:click="savePelanggan">
                                {{ __('Buat') }}
                            </x-secondary-button>
                        </div>
                        @endif
                    </div>
                    @endif
                    <div class="flex items-center justify-end col-span-12 mt-4">
                        <x-button class="ml-4" wire:click="savePendaftaran">
                            {{ __('Buat Pendaftaran') }}
                        </x-button>
                    </div>
                </div>
            </div>
            @endif --}}
        </x-card>
    </div>
</div>
