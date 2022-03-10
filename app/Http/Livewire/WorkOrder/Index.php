<?php

namespace App\Http\Livewire\WorkOrder;

use App\Models\WorkOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    use AuthorizesRequests;

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
        $this->authorize('delete', $workOrder);

        if($workOrder->canBeDeleted()){
            $workOrder->delete();
        }else {
            return redirect(route('work-orders.index'))
                ->with('error', 'Tidak bisa di hapus.');
        }
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
