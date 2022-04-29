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
            <x-card class="max-w-3xl mx-auto h-full">
                <h3 class="text-3xl font-bold text-center">Terima Kasih</h3>
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
