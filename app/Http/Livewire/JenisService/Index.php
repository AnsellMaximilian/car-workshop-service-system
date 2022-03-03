<?php

namespace App\Http\Livewire\JenisService;

use App\Models\JenisService;
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

    public function destroy(JenisService $jenisService)
    {
        $jenisService->delete();
    }

    public function render()
    {

        $jenisServices = JenisService::search('nama', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.jenis-service.index', [
            'jenisServices' => $jenisServices
        ]);
    }
}
