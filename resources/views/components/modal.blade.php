@props(['entangled' => false, 'entangleKey' => 'isModalOpen', 'containerClasses' => null])

@if ($entangled)
<div x-data="{ open: @entangle($entangleKey).defer }">
    
@else
<div x-data="{ open: false }">
    
@endif    
    {{-- Trigger Button --}}
    <div @click="open = true" class="h-full">
        {{ $trigger }}
    </div>
    
    {{-- Modal Background --}}
    <div class="fixed top-0 left-0 flex items-center justify-center w-screen h-screen p-4" style="display: none; background-color: rgba(0,0,0,.5);" x-show="open"  >
        <div class="max-h-full max-w-full overflow-auto h-auto text-left bg-white rounded shadow-xl {{ $containerClasses !== null ? $containerClasses : 'md:max-w-xl md:p-6 lg:p-8 md:mx-0 p-4 mx-2' }}" 
            @click.away="open = false"
        >
            {{ $slot }}
        </div>
    </div>
</div>


