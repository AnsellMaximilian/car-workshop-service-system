<x-guest-layout>
    
    <div class="flex flex-col min-h-screen">
        
        <header class="">
            <div class="p-4">
                <a href="/booking">
                    <img src="{{asset('images/sogojayalogo.png')}}" alt="Logo" class="w-52">
                </a>
            </div>
            <div class="bg-primary p-4">
                <h1 class="text-white text-2xl">Booking</h1>
            </div>
            
        </header>
        <main class="p-4 bg-gray-200 grow">
            <x-card class="max-w-3xl mx-auto">
                <h2 class="font-bold text-lg mb-4">Form Booking</h2>
                <x-auth-validation-errors :errors="$errors"/>
                <form method="POST" action="{{ route('booking.store') }}" class="grid grid-cols-12 gap-4">
                    @csrf
                    <div class="col-span-6">
                        <x-label for="nama" value="Nama Lengkap" />
                        <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required />
                    </div>
                    <div class="col-span-6">
                        <x-label for="email" value="Email" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>
                    <div class="col-span-6">
                        <x-label for="no_telp" value="No. Telp" />
                        <x-input id="no_telp" class="block mt-1 w-full" type="tel" name="no_telp" :value="old('no_telp')" required />
                    </div>
                    
                    <div class="col-span-6">
                        <x-label for="no_plat" value="No. Plat" />
                        <x-input id="no_plat" class="block mt-1 w-full" name="no_plat" type="text" :value="old('no_plat')" />
                    </div>

                    <div class="col-span-6">
                        <x-label for="waktu-booking" value="Waktu Booking" />
                        <x-input id="waktu-booking" class="block mt-1 w-full" type="datetime-local" name="waktu_booking" :value="old('waktu_booking')"/>
                    </div>

                    <div class="col-span-6 flex flex-col">
                        <x-label value="Pernah Service" />
                        <div class="flex grow items-center gap-4">
                            <div class="flex gap-2">
                                <input type="radio" id="sudah_pernah--sudah" name="pernah_service" value="sudah" {{ old('pernah_service') === 'sudah' ? 'checked' : '' }}>
                                <x-label for="sudah_pernah--sudah" value="Sudah" />
                            </div>
                            <div class="flex gap-2">
                                <input type="radio" id="sudah_pernah--belum" name="pernah_service" value="belum" {{ old('pernah_service') === 'belum' ? 'checked' : '' }}>
                                <x-label for="sudah_pernah--belum" value="Belum" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <x-label for="keluhan" value="Keluhan" />
                        <textarea
                            name="keluhan"
                            id="keluhan" 
                            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >{{ old('keluhan')}}</textarea>
                    </div>
                    <div class="flex items-center justify-end col-span-12">
                        <x-button class="ml-4">
                            {{ __('Request Daftar') }}
                        </x-button>
                    </div>
                </form>
            </x-card>
        </main>
        <footer class="grid grid-cols-12 gap-4 p-4 mt-auto">
            <div class="col-span-12 md:col-span-12 lg:col-span-4 mb-4 lg:mb-0">
                <div class="mb-4">
                    <a href="/booking">
                        <img src="{{asset('images/sogojayalogo.png')}}" alt="Logo" class="w-52">
                    </a>
                </div>
                <div>
                    Bengkel AC mobil dengan pengalaman lebih dari 30 tahun dan peralatan yang lengkap.
                </div>
            </div>
    
            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                <div class="text-lg font-semibold">Alamat</div>
                <div>{{$config->alamat}}</div>
            </div>
    
            <div class="col-span-12 md:col-span-4 lg:col-span-2">
                <div class="text-lg font-semibold">No. Telp</div>
                <div>{{$config->no_telp}}</div>
            </div>
    
            <div class="col-span-12 md:col-span-4 lg:col-span-2">
                <div class="text-lg font-semibold">No. Hp</div>
                <div>{{$config->hp_1}}</div>
                <div>{{$config->hp_2}}</div>
            </div>
        </footer>
    </div>
</x-guest-layout>
