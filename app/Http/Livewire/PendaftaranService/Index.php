<?php

namespace App\Http\Livewire\PendaftaranService;

use App\Models\PendaftaranService;
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

    // Continuation
    public $contSort = "semua";
    public $waktuBookingSort;
    
    public function setSort($field)
    {
        if($this->sortField === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDir = 'asc';
        }

        $this->sortField = $field;
    }

    public function destroy(PendaftaranService $pendaftaranService)
    {
        $this->authorize('delete', $pendaftaranService);
        $pendaftaranService->delete();
    }

    public function render()
    {
        $pendaftaranServices = PendaftaranService::search('no_plat', $this->query)
            ->optionalSort($this->sortField, $this->sortDir);

        if($this->contSort !== 'semua'){
            if($this->contSort === 'lanjut'){
                $pendaftaranServices = $pendaftaranServices->whereHas('service');
            }else {
                $pendaftaranServices = $pendaftaranServices->doesntHave('service');
            }
        }

        return view('livewire.pendaftaran-service.index', [
            'pendaftaranServices' => $pendaftaranServices->paginate(10)
        ]);
    }
}
