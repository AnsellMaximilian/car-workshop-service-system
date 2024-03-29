@props(['overrideBgClasses' => false, 'disabled' => false])

@php
    $bgClasses = $overrideBgClasses ? $overrideBgClasses : 'bg-primary hover:bg-red-600 active:bg-gray-900';
@endphp

<button {{ $disabled ? 'disabled' : ''}}  {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 '.$bgClasses]) }}>
    {{ $slot }}
</button>
