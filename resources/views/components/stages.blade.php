@props(['count', 'stage'])

<div class="flex gap-1">
    @for ($i = 0; $i < $count; $i++)
        <span class="block h-2 w-2 border border-black {{$stage >= $i ? 'bg-black' : 'bg-transparent'}}"></span>
    @endfor
</div>