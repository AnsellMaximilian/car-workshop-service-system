<?php

namespace App\Http\Livewire\PemeriksaanStandar;

use App\Models\PemeriksaanStandar;
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

    public function destroy(PemeriksaanStandar $pemeriksaanStandar)
    {
        $this->authorize('delete', $pemeriksaanStandar);

        $pemeriksaanStandar->delete();
    }

    public function render()
    {

        $pemeriksaanStandars = PemeriksaanStandar::search('nama', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.pemeriksaan-standar.index', [
            'pemeriksaanStandars' => $pemeriksaanStandars
        ]);
    }
}
