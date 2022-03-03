<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Suku Cadang '.$sukuCadang->id }}
        </h2>
    </x-slot>
    <x-card>
        {{-- <h1 class="font-semibold mb-4 text-2xl">Detail Suku Cadang</h1> --}}
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 flex">
                <div class="font-bold uppercase mr-4">
                    Nama
                </div>
                <div>
                    {{ $sukuCadang->nama }}
                </div>
            </div>
            <div class="col-span-6 flex">
                <div class="font-bold uppercase mr-4">
                    Harga
                </div>
                <div>
                    {{ $sukuCadang->harga }}
                </div>
            </div>

            <div class="col-span-6">
                <div class="font-bold uppercase mb-4">
                    Stok
                </div>
                <div class="text-4xl font-bold">
                    {{ $sukuCadang->getCurrentStock() }}
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="grid grid-cols-12 gap-4">
            <h3 class="uppercase font-bold col-span-12">Kontrol Stok</h3>
            <div class="col-span-12 lg:col-span-6 flex gap-4">
                <x-input placeholder="Penerimaan" type="number"/>
                <x-button class="bg-green-500 hover:bg-green-600">Terima</x-button>
            </div>
            <div class="col-span-12 lg:col-span-6 flex gap-4">
                <x-input placeholder="Pengeluaran" type="number"/>
                <x-button class="bg-red-500">Keluar</x-button>
            </div>
        </div>
    </x-card>

</div>

