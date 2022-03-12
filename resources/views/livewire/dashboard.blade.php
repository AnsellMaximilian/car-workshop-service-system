<div>
    <div class="flex flex-wrap gap-4 mb-8">
        <x-dashboard-module label="Total Service" :value="$totalSales" class="bg-primary text-white">
            <x-slot name="icon">
                <x-icons.magnifying-glass class="h-6 fill-white"/>
            </x-slot>
        </x-dashboard-module>
    </div>

    <div class="flex flex-wrap gap-4">
        <x-dashboard-module label="Belum Selesai" :value="$unfinishedAmount" class="bg-white" >
            <x-slot name="icon">
                <x-icons.wrench class="h-6"/>
            </x-slot>
        </x-dashboard-module>
        <x-dashboard-module label="Pending" :value="$approvalPendingAmount" class="bg-white" >
            <x-slot name="icon">
                <x-icons.checkmarked-clipboard class="h-6"/>
            </x-slot>
        </x-dashboard-module>
    </div>
</div>
