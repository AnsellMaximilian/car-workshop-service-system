@props(['label', 'value'])

<div class="w-full md:w-72 h-44 bg-white rounded-lg shadow-md p-4 flex flex-col justify-between">
    <div class="font-semibold uppercase text-2xl flex gap-2 items-center">
        {{ $icon }}
        <span>{{ $label }}</span>
    </div>
    <div class="text-right text-4xl font-bold">{{ $value }}</div>
</div>