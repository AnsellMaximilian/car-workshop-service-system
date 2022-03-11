<?php

namespace App\Http\Livewire\Service;

use App\Models\FakturService;
use App\Models\JenisService;
use App\Models\PenggantianSukuCadang;
use App\Models\PenjualanService;
use App\Models\Service;
use App\Models\SukuCadang;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public $service;

    // Adding service sale
    public $selectedJenisServiceId;
    public $jenisServiceAmount = 0;

    // Adding spare part change
    public $selectedSukuCadangId;
    public $sukuCadangAmount = 0;

    public $isEditMode = false;

    public function mount($id)
    {
        $this->service = Service::find($id);

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

    public function failIfApprovalNotPending($extraMessage = "")
    {
        if(!$this->service->isApprovalPending()){
            return redirect(route('services.show', $this->service->id))
                ->with('error', 'Service sudah ' . ($this->service->isServiceCancelled() ? 'dibatalkan. ' : 'disetujui. ') . $extraMessage);
        }
    }

    public function toggleEditMode()
    {
        $this->failIfApprovalNotPending("Tidak bisa edit.");    
        $this->isEditMode = !$this->isEditMode;
    }

    public function markAsChecked()
    {
        $this->service->markAsChecked();
    }

    public function addJenisService()
    {
        $this->authorize('update', $this->service);
        
        $this->validate([
            'jenisServiceAmount' => 'required|numeric|min:0',
            'selectedJenisServiceId' => 'required|exists:jenis_services,id',
        ]);

        $this->failIfApprovalNotPending();    
        $selectedJenisService = JenisService::find($this->selectedJenisServiceId);
    
        $newPenjualanService = new PenjualanService();

        $newPenjualanService->jumlah = $this->jenisServiceAmount;
        $newPenjualanService->jenis_service_id = $this->selectedJenisServiceId;
        $newPenjualanService->harga = $selectedJenisService->harga;
        
        $this->service->penjualan_services()->save($newPenjualanService);
        $this->service->refresh();
        
        $this->reset(['jenisServiceAmount']);
    }
    
    public function deletePenjualanService($id)
    {
        $this->authorize('update', $this->service);

        $this->failIfApprovalNotPending();
        $penjualanService = PenjualanService::find($id);
        $penjualanService->delete();
        $this->service->refresh();
    }

    public function addSukuCadang()
    {
        $this->authorize('update', $this->service);

        $this->validate([
            'sukuCadangAmount' => 'required|numeric|min:0',
            'selectedSukuCadangId' => 'required|exists:suku_cadangs,id',
        ]);
        $selectedSukuCadang = SukuCadang::find($this->selectedSukuCadangId);
        
        if($selectedSukuCadang->current_stock < $this->sukuCadangAmount){
            return redirect(route('services.show', $this->service->id))
                ->with('error', 'Stok '.$selectedSukuCadang->nama.' tidak cukup. Stok: '.$selectedSukuCadang->current_stock);
        }else {
            $this->failIfApprovalNotPending();
            $newPenggantianSukuCadang = new PenggantianSukuCadang();

            $newPenggantianSukuCadang->jumlah = $this->sukuCadangAmount;
            $newPenggantianSukuCadang->suku_cadang_id = $this->selectedSukuCadangId;
            $newPenggantianSukuCadang->harga = $selectedSukuCadang->harga;
            
            $this->service->penggantian_suku_cadangs()->save($newPenggantianSukuCadang);
            $this->service->refresh();
        }

        $this->reset(['sukuCadangAmount']);
    }

    public function deletePenggantianSukuCadang($id)
    {
        $this->authorize('update', $this->service);

        $this->failIfApprovalNotPending();
        $penggantianSukuCadang = PenggantianSukuCadang::find($id);
        $penggantianSukuCadang->delete();
        $this->service->refresh();
    }

    public function markApproveStatus($isApproved)
    {
        $this->authorize('update', $this->service);

        if(count($this->service->penjualan_services) === 0 && count($this->service->penggantian_suku_cadangs) === 0){
            return redirect(route('services.show', $this->service->id))
                ->with('error', 'Work order kosong. Hapus saja.');
        }else {
            if($isApproved){
                $this->service->markAsApproved();
            }else{
                $this->service->markAsCancelled();
            }
            $this->service->refresh();
        }
        $this->isEditMode = false;
    }

    public function markAsFinished()
    {
        $this->authorize('update', $this->service);

        if($this->service->isApprovalPending()) {
            return redirect(route('services.show', $this->service->id))
                ->with('error', 'Mohon tunggu disetujui.');
        }
        $this->service->markAsFinished();
    }

    public function deleteService()
    {
        $this->authorize('delete', $this->service);

        if($this->service->canBeDeleted()){
            $this->service->delete();
            return redirect(route('services.index'));
        }else {
            return redirect(route('services.show', $this->service->id))
                ->with('error', 'Tidak bisa di hapus.');
        }
    }

    public function makeInvoice()
    {
        $this->authorize('update', $this->service);

        if($this->service->invoiced()){
            return redirect(route('services.show', $this->service->id))
                ->with('error', 'Faktur sudah order ini sudah dibuat.');
        }elseif(!$this->service->canBeInvoiced()){
            return redirect(route('services.show', $this->service->id))
                ->with('error', 'Selesaikan dulu service.');
        }else {
            $this->service->tanggal_faktur = now();
            $this->service->save();
        }
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

        return view('livewire.service.show', [
            'sukuCadang' => $this->service,
            'jenisServices' => JenisService::all(),
            'sukuCadangs' => SukuCadang::all(),
            'selectedJenisService' => $selectedJenisService,
            'selectedSukuCadang' => $selectedSukuCadang
        ]);
    }
}
