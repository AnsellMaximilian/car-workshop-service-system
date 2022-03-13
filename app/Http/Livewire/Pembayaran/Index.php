<?php

namespace App\Http\Livewire\Pembayaran;

use App\Models\Pembayaran;
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

    public function destroy(Pembayaran $pembayaran)
    {
        $this->authorize('delete', $pembayaran);
        $pembayaran->delete();
    }

    public function render()
    {
        $pembayarans = Pembayaran::search('id', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);
        return view('livewire.pembayaran.index', [
            'pembayarans' => $pembayarans
        ]);
    }
}
