<?php

namespace App\Http\Livewire\WorkOrder;

use App\Models\JenisService;
use App\Models\PenjualanService;
use App\Models\WorkOrder;
use Livewire\Component;

class Show extends Component
{
    public $workOrder;

    // Adding service sale
    public $selectedJenisServiceId;
    public $jenisServiceAmount = 0;

    public function mount($id)
    {
        $this->workOrder = WorkOrder::find($id);

        $firstJenisService = JenisService::first();
        
        if(old('selectedJenisServiceId')){
            $this->selectedJenisServiceId = old('selectedJenisServiceId');
        }else {
            if($firstJenisService) {
                $this->selectedJenisServiceId = $firstJenisService->id;
            }
        }
    }

    public function markAsChecked()
    {
        $this->workOrder->markAsChecked();
    }

    public function addJenisService()
    {
        $this->validate([
            'jenisServiceAmount' => 'required|numeric',
            'selectedJenisServiceId' => 'required|exists:jenis_services,id',
        ]);
        
        $selectedJenisService = JenisService::find($this->selectedJenisServiceId);
        
        $newPenjualanService = new PenjualanService;

        $newPenjualanService->jumlah = $this->jenisServiceAmount;
        $newPenjualanService->jenis_service_id = $this->selectedJenisServiceId;
        $newPenjualanService->harga = $selectedJenisService->harga;
        
        $this->workOrder->penjualan_services()->save($newPenjualanService);
        $this->workOrder->refresh();

        $this->reset(['jenisServiceAmount']);
    }
    
    public function deletePenjualanService($id)
    {
        $penjualanService = PenjualanService::find($id);
        $penjualanService->delete();
        $this->workOrder->refresh();
    }


    public function render()
    {
        // dd($this->sukuCadang->getTotalPemasukkan());
        if($this->selectedJenisServiceId){
            $selectedJenisService = JenisService::find($this->selectedJenisServiceId);
        }else {
            $selectedJenisService = new JenisService();
        }

        return view('livewire.work-order.show', [
            'sukuCadang' => $this->workOrder,
            'jenisServices' => JenisService::all(),
            'selectedJenisService' => $selectedJenisService
        ]);
    }
}
