@props(['label', 'sublabel', 'value', 'actions' => null])

<div {{$attributes->merge(['class' => 'w-full md:w-72 h-44 rounded-lg shadow-md flex flex-col pt-4 overflow-hidden'])}}>
    <div class="flex gap-2 items-center mb-4 px-4">
        <div>{{ $icon }}</div>
        <div>
            <span class="font-semibold uppercase text-xl block leading-5">{{ $label }}</span>
            <span class="block text-sm">{{ $sublabel }}</span>
        </div>
    </div>
    <div class="text-right text-4xl font-bold px-4">{{ $value }}</div>
    @if ($actions)
    <hr class="mt-auto">
    <div>
        {{ $actions }}
    </div>
    @endif
</div>