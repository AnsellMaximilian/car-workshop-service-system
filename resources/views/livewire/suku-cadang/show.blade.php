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
        <div class="mb-4 flex gap-4 justify-end">
            <a href="{{ route('suku-cadangs.edit', $sukuCadang->id)}}">
                <x-icons.edit class="h-6 hover:fill-gray-600"/>
            </a>
            <form action="{{ route('suku-cadangs.destroy', $sukuCadang->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>
                    <x-icons.trash class="h-6 hover:fill-gray-600"/>
                </button>
            </form>
        </div>
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
        <div>
            <h3 class="uppercase font-bold mb-2">Kontrol Stok</h3>
            <div class="flex gap-2">
                <div class="flex gap-4 flex-1">
                    <div class="flex-1">
                        <x-input placeholder="Pemasukkan" type="number" class="block w-full" wire:model="jumlah_pemasukkan"/>
                        <textarea
                            id="keterangan-pemasukkan"
                            name="keterangan-pemasukkan"
                            placeholder="Keterangan"
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >{{old('keterangan-pemasukkan')}}</textarea>
                    </div>
                    <x-button overrideBgClasses="bg-green-500 hover:bg-green-600 active:bg-gray-900" wire:click="addToStock">Terima</x-button>
                </div>
                <div class="flex gap-4 flex-1">
                    <div class="flex-1">
                        <x-input placeholder="Pengeluaran" type="number" class="block w-full" wire:model="jumlah_pengeluaran"/>
                        <textarea
                            id="keterangan-pengeluaran"
                            name="keterangan-pengeluaran"
                            placeholder="Keterangan"
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >{{old('keterangan-pengeluaran')}}</textarea>
                    </div>
                    <x-button overrideBgClasses="bg-red-500 hover:bg-red-600 active:bg-gray-900" wire:click="removeFromStock">Keluar</x-button>
                </div>
            </div>
        </div>
    </x-card>

</div>

