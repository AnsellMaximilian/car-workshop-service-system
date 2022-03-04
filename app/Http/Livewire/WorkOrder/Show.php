<?php

namespace App\Http\Livewire\WorkOrder;

use App\Models\JenisService;
use App\Models\PenggantianSukuCadang;
use App\Models\PenjualanService;
use App\Models\SukuCadang;
use App\Models\WorkOrder;
use Livewire\Component;

class Show extends Component
{
    public $workOrder;

    // Adding service sale
    public $selectedJenisServiceId;
    public $jenisServiceAmount = 0;

    // Adding spare part change
    public $selectedSukuCadangId;
    public $sukuCadangAmount = 0;

    public function mount($id)
    {
        $this->workOrder = WorkOrder::find($id);

        $firstJenisService = JenisService::first();
        $firstSukuCadang = SukuCadang::first();
        
        if(old('selectedJenisServiceId')){
            $this->selectedJenisServiceId = old('selectedJenisServiceId');
        }else {
            if($firstJenisService) {
                $this->selectedJenisServiceId = $firstJenisService->id;
            }
        }

        if(old('selectedSukuCadangId')){
            $this->selectedSukuCadangId = old('selectedSukuCadangId');
        }else {
            if($firstSukuCadang) {
                $this->selectedSukuCadangId = $firstSukuCadang->id;
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

    public function addSukuCadang()
    {
        $this->validate([
            'sukuCadangAmount' => 'required|numeric',
            'selectedSukuCadangId' => 'required|exists:suku_cadangs,id',
        ]);
        
        $selectedSukuCadang = SukuCadang::find($this->selectedSukuCadangId);
        
        $newPenggantianSukuCadang = new PenggantianSukuCadang;

        $newPenggantianSukuCadang->jumlah = $this->sukuCadangAmount;
        $newPenggantianSukuCadang->suku_cadang_id = $this->selectedSukuCadangId;
        $newPenggantianSukuCadang->harga = $selectedSukuCadang->harga;
        
        $this->workOrder->penggantian_suku_cadangs()->save($newPenggantianSukuCadang);
        $this->workOrder->refresh();

        $this->reset(['sukuCadangAmount']);
    }

    public function deletePenggantianSukuCadang($id)
    {
        $penggantianSukuCadang = PenggantianSukuCadang::find($id);
        $penggantianSukuCadang->delete();
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

        if($this->selectedSukuCadangId){
            $selectedSukuCadang = SukuCadang::find($this->selectedSukuCadangId);
        }else {
            $selectedSukuCadang = new SukuCadang();
        }

        return view('livewire.work-order.show', [
            'sukuCadang' => $this->workOrder,
            'jenisServices' => JenisService::all(),
            'sukuCadangs' => SukuCadang::all(),
            'selectedJenisService' => $selectedJenisService,
            'selectedSukuCadang' => $selectedSukuCadang
        ]);
    }
}
