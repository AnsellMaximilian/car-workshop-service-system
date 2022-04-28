<div>
    @section('title', 'Faktur Service '.$fakturService->id.' - '.$fakturService->service->pendaftaran_service->pelanggan->nama)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faktur Service') }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('services.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <div class="bg-white shadow-md overflow-hidden sm:rounded-lg flex mb-4">
        <div class="p-2 grow flex gap-2">
            <x-button onclick="window.print()">
                Print
            </x-button>
            @if($fakturService->service->canBePaid() && $fakturService->service->isPaymentPending())<x-button wire:click="setPaymentModalState(true)">Catat Pembayaran</x-button>@endif
            <a href="{{route('services.show', $fakturService->service->id)}}">
                <x-secondary-button>
                    Service
                </x-secondary-button>
            </a>
        </div>
    </div>
    <x-card class="mb-4">
        <div class="print-out relative">
            <div class="mb-4">
                <x-print-header :config="$config"/>
                <div class="grid grid-cols-12">
                    <div class="text-2xl font-semibold mb-4 col-span-12">
                        Tangerang, {{ \Carbon\Carbon::parse($fakturService->tanggal)->format('d-m-Y') }}
                    </div>
                    <div class="col-span-6">
                        <div class="mb-4">
                            <div class="font-bold text-lg">Invoice Kepada</div>
                        </div>
                        <div class="mb-4 grid grid-cols-12">
                            <div class="col-span-4">Pemilik</div>
                            <div class="font-semibold col-span-8">: {{ $fakturService->service->pendaftaran_service->pelanggan->nama }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-12">
                            <div class="col-span-4">No. Plat</div>
                            <div class="font-semibold col-span-8">: {{ $fakturService->service->pendaftaran_service->no_plat }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-12">
                            <div class="col-span-4">Kasir</div>
                            <div class="font-semibold col-span-8">: {{ $fakturService->service->pendaftaran_service->user->name }}</div>
                        </div>
                    </div>
                    <div class="col-span-6 text-right border-l-2 border-primary">
                        <div class="mb-4">
                            <div class="font-bold text-lg">Transfer atau Cash</div>
                        </div>
                        <div class="mb-4 grid grid-cols-12">
                            <div class="col-span-2 col-start-5 text-left">BCA:</div>
                            <div class="font-semibold col-span-6">{{ $config->rekening_bca }}</div>
                        </div>
                        <div class="mb-4 grid grid-cols-12">
                            <div class="col-span-2 col-start-5 text-left">BNI:</div>
                            <div class="font-semibold col-span-6">{{ $config->rekening_bni }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-2xl font-bold">
                Faktur No. {{ $fakturService->service->id }}
            </div>
            <hr class="my-4">
            {{-- PENJUALAN SERVIS --}}
            @if (!$fakturService->service->isPenjualanServiceEmpty())
            <div class="">
                <h3 class="font-semibold text-lg uppercase mb-4">Penjualan Servis</h3>
                <div class="mb-4 border-l border-r border-primary" >
                    <div class="bg-primary text-white grid grid-cols-12 py-2 font-semibold gap-4">
                        <div class="col-span-4 px-4">Jenis Service</div>
                        <div class="col-span-2 px-4">Harga</div>
                        <div class="col-span-2 px-4">Jumlah</div>
                        <div class="col-span-4 px-4">Subtotal</div>
                    </div>
                    @foreach ($fakturService->service->penjualan_services as $penjualanService)
                        <div class="border-b border-primary grid grid-cols-12 py-2 gap-4">
                            <div class="col-span-4 px-4">{{$penjualanService->jenis_service->nama}}</div>
                            <div class="col-span-2 px-4">{{$penjualanService->harga}}</div>
                            <div class="col-span-2 px-4">{{$penjualanService->jumlah}}</div>
                            <div class="col-span-4 px-4">{{$penjualanService->getTotal()}}</div>
                        </div>
                    @endforeach
                </div>
    
                <div class="grid grid-cols-12 py-2 gap-4">
                    <div class="col-span-4 col-start-5 uppercase font-bold pl-4">TOTAL SERVICE</div>
                    <div class="col-span-4 col-start-9 pl-4">{{ $fakturService->service->getTotalPenjualanServices()}}</div>
                </div>
            </div>
            <hr class="my-4">
            @endif
            {{-- SUKU CADANG --}}
            @if (!$fakturService->service->isPenggantianSukuCadangEmpty())
            <div class="">
                <h3 class="font-semibold text-lg uppercase mb-4">Penggantian Suku Cadang</h3>
                <div class="mb-4 border-l border-r border-primary" >
                    <div class="bg-primary text-white grid grid-cols-12 py-2 font-semibold gap-4">
                        <div class="col-span-4 px-4">Suku Cadang</div>
                        <div class="col-span-2 px-4">Harga</div>
                        <div class="col-span-2 px-4">Jumlah</div>
                        <div class="col-span-4 px-4">Subtotal</div>
                    </div>
                    @foreach ($fakturService->service->penggantian_suku_cadangs as $penggantianSukuCadang)
                        <div class="border-b border-primary grid grid-cols-12 py-2 gap-4">
                            <div class="col-span-4 px-4">{{$penggantianSukuCadang->suku_cadang->nama}}</div>
                            <div class="col-span-2 px-4">{{$penggantianSukuCadang->harga}}</div>
                            <div class="col-span-2 px-4">{{$penggantianSukuCadang->jumlah}}</div>
                            <div class="col-span-4 px-4">{{$penggantianSukuCadang->getTotal()}}</div>
                        </div>
                    @endforeach
                </div>
    
                <div class="grid grid-cols-12 py-2 gap-4">
                    <div class="col-span-4 col-start-5 uppercase font-bold pl-4">TOTAL PENGGANTIAN</div>
                    <div class="col-span-4 col-start-9 pl-4">{{ $fakturService->service->getTotalPenggantianSukuCadangs()}}</div>
                </div>
            </div>
            <hr class="my-4">
            @endif
    
            <div class="grid grid-cols-12 py-2 gap-4">
                <div class="col-span-12 border-t-8 border-primary"></div>
                <div class="col-span-4 col-start-5 uppercase font-bold text-xl pl-4">Grandtotal</div>
                <div class="col-span-4 col-start-9 text-xl pl-4">{{ $fakturService->service->getGrandTotal()}}</div>
            </div>
        </div>

    </x-card>

    {{-- MODAL PEMBAYARAN --}}
    <x-modal :entangled="true" entangleKey="isPaymentModalOpen"
        containerClasses=""
    >
        <x-slot name="trigger"></x-slot>
        <div class="w-[32rem] max-w-full">
            <h2 class="font-semibold p-4 border-b mb-2 border-gray-400 text-lg">Pembayaran</h2>
            <div class="p-4 border-b border-gray-400">
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
               @if ($tipePembayaran === 'debit')
               <div class="mb-4">
                <x-label for="buktiPembayaran" value="Bukti Pembayaran" />
                <x-input
                    type="file" 
                    class="mt-1"
                    wire:model="buktiPembayaran"
                    id="buktiPembayaran" 
                    accept=".jpg,.png,.jpeg"/>
            </div>
               @endif
                <div class="mb-4">
                    <x-label for="keteranganPembayaran" value="Keterangan" />
                    <textarea 
                        id="keteranganPembayaran" 
                        wire:model="keteranganPembayaran" 
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    ></textarea>
                </div>
            </div>
            <div class="flex p-4">
                <x-button  wire:click="savePembayaran">Catat Persetujuan</x-button>
                <x-button wire:click="setPaymentModalState(false)" 
                    overrideBgClasses="bg-transparent text-primary hover:text-red-800">Cancel</x-button>
            </div>
        </div>
    </x-modal>

</div>

