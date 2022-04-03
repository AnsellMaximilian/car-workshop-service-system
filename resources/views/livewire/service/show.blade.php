 <div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service ').$service->id }}
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
            <div class="p-2 grow">
                @if($service->isApprovalPending())<x-button>Catat Persetujuan</x-button>@endif
                @if($service->isPaymentPending())<x-button>Catat Pembayaran</x-button>@endif
            </div>
            <div class="border-l border-gray-300 flex">
                <div class="flex items-center py-2 px-3 text-xs uppercase rounded-tr-full rounded-br-full {{ $service->getCurrentStage() === 'persetujuan' ? 'bg-gray-200 text-primary font-bold' : 'text-gray-400 font-semibold' }}">Persetujuan</div>
                <div class="flex items-center py-2 px-3 text-xs uppercase rounded-tr-full rounded-br-full {{ $service->getCurrentStage() === 'pembayaran' ? 'bg-gray-200 text-primary font-bold' : 'text-gray-400 font-semibold' }}">Pembayaran</div>
                <div class="flex items-center py-2 px-3 text-xs uppercase {{ $service->getCurrentStage() === 'lunas' ? 'bg-gray-200 text-primary font-bold' : 'text-gray-400 font-semibold' }}">Lunas</div>
            </div>
        </div>
        <x-card class="col-span-8">
            <div class="grid grid-cols-12 gap-4">
                <h2 class="font-semibold text-lg col-span-12">Info Service</h2>

                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">Pelanggan</div>
                    <div class="font-bold">{{$service->pendaftaran_service->pelanggan->nama}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">No. Plat</div>
                    <div class="font-bold">{{$service->pendaftaran_service->no_plat}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">Waktu Pendaftaran</div>
                    <div class="font-bold">{{ \Carbon\Carbon::parse($service->pendaftaran_service->waktu_pendaftaran)->format('d M, Y - H:i:s')}}</div>
                </div>
                <div class="col-span-6">
                    <div class="font-medium text-gray-700 text-sm">Waktu Mulai</div>
                    <div class="font-bold">{{ \Carbon\Carbon::parse($service->waktu_mulai)->format('d M, Y - H:i:s')}}</div>
                </div>
                <div class="col-span-12">
                    <div class="font-medium text-gray-700 text-sm">Keluhan</div>
                    <div class="">{{$service->pendaftaran_service->keluhan}}</div>
                </div>
            </div>
            <hr class="my-4">
            <div>
                <h2 class="font-semibold mb-4 text-lg">Status</h2>
                <div>
                    <x-service-steps :status="$service->status_service" class="mb-4"/>
                </div>
            </div>
            <hr class="my-4">
            <div>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <h2 class="font-semibold mb-4 text-lg">Persetujuan</h2>
                @if ($service->isApprovalPending())
                <div>
                    <div>
                        <div class="label-text">Status Persetujuan</div>
                        <div class="flex gap-4 mb-4 mt-1">
                            <div class="flex items-center gap-2">
                                <x-input 
                                    wire:model="statusPersetujuan"
                                    type="radio" id="setuju-service" name="persetujuanService" value="setuju"/>
                                <x-label value="Setuju" for="setuju-service"/>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-input 
                                    wire:model="statusPersetujuan"
                                    type="radio" id="tolak-service" name="persetujuanService" value="tolak"/>
                                <x-label value="Tolak" for="tolak-service"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-label for="keteranganPersetujuan" value="Keterangan" />
                        <textarea 
                            id="keteranganPersetujuan" 
                            wire:model="keteranganPersetujuan" 
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        ></textarea>
                    </div>
                    <div class="flex">
                        <x-button class="ml-auto" wire:click="savePersetujuan">Catat Persetujuan</x-button>
                    </div>
                </div>
                @else
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <div class="label-text">Waktu Persetujuan</div>
                        <div class="">
                            {{\Carbon\Carbon::parse($service->persetujuan_service->waktu_persetujuan)->format('d M, Y - H:i:s')}}
                        </div>
                    </div>
                    <div class="mb-4 col-span-6">
                        <div class="label-text">Status Persetujuan</div>
                        <div class="font-bold uppercase">
                            @if ($service->persetujuan_service->status_persetujuan === 'setuju')
                                <x-icons.checkmark class="h-10 fill-green-500"/>
                            @else
                                <x-icons.cross class="h-10 fill-red-600"/>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="label-text">Keterangan Persetujuan</div>
                        <div class="">
                            {{$service->persetujuan_service->keterangan}}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </x-card>
        <x-card class="col-span-4 flex flex-col">
            <div>
                <h2 class="font-semibold mb-4 text-xl">Total</h2>
                <div class="flex justify-between">
                    <div class="font-semibold">Service</div>
                    <div>{{ $service->getTotalPenjualanServices()}}</div>
                </div>
                <div class="flex justify-between">
                    <div class="font-semibold">Suku Cadang</div>
                    <div>{{ $service->getTotalPenggantianSukuCadangs()}}</div>
                </div>

                <div class="flex justify-between mt-4">
                    <div class="font-bold uppercase">Total</div>
                    <div>{{$service->getGrandTotal()}}</div>
                </div>
            </div>
            <hr class="my-4">
            <div class="mb-4">
                <h2 class="font-semibold mb-4 text-xl">Pembayaran</h2>
                @if ($service->isPaymentPending())
                <div>
                    <div class="mb-4">
                        <x-label for="tanggalPembayaran" value="Tanggal Pembayaran" />
                        <x-input
                            type="date"
                            wire:model="tanggalPembayaran"
                            class="mt-1" 
                            id="tanggalPembayaran" />
                    </div>
                    <div class="mb-4">
                        <x-label for="tipePembayaran" value="Tipe Pembayaran" />
                        <select 
                            wire:model="tipePembayaran" 
                            id="tipePembayaran" 
                            class="rounded-md mt-1 shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option value="cash">Cash</option>
                            <option value="debit">Debit</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="buktiPembayaran" value="Bukti Pembayaran" />
                        <x-input
                            type="file" 
                            class="mt-1"
                            wire:model="buktiPembayaran"
                            id="buktiPembayaran" 
                            accept=".jpg,.png,.jpeg"/>
                    </div>
                    <div class="mb-4">
                        <x-label for="keteranganPembayaran" value="Keterangan" />
                        <textarea 
                            id="keteranganPembayaran" 
                            wire:model="keteranganPembayaran" 
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >{{old('keterangan')}}</textarea>
                    </div>
                    <div class="flex">
                        <x-button class="ml-auto" wire:click="savePembayaran">Catat Pembayaran</x-button>
                    </div>
                </div>
                @else
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <div class="label-text">Tanggal Pembayaran</div>
                        <div class="">
                            {{\Carbon\Carbon::parse($service->pembayaran->tanggal)->format('d M, Y')}}
                        </div>
                    </div>
                    <div class="col-span-12">
                        <div class="label-text">Tipe Pembayaran</div>
                        <div class="uppercase">
                            {{ $service->pembayaran->tipe_pembayaran}}
                        </div>
                    </div>
                    <div class="col-span-12">
                        <div class="label-text">Keterangan Pembayaran</div>
                        <div class="">
                            {{$service->pembayaran->keterangan}}
                        </div>
                    </div>
                    @if ($service->pembayaran->bukti_pembayaran)
                    <div class="col-span-12">
                        <div class="label-text">Bukti Pembayaran</div>
                        <div class="">
                            <img class="w-32 h-32 object-cover mt-1" src="{{asset('storage/'.$service->pembayaran->bukti_pembayaran)}}" alt="bukti pembayaran">
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="flex items-center justify-end mt-auto gap-4">
                <a href="{{route('services.destroy', $service->id)}}">
                    <x-icons.trash class="h-7 hover:fill-gray-700"/>
                </a>
                <a href="{{route('services.edit', $service->id)}}">
                    <x-icons.edit class="h-7 hover:fill-gray-700"/>
                </a>
            </div>
        </x-card>

        <x-card class="col-span-12">
            <h2 class="font-semibold mb-4 text-xl">Pemeriksaan Standar</h2>
            <div class="grid grid-cols-12">
                @foreach ($pemeriksaanStandars as $key => $pemeriksaanStandar)
                    <div class="col-span-3 flex gap-4 items-center">
                        @if ($service->pelaksanaan_pemeriksaans()->where('pemeriksaan_standar_id', $pemeriksaanStandar->id)->first())
                        <x-icons.checkbox-ticked class="h-5"/>
                        @else
                        <x-icons.checkbox-unticked class="h-5"/>
                        @endif
                        <x-label :value="$pemeriksaanStandar->nama" :for="$pemeriksaanStandar->id"/>
                    </div>
                @endforeach
            </div>

        </x-card>

        <x-card class="col-span-12">
            <h2 class="font-semibold mb-4 text-xl">Jasa Service</h2>
            <x-table.wrapper class="shadow-lg">
                <x-slot name="head">
                    <x-table.heading class="bg-primary text-white">Jenis Service</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Harga</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Jumlah</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Subtotal</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($service->penjualan_services as $penjualanService)
                    <x-table.row>
                        <x-table.cell>{{ $penjualanService->jenis_service->nama }}</x-table.cell>
                        <x-table.cell>{{ $penjualanService->harga }}</x-table.cell>
                        <x-table.cell>{{ $penjualanService->jumlah }}</x-table.cell>
                        <x-table.cell>{{ $penjualanService->getTotal() }}</x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table.wrapper>
        </x-card>
        <x-card class="col-span-12">
            <h2 class="font-semibold mb-4 text-xl">Penggantian Suku Cadang</h2>
            <x-table.wrapper class="shadow-lg">
                <x-slot name="head">
                    <x-table.heading class="bg-primary text-white">Suku Cadang</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Harga</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Jumlah</x-table.heading>
                    <x-table.heading class="bg-primary text-white">Subtotal</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($service->penggantian_suku_cadangs as $penggantianSukuCadang)
                    <x-table.row>
                        <x-table.cell>{{ $penggantianSukuCadang->suku_cadang->nama }}</x-table.cell>
                        <x-table.cell>{{ $penggantianSukuCadang->harga }}</x-table.cell>
                        <x-table.cell>{{ $penggantianSukuCadang->jumlah }}</x-table.cell>
                        <x-table.cell>{{ $penggantianSukuCadang->getTotal() }}</x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table.wrapper>
        </x-card>
    </div>
</div>
