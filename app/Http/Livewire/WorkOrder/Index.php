<?php

namespace App\Http\Livewire\WorkOrder;

use App\Models\WorkOrder;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Search and sort
    public $query = "";
    public $sortField;
    public $sortDir = "asc";
    
    public function setSort($field)
    {
        if($this->sortField === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDir = 'asc';
        }

        $this->sortField = $field;
    }

    public function destroy(WorkOrder $workOrder)
    {
        $workOrder->delete();
    }

    public function render()
    {

        $workOrders = WorkOrder::search('id', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.work-order.index', [
            'workOrders' => $workOrders
        ]);
    }
}
