@props(['trueClass', 'falseClass', 'trueLabel', 'falseLabel', 'state'])

<button
    {{ $attributes->merge(['class' => $state ? $trueClass : $falseClass])}}
>
    {{  $state ? $trueLabel : $falseLabel}}
</button>