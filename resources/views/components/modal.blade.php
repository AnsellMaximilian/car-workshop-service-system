<div class="mt-6" x-data="{ open: false }">
    
    {{-- Trigger Button --}}
    <button class="px-4 py-2 text-white bg-blue-500 rounded select-none no-outline focus:shadow-outline" @click="open = true">Open Modal</button>
    
    {{-- Modal Background --}}
    <div class="fixed top-0 left-0 flex items-center justify-center w-screen h-screen p-4" style="display: none; background-color: rgba(0,0,0,.5);" x-show="open"  >
        <div class="max-h-full overflow-auto h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">
            {{ $slot }}
        </div>
    </div>
</div>