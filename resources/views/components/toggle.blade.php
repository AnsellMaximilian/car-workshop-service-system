@props(['state' => false])

@php
    if($state){
        $containerClasses = 'bg-green-500';
        $toggleClasses = 'right-0 ';
    }else {
        $containerClasses = 'bg-red-500';
        $toggleClasses = 'left-0 ';

    }
@endphp

<div {{ $attributes->merge(['class' => 'rounded-full w-14 h-8 cursor-pointer relative shadow-lg '.$containerClasses]) }}

>
    <div class="rounded-full w-6 h-6 bg-white absolute top-1/2 -translate-y-1/2 shadow-md mx-1 {{ $toggleClasses }}"></div>
</div>