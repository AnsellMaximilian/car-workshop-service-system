<?php

namespace App\Http\Livewire\Service;

use App\Models\JenisService;
use App\Models\PelaksanaanPemeriksaan;
use App\Models\PemeriksaanStandar;
use App\Models\PenggantianSukuCadang;
use App\Models\PenjualanService;
use App\Models\Service;
use App\Models\SukuCadang;
use Livewire\Component;

class Edit extends Component
{
    public $service;

    public $statusService;

    // Service    
    public $selectedJenisServiceId = [];
    public $selectedJenisService;
    public $jenisServiceAmount;
    public $jenisServices = [];

    public $penjualanServices = [ ];
    public $serviceIndex = 0;

    // Suku Cadang    
    public $selectedSukuCadangId = [];
    public $selectedSukuCadang;
    public $sukuCadangAmount;
    public $sukuCadangs = [];

    public $penggantianSukuCadangs = [ ];
    public $sukuCadangIndex = 0;

    // Stok
    public $stokSukuCadang = [];

    // Pemeriksaan
    public $pemeriksaanStandarsChecked = [];

    public function mount()
    {
        $this->statusService = $this->service->status_service;

        // Stok first
        foreach (SukuCadang::all() as $key => $sukuCadang) {
            $this->stokSukuCadang[$sukuCadang->id] = $sukuCadang->getCurrentStock();
        }

        foreach ($this->service->penjualan_services as $key => $penjualanService) {
            $this->serviceIndex++;
            $this->selectedJenisServiceId[$this->serviceIndex] = $penjualanService->jenis_service->id;
            array_push($this->penjualanServices, $this->serviceIndex);
            $this->jenisServiceAmount[$this->serviceIndex] = $penjualanService->jumlah;
        }

        foreach ($this->service->penggantian_suku_cadangs as $key => $penggantianSukuCadang) {
            $this->sukuCadangIndex++;
            $this->selectedSukuCadangId[$this->sukuCadangIndex] = $penggantianSukuCadang->suku_cadang->id;
            array_push($this->penggantianSukuCadangs, $this->sukuCadangIndex);
            $this->sukuCadangAmount[$this->sukuCadangIndex] = $penggantianSukuCadang->jumlah;

            // Stok
            $this->stokSukuCadang[$penggantianSukuCadang->suku_cadang->id] += $penggantianSukuCadang->jumlah;
        }

        foreach ($this->service->pelaksanaan_pemeriksaans as $key => $pelaksanaanPemeriksaan) {
            $this->pemeriksaanStandarsChecked[$pelaksanaanPemeriksaan->pemeriksaan_standar_id] = true;
        }

    }

    public function addPenjualanService()
    {
        if(count(JenisService::whereNotIn('id', $this->selectedJenisServiceId)->get()) > 0){
            $this->serviceIndex++;

            $this->jenisServices[$this->serviceIndex] = JenisService::whereNotIn('id', $this->selectedJenisServiceId)->get();
            
            $this->selectedJenisServiceId[$this->serviceIndex] = $this->jenisServices[$this->serviceIndex]->first()->id;
    
            array_push($this->penjualanServices, $this->serviceIndex);
            $this->jenisServiceAmount[$this->serviceIndex] = 0;
        }
    }

    public function removePenjualanService($index)
    {
        unset($this->selectedJenisServiceId[$this->penjualanServices[$index]]);
        unset($this->penjualanServices[$index]);
    }

    public function addPenggantianSukuCadang()
    {
        if(count(SukuCadang::whereNotIn('id', $this->selectedSukuCadangId)->get()) > 0){
            $this->sukuCadangIndex++;

            $this->sukuCadangs[$this->sukuCadangIndex] = SukuCadang::whereNotIn('id', $this->selectedSukuCadangId)->get();
            
            $this->selectedSukuCadangId[$this->sukuCadangIndex] = $this->sukuCadangs[$this->sukuCadangIndex]->first()->id;
    
            array_push($this->penggantianSukuCadangs, $this->sukuCadangIndex);
            $this->sukuCadangAmount[$this->sukuCadangIndex] = 0;
        }
    }

    public function removePenggantianSukuCadang($index)
    {
        unset($this->selectedSukuCadangId[$this->penggantianSukuCadangs[$index]]);
        unset($this->penggantianSukuCadangs[$index]);
    }

    public function updateStatus($steps)
    {
        $this->statusService = Service::getNewStatus($this->statusService, $steps);
    }

    public function save()
    {
        $this->validate([
            'statusService' => 'in:mulai,cek,service,selesai',
        ]);

        // Check stock
        foreach ($this->penggantianSukuCadangs as $key => $sukuCadangIndex) {
            $checkJumlah =  $this->sukuCadangAmount[$sukuCadangIndex];
            // $checkSukuCadang = SukuCadang::find($this->selectedSukuCadangId[$sukuCadangIndex])->getCurrentStock();
            if($this->stokSukuCadang[$this->selectedSukuCadangId[$sukuCadangIndex]] < $checkJumlah){
                return redirect(route('services.edit', $this->service->id))
                    ->with('error', 'Stok '.$this->selectedSukuCadang[$sukuCadangIndex]['nama'].' tidak cukup. Sisa '.$this->stokSukuCadang[$this->selectedSukuCadangId[$sukuCadangIndex]].'.');
            }
        }

        $this->service->status_service = $this->statusService;
        
        // PenjualanService::where('service_id', $this->service->id)->delete();
        foreach (PenjualanService::where('service_id', $this->service->id)->get() as $key => $penjualanService) {
            $penjualanService->delete();
        }
        // PenggantianSukuCadang::where('service_id', $this->service->id)->delete();
        foreach (PenggantianSukuCadang::where('service_id', $this->service->id)->get() as $key => $penggantianSukuCadang) {
            $penggantianSukuCadang->delete();
        }

        foreach($this->pemeriksaanStandarsChecked as $key => $checked){
            $currentPemeriksaan = $this->service->pelaksanaan_pemeriksaans()->where('pemeriksaan_standar_id', $key)->first();
            if($checked && !$currentPemeriksaan){
                $pemeriksaan = new PelaksanaanPemeriksaan();
                $pemeriksaan->pemeriksaan_standar_id = $key;
                
                $this->service->pelaksanaan_pemeriksaans()->save($pemeriksaan);
            }elseif(!$checked && $currentPemeriksaan) {
                $currentPemeriksaan->delete();
            }
        }

        foreach ($this->penjualanServices as $key => $serviceIndex) {
            $penjualanService = new PenjualanService();
            $penjualanService->jenis_service_id = $this->selectedJenisServiceId[$serviceIndex];
            $penjualanService->jumlah = $this->jenisServiceAmount[$serviceIndex];
            $penjualanService->harga = $this->selectedJenisService[$serviceIndex]['harga'];
            $this->service->penjualan_services()->save($penjualanService);
        }

        foreach ($this->penggantianSukuCadangs as $key => $sukuCadangIndex) {
            $penggantianSukuCadanngs = new PenggantianSukuCadang();
            $penggantianSukuCadanngs->suku_cadang_id = $this->selectedSukuCadangId[$sukuCadangIndex];
            $penggantianSukuCadanngs->jumlah = $this->sukuCadangAmount[$sukuCadangIndex];
            $penggantianSukuCadanngs->harga = $this->selectedSukuCadang[$sukuCadangIndex]['harga'];
            $this->service->penggantian_suku_cadangs()->save($penggantianSukuCadanngs);
        }

        $this->service->save();
        
        return redirect(route('services.show', $this->service->id));
    }

    public function render()
    {
        foreach ($this->penjualanServices as $key => $serviceIndex) {
            $this->selectedJenisService[$serviceIndex] = JenisService::find($this->selectedJenisServiceId[$serviceIndex]);
        }

        foreach ($this->penggantianSukuCadangs as $key => $sukuCadangIndex) {
            $this->selectedSukuCadang[$sukuCadangIndex] = SukuCadang::find($this->selectedSukuCadangId[$sukuCadangIndex]);
        }

        $totalPenjualanServices = 0;
        foreach ($this->penjualanServices as $key => $index) {
            $totalPenjualanServices += ($this->selectedJenisService[$index]->harga * $this->jenisServiceAmount[$index]);
        }

        $totalPenggantianSukuCadangs = 0;
        foreach ($this->penggantianSukuCadangs as $key => $index) {
            $totalPenggantianSukuCadangs += ($this->selectedSukuCadang[$index]->harga * $this->sukuCadangAmount[$index]);
        }

        foreach ($this->penjualanServices as $key => $index) {
            $this->jenisServices[$index] = JenisService::whereNotIn('id', $this->selectedJenisServiceId)
                ->orWhereIn('id', [$this->selectedJenisServiceId[$index]])->get();
        }

        foreach ($this->penggantianSukuCadangs as $key => $index) {
            $this->sukuCadangs[$index] = SukuCadang::whereNotIn('id', $this->selectedSukuCadangId)
                ->orWhereIn('id', [$this->selectedSukuCadangId[$index]])->get();
        }

        return view('livewire.service.edit', [
            // 'jenisServices' => JenisService::all(),
            // 'jenisServices' => $jenisServices,
            // 'sukuCadangs' => SukuCadang::all(),
            // 'sukuCadangs' => $sukuCadangs,
            'pemeriksaanStandars' => PemeriksaanStandar::all(),
            'totalPenjualanServices' => $totalPenjualanServices,
            'totalPenggantianSukuCadangs' => $totalPenggantianSukuCadangs,
        ]);
    }
}
