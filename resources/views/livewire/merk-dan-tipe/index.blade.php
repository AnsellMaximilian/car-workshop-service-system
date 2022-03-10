<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Merk dan Tipe Kendaraan') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-6 space-y-2">
            <div class="flex justify-between gap-2">
                <h3 class="font-semibold text-lg uppercase">Tipe</h3>
                <x-modal :entangled="true" entangleKey="isTipeModalOpen">
                    <x-slot name="trigger">
                        <x-button type="button" wire:click="setEditMode('tipe', false)">Tambah Tipe</x-button>
                    </x-slot>
                    <div>
                        <h3 class="font-semibold text-lg uppercase mb-4">
                            {{ $isTipeEditMode && $tipeToEditId ? 'Edit Tipe '.$tipeToEditId : 'Daftar Tipe Baru'}}
                        </h3>

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form class="grid grid-cols-12 gap-4" 
                            @if ($isTipeEditMode)
                            wire:submit.prevent="updateTipe"
                            @else
                            wire:submit.prevent="storeTipe"
                            @endif
                        >
                            @csrf
                            <div class="col-span-6">
                                <x-label for="tipe" :value="__('Tipe')" />
                                <x-input id="tipe" class="block mt-1 w-full" type="text" wire:model="tipe" :value="old('tipe')" required autofocus />
                            </div>

                            <div class="col-span-6">
                                <x-label for="merk_id" value="Merk" />
                                <select 
                                    wire:model="merk_id"
                                    id="merk_id" 
                                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                >
                                    @foreach ($merks as $merk)
                                        <option 
                                            value="{{ $merk->id }}" 
                                            {{-- {{ old('merk_id') === $merk->id  ? 'selected' : '' }} --}}
                                        >{{ $merk->merk }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center justify-end col-span-12">
                                <x-button class="ml-4">
                                    {{ $isTipeEditMode ? 'Perbaharui' : __('Daftar Tipe') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </x-modal>
                
            </div>
            <x-table.wrapper>
                <x-slot name="head">
                    <x-table.heading wire:click="setSortTipe('id')" sortable :sortDir="$tipeSortField === 'id' ? $tipeSortDir : null">ID</x-table.heading>
                    <x-table.heading wire:click="setSortTipe('tipe')" sortable :sortDir="$tipeSortField === 'tipe' ? $tipeSortDir : null">Tipe</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
        
                </x-slot>
                <x-slot name="body">
                    @foreach ($tipes as $tipe)
                    <x-table.row>
                        <x-table.cell>{{ $tipe->id }}</x-table.cell>
                        <x-table.cell>{{ $tipe->tipe }}</x-table.cell>
                        <x-table.cell class="space-x-2 flex">
                            <button class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                                wire:click="editTipe({{ $tipe->id }})"
                            >Edit</button>
                            <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                                wire:click="destroyTipe({{ $tipe->id }})"
                            >Delete</button>
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
        
            </x-table.wrapper>
        </div>

        <div class="col-span-6 space-y-2">
            <div class="flex justify-between gap-2">
                <h3 class="font-semibold text-lg uppercase">Merk</h3>
                <x-modal :entangled="true" entangleKey="isMerkModalOpen">
                    <x-slot name="trigger">
                        <x-button type="button">Tambah Merk</x-button>
                    </x-slot>
                    <div>
                        <h3 class="font-semibold text-lg uppercase mb-4">
                            {{ $isMerkEditMode && $merkToEditId ? 'Edit Merk '.$merkToEditId : 'Daftar Merk Baru'}}
                        </h3>

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form class="" 
                            @if ($isMerkEditMode)
                            wire:submit.prevent="updateMerk"
                            @else
                            wire:submit.prevent="storeMerk"
                            @endif
                        >
                            @csrf
                            <div class="mb-4">
                                <x-label for="merk" :value="__('Merk')" />
                                <x-input id="merk" class="block mt-1 w-full" type="text" wire:model="merk" :value="old('merk')" required autofocus />
                            </div>

                            <div class="flex items-center justify-end col-span-12">
                                <x-button class="ml-4">
                                    {{ $isMerkEditMode ? 'Perbaharui' : __('Daftar Merk') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </x-modal>
                
            </div>
            <x-table.wrapper>
                <x-slot name="head">
                    <x-table.heading wire:click="setSortMerk('id')" sortable :sortDir="$merkSortField === 'id' ? $merkSortDir : null">ID</x-table.heading>
                    <x-table.heading wire:click="setSortMerk('merk')" sortable :sortDir="$merkSortField === 'merk' ? $merkSortDir : null">Merk</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
        
                </x-slot>
                <x-slot name="body">
                    @foreach ($merks as $merk)
                    <x-table.row>
                        <x-table.cell>{{ $merk->id }}</x-table.cell>
                        <x-table.cell>{{ $merk->merk }}</x-table.cell>
                        <x-table.cell class="space-x-2 flex">
                            <button class="uppercase text-blue-600 hover:text-blue-800 font-semibold cursor-pointer"
                                wire:click="editMerk({{ $merk->id }})"
                            >Edit</button>
                            <button class="uppercase text-red-600 hover:text-red-800 font-semibold cursor-pointer"
                                wire:click="destroyMerk({{ $merk->id }})"
                            >Delete</button>
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
        
            </x-table.wrapper>
        </div>
    </div>
    
<div>



