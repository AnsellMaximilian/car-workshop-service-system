<?php

namespace App\Http\Livewire\FakturService;

use App\Models\FakturService;
use App\Models\Service;
use App\Models\WorkOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $selectedWorkOrderId;
    public $selectedServiceId;

    public function mount()
    {
        // $firstWorkOrder = WorkOrder::first();
        // if($firstWorkOrder){
        //     $this->selectedWorkOrderId = $firstWorkOrder->id;
        // }

        $firstService = Service::first();
        if($firstService){
            $this->selectedServiceId = $firstService->id;
        }
    }
    
    public function saveFakturService()
    {
        $this->authorize('create', FakturService::class);


        $this->validate([
            // 'selectedWorkOrderId' => 'required|exists:work_orders,id',
            'selectedServiceId' => 'required|exists:services,id',
        ]);

        $newFakturService = new FakturService();
        $newFakturService->service_id = $this->selectedServiceId;
        // $newFakturService->work_order_id = $this->selectedWorkOrderId;
        $newFakturService->tanggal = now();
        $newFakturService->save();

        return redirect(route('faktur-services.show', $newFakturService->id));
    }

    public function render()
    {
        // if($this->selectedWorkOrderId){
        //     $selectedWorkOrder = WorkOrder::find($this->selectedWorkOrderId);
        // }else {
        //     $selectedWorkOrder = new WorkOrder();
        // }

        if($this->selectedServiceId){
            $selectedService = Service::find($this->selectedServiceId);
        }else {
            $selectedService = new Service();
        }

        $services = Service::where('service_selesai', true)->get();

        return view('livewire.faktur-service.create', [
            'services' => $services->filter(function ($service) {
                return !$service->invoiced();
            }),
            'selectedService' => $selectedService
            // 'selectedWorkOrder' => $selectedWorkOrder
        ]);
    }
}
