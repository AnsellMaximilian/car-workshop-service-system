<?php

namespace App\Http\Livewire\Pelanggan;

use App\Models\Pelanggan;
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

    public function destroy(Pelanggan $pelanggan)
    {
        // Storage::disk('public')->delete('');
        $this->authorize('delete', $pelanggan);
        $pelanggan->delete();
    }

    public function render()
    {
        $pelanggans = Pelanggan::search('nama', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);
        return view('livewire.pelanggan.index', [
            'pelanggans' => $pelanggans
        ]);
    }
}
