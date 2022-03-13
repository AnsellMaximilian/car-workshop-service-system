<?php

namespace App\Http\Livewire\FakturService;

use App\Models\FakturService;
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

    public function destroy(FakturService $fakturService)
    {
        $this->authorize('delete', $fakturService);


        $fakturService->delete();
    }

    public function render()
    {

        $fakturServices = FakturService::search('id', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.faktur-service.index', [
            'fakturServices' => $fakturServices
        ]);
    }
}
