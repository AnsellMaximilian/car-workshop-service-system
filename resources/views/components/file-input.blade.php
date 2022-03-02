@props(['defaultFile' => '/images/default-user-photo.jpg', 'name', 'label'])


<div x-data="{
    photo: '{{ $defaultFile }}',
    handleFileChange(e) {
        console.log('File changed', this.photo);
        if (!e.target.files.length) {
            this.photo = '{{ $defaultFile }}';
            return
        };

        let file = e.target.files[0],
            reader = new FileReader()

        reader.readAsDataURL(file)
        reader.onload = e => {
            console.log('reader ready', this.photo)
            this.photo = e.target.result
            console.log('reader set finished', this.photo)
        };
    },
    consoleLog(){
        console.log(this, this.photo)
    }
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
            x-on:change="handleFileChange" />
        <button x-on:click="consoleLog">Button</button>
    </x-label>
</div>