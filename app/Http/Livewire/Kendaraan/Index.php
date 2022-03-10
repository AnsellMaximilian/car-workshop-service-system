<?php

namespace App\Http\Livewire\Kendaraan;

use App\Models\Kendaraan;
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

    public function destroy(Kendaraan $kendaraan)
    {
        $this->authorize('delete', $kendaraan);
        $kendaraan->delete();
    }

    public function render()
    {
        $kendaraans = Kendaraan::search('no_plat', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.kendaraan.index', [
            'kendaraans' => $kendaraans
        ]);
    }
}
