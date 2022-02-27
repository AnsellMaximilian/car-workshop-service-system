@props(['active'])

@php
$baseClasses = 'w-full inline-flex items-center py-1 px-2 rounded-md focus:outline-none';
$classes = ($active ?? false)
            ? 'transition duration-150 ease-in-out bg-primary text-white'
            : 'text-gray-400 hover:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => ( $baseClasses . ' ' . $classes ) ]) }}>
    {{ $slot }}
</a>
