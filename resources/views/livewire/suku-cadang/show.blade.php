<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Suku Cadang '.$sukuCadang->id }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('suku-cadangs.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

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
                    {{ $sukuCadang->current_stock }}
                </div>
            </div>
            <div class="col-span-6">
                <div>
                    <div>Stok awal: {{ $sukuCadang->stok_awal }}</div>
                    <div>Pemasukkan: {{ $sukuCadang->getTotalPemasukkan() }}</div>
                    <div>Pengeluaran: {{ $sukuCadang->getTotalPengeluaran() }}</div>
                    <div>Penggantian: {{ $sukuCadang->getTotalPenggantian() }}</div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="grid grid-cols-12 gap-4">
            <h3 class="uppercase font-bold col-span-12">Kontrol Stok</h3>
            <div class="col-span-12 lg:col-span-4 flex gap-4">
                <x-input placeholder="Pemasukkan" type="number" class="block min-w-0" wire:model="jumlah_pemasukkan"/>
                <x-button overrideBgClasses="bg-green-500 hover:bg-green-600 active:bg-gray-900" wire:click="addToStock">Terima</x-button>
            </div>
            <div class="col-span-12 lg:col-span-4 flex gap-4">
                <x-input placeholder="Pengeluaran" type="number" class="block min-w-0" wire:model="jumlah_pengeluaran"/>
                <x-button overrideBgClasses="bg-red-500 hover:bg-red-600 active:bg-gray-900" wire:click="removeFromStock">Keluar</x-button>
            </div>
        </div>
    </x-card>

</div>

