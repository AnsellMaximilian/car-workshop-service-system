@props(['checked' => false])

<div {{ $attributes->merge(['class' => 'border-4 border-gray-800 hover:border-gray-900 hover:bg-gray-100 h-8 w-8 rounded-md cursor-pointer flex items-center justify-center']) }}>
    @if ($checked)
    <x-icons.checkmark class="fill-green-500 h-5" />
    @endif
</div>