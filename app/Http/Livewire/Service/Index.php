<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
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

    public $statusSort = 'semua';
    public $pembayaranSort = 'semua';
    public $persetujuanSort = 'semua';
    
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
            return redirect(route('services.index'))
                ->with('error', 'Tidak bisa di hapus.');
        }
    }

    public function render()
    {
        $services = Service::search('id', $this->query)->optionalSort($this->sortField, $this->sortDir);

        // Sort by status
        if($this->statusSort !== 'semua'){
            $services = $services->where('status_service', $this->statusSort);
        }

        // Sort by persetujuan
        if($this->persetujuanSort !== 'semua'){
            if($this->persetujuanSort === 'pending'){
                $services = $services->doesntHave('persetujuan_service');
            }else {
                $services = $services->whereHas('persetujuan_service', function(Builder $q){
                    $q->where('status_persetujuan', $this->persetujuanSort);
                });
            }
        }
        
        // Sort by pembayaran
        if($this->pembayaranSort !== 'semua'){
            if($this->pembayaranSort === 'sudah'){
                $services = $services->whereHas('pembayaran');
            }else {
                $services = $services->doesntHave('pembayaran');
            }
        }

        return view('livewire.service.index', [
            'services' => $services->paginate(10)
        ]);
    }
}
