<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-card class="mb-8 bg-primary text-white">
        Selamat datang, {{Auth::user()->name}}!
    </x-card>

    <div class="flex flex-wrap gap-4">
        <x-dashboard-module label="Belum Dicek" :value="$uncheckedAmount">
            <x-slot name="icon">
                <x-icons.magnifying-glass class="h-6"/>
            </x-slot>
        </x-dashboard-module>
        <x-dashboard-module label="Belum Selesai" :value="$unfinishedAmount">
            <x-slot name="icon">
                <x-icons.wrench class="h-6"/>
            </x-slot>
        </x-dashboard-module>
        <x-dashboard-module label="Pending" :value="$approvalPendingAmount">
            <x-slot name="icon">
                <x-icons.checkmarked-clipboard class="h-6"/>
            </x-slot>
        </x-dashboard-module>
    </div>
</x-app-layout>
