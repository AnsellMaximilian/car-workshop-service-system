<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
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

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        if($service->canBeDeleted()){
            $service->delete();
        }else {
            return redirect(route('servicess.index'))
                ->with('error', 'Tidak bisa di hapus.');
        }
    }

    public function render()
    {

        $services = Service::search('id', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.service.index', [
            'services' => $services
        ]);
    }
}
