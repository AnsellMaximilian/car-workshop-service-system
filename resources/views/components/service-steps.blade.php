@props(['status' => 'cek'])

@php
    $trueClasses = 'bg-green-600';
    $falseClasses = 'bg-gray-700';
    switch ($status) {
        case 'cek':
            $step = 1;
            $lineWidth = '';
            break;
        case 'service':
            $step = 2;
            $lineWidth = 'w-1/2';
            break;
        case 'selesai':
            $step = 3;
            $lineWidth = 'w-full';
            break;
        default:
            $step = 1;
            break;
    }
@endphp

<div {{$attributes->merge(['class' => ''])}}>
    <div class="pt-4 pb-10">
        <div class="relative h-1 bg-gray-700">
            <div class="absolute bg-green-600 {{ $lineWidth }} h-1 top-1/2 -translate-y-1/2"></div>
            <div class="cursor-pointer absolute left-0 top-1/2 -translate-y-1/2 rounded-full h-6 w-6 flex items-center justify-center {{ $step >= 1 ? $trueClasses : $falseClasses}}">
                <div class="rounded-full h-2 w-2 bg-white"></div>
                <div class="absolute label-text bottom-0 translate-y-full left-0">Dicek</div>
            </div>
            <div class="cursor-pointer absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 rounded-full h-6 w-6 bg-gray-700 flex items-center justify-center {{ $step >= 2 ? $trueClasses : $falseClasses}}">
                <div class="rounded-full h-2 w-2 bg-white"></div>
                <div class="absolute label-text bottom-0 translate-y-full left-1/2 -translate-x-1/2">Diservice</div>
            </div>
            <div class="cursor-pointer absolute right-0 top-1/2 -translate-y-1/2 rounded-full h-6 w-6 bg-gray-700 flex items-center justify-center {{ $step >= 3 ? $trueClasses : $falseClasses}}">
                <div class="rounded-full h-2 w-2 bg-white"></div>
                <div class="absolute label-text bottom-0 translate-y-full right-0">Selesai</div>
            </div>
        </div>
    </div>
</div>