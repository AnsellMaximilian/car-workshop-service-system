@props(['label'])
<span {{ $attributes->merge(['class' => 'rounded-full inline-block px-2 font-semibold shadow']) }}>{{ $label }}</span>