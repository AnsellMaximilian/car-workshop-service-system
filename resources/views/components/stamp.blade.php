@props(['label' => 'STAMPED', 'color' => 'red'])

@php
switch($color) {
    case 'green':
        $colorClasses = 'text-green-700 border-green-700';
        break;
    default:
        $colorClasses = 'text-red-700 border-red-700';
        break;
}
@endphp

<div class="absolute left-0 top-0 w-full h-full flex items-center justify-center">
    <div class="text-6xl md:text-8xl font-bold z-20 border-8 rounded-md py-1 px-4 rotate-45 {{ $colorClasses }}">
        {{ $label }}
    </div>
    <div class="absolute left-0 top-0 w-full h-full bg-gray-300 opacity-50 "></div>
</div>