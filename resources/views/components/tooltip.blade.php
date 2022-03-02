@props(['align' => 'right'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'left-0 top-1/2 -translate-y-1/2 -translate-x-full';
        break;
    case 'top':
        $alignmentClasses = 'bottom-full left-1/2 -translate-x-1/2';
        break;
    case 'right':
        $alignmentClasses = 'left-full top-1/2 -translate-y-1/2';
        break;
    default:
        $alignmentClasses = '';
        break;
}
@endphp

<div {{ $attributes->merge(['class' => "absolute group-hover:block hidden shadow z-50 rounded py-1 px-2 ".$alignmentClasses]) }}>
    {{ $slot }}
</div>