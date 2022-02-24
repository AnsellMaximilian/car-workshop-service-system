@props(['active'])

@php
$baseClasses = 'inline-flex items-center p-1 text-white rounded-md';
$classes = ($active ?? false)
            ? 'focus:outline-none transition duration-150 ease-in-out bg-primary w-full'
            : 'hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => ( $baseClasses . ' ' . $classes ) ]) }}>
    {{ $slot }}
</a>
