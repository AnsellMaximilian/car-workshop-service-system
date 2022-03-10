<?php

namespace App\Http\Livewire\SukuCadang;

use App\Models\SukuCadang;
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

    public function destroy(SukuCadang $sukuCadang)
    {
        $this->authorize('delete', $sukuCadang);

        $sukuCadang->delete();
    }

    public function render()
    {
        // if($this->sortField === 'stok'){
        //     $sukuCadangs = SukuCadang::search('nama', $this->query)
        //         ->optionalSort($this->sortField, $this->sortDir)
        //         ->paginate(10);
        // }else {
        //     $sukuCadangs = SukuCadang::search('nama', $this->query)
        //         ->optionalSort($this->sortField, $this->sortDir)
        //         ->paginate(10);
        // }

        $sukuCadangs = SukuCadang::search('nama', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.suku-cadang.index', [
            'sukuCadangs' => $sukuCadangs
        ]);
    }
}
