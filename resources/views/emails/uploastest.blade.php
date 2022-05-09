<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test Upload') }}
        </h2>
    </x-slot>
    <x-card class="">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('sendmail.uploadStore') }}" enctype="multipart/form-data" class="grid grid-cols gap-4">
            @csrf


            <div class="col-span-6">
                <x-file-input name="photo" label="Photo" accept=".jpg,.png,.jpeg"/>
            </div>

            <div class="flex items-center justify-end col-span-12">
                <x-button class="ml-4">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
