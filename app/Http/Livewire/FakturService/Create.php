<?php

namespace App\Http\Livewire\FakturService;

use App\Models\WorkOrder;
use Livewire\Component;

class Create extends Component
{
    public $selecterWorkOrderId;

    public function mount()
    {
        $firstWorkOrder = WorkOrder::first();
        if($firstWorkOrder){
            $this->selectedMerkId = $firstWorkOrder->id;
        }
    }

    public function render()
    {
        if($this->selecterWorkOrderId){
            $selectedWorkOrder = WorkOrder::find($this->selecterWorkOrderId);
        }else {
            $selectedWorkOrder = new WorkOrder();
        }

        return view('livewire.faktur-service.create', [
            'workOrders' => WorkOrder::all(),
        ]);
    }
}
