@props(['defaultFile' => '/images/default-user-photo.jpg', 'name', 'label', 'accept' => ''])


<div x-data="{
    photo: '{{ $defaultFile }}',
    handleFileChange(e) {
        if (!e.target.files.length) {
            this.photo = '{{ $defaultFile }}';
            return
        };

        let file = e.target.files[0],
            reader = new FileReader()

        reader.readAsDataURL(file)
        reader.onload = e => {
            this.photo = e.target.result
            console.log('reader set finished', this.photo)
        };
    },
}"
>
    <x-label for="{{ $name }}">
        <span @click="photo = 'fag'">{{ $label }}</span>
        <img x-bind:src="photo" class="block w-32 h-32 object-cover mt-1" />
        <input
            {{ $attributes->whereStartsWith('wire:model') }}
            type="file" 
            class="hidden" 
            id="{{ $name }}" 
            name="{{ $name }}"
            accept="{{ $accept }}"
            x-on:change="handleFileChange" />
    </x-label>
</div>