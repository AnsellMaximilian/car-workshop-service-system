@props(['label' => 'Link'])


<a {{ $attributes->merge(['class' => 'group text-primary hover:text-red-800 font-semibold inline-flex items-baseline']) }}>
    {{ $icon }}
    <span>{{ $label }}</span>
</a>