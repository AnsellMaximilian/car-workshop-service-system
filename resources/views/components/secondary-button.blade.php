@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : ''}}  {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-transparent hover:bg-gray-100 active:bg-gray-100 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-bold text-xs text-primary uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ']) }}>
    {{ $slot }}
</button>
