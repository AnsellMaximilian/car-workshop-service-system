@props(['sortable' => null, 'sortDir' => null])

<th {{ $attributes->merge(['class' => 'uppercase font-medium text-left text-xs px-6 py-4 cursor-pointer'])}}>
    @if ($sortable)
        <span class="inline-flex items-center gap-1">
            {{ $slot }}
            @if ($sortDir)
                @if ($sortDir === 'asc')
                    <x-icons.up-chevron  class="h-2"/>
                @else
                    <x-icons.down-chevron  class="h-2"/>
                @endif
                
            @endif
        </span>
    @else
        {{ $slot }}
    @endif
</th>