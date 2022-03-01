@props(['defaultFile' => '/images/default-user-photo.jpg', 'name', 'label'])


<div x-data="{
    photo: '{{ $defaultFile }}',
    handleFileChange(e) {
        if (!event.target.files.length) {
            this.photo = '{{ $defaultFile }}';
            return
        };

        let file = event.target.files[0],
            reader = new FileReader()

        reader.readAsDataURL(file)
        reader.onload = e => this.photo = e.target.result;
    }
}">
    <x-label for="{{ $name }}">
        <span>{{ $label }}</span>
        <img x-bind:src="photo" class="block w-32 h-32 object-cover mt-1" />
        <input
            {{ $attributes->whereStartsWith('wire:model') }}
            type="file" 
            class="hidden" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            x-on:change="handleFileChange" />
    </x-label>
</div>