<?php

namespace App\Http\Livewire\WorkOrder;

use App\Models\WorkOrder;
use Livewire\Component;

class Show extends Component
{
    public $workOrder;

    public function mount($id)
    {
        $this->workOrder = WorkOrder::find($id);
    }

    public function markAsChecked()
    {
        $this->workOrder->markAsChecked();
    }

    public function render()
    {
        // dd($this->sukuCadang->getTotalPemasukkan());

        return view('livewire.work-order.show', ['sukuCadang' => $this->workOrder]);
    }
}
