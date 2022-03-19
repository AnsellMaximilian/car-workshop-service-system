<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'User '.$user->id }}
        </h2>
    </x-slot>
    <div class="mb-4">
        <x-icon-link href="{{ route('users.index') }}" label="Kembali">
            <x-slot name="icon">
                <x-icons.left-arrow class="h-3 fill-primary group-hover:fill-red-800"/>
            </x-slot>
        </x-icon-link>
    </div>
    <x-card class="mb-8">
        <div class="mb-4 flex gap-4 justify-end">
            <a href="{{ route('users.edit', $user->id)}}">
                <x-icons.edit class="h-6 hover:fill-gray-600"/>
            </a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>
                    <x-icons.trash class="h-6 hover:fill-gray-600"/>
                </button>
            </form>
        </div>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-4">
                <div class="">
                    <img src="{{asset($user->getPhotoPath()) }}" alt="User Photo" 
                        class="rounded-full object-cover h-48 w-48">
                </div>
            </div>
            <div class="col-span-8 flex flex-col gap-4">
                <div>
                    <span class="font-bold text-2xl">{{$user->name }}</span>
                    <span>- {{$user->peran->nama_peran }}</span>
                </div>
                <div class="">
                    <div class="font-bold">
                        No. Telp
                    </div>
                    <div>
                        {{ $user->noTelp }}
                    </div>
                </div>
    
                <div class="">
                    <div class="font-bold">
                        Email
                    </div>
                    <div>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="">
                    <div class="font-bold">
                        Alamat
                    </div>
                    <div>
                        {{ $user->alamat }}
                    </div>
                </div>
            </div>

        </div>
    </x-card>

</x-app-layout>

