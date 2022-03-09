<?php

namespace App\Http\Livewire\FakturService;

use App\Models\FakturService;
use App\Models\WorkOrder;
use Livewire\Component;

class Create extends Component
{
    public $selectedWorkOrderId;

    public function mount()
    {
        $firstWorkOrder = WorkOrder::first();
        if($firstWorkOrder){
            $this->selectedWorkOrderId = $firstWorkOrder->id;
        }
    }
    
    public function saveFakturService()
    {
        $this->validate([
            'selectedWorkOrderId' => 'required|exists:work_orders,id',
        ]);

        $newFakturService = new FakturService();
        $newFakturService->work_order_id = $this->selectedWorkOrderId;
        $newFakturService->tanggal = now();
        $newFakturService->save();

        return $this->redirect('/faktur-services');
    }

    public function render()
    {
        if($this->selectedWorkOrderId){
            $selectedWorkOrder = WorkOrder::find($this->selectedWorkOrderId);
        }else {
            $selectedWorkOrder = new WorkOrder();
        }

        return view('livewire.faktur-service.create', [
            'workOrders' => WorkOrder::where('service_selesai', true)->get(),
            'selectedWorkOrder' => $selectedWorkOrder
        ]);
    }
}