<?php

namespace App\Http\Livewire\PendaftaranService;

use App\Models\JenisService;
use App\Models\Pelanggan;
use App\Models\PendaftaranService;
use App\Models\PerkiraanPenjualanService;
use App\Models\PerkiraanSukuCadang;
use App\Models\SukuCadang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    // Basic
    public $no_plat;
    public $pelanggan_id;
    public $keluhan;
    
    // Service    
    public $selectedJenisServiceId = [];
    public $selectedJenisService;
    public $jenisServiceAmount;
    public $jenisServices = [];

    public $servicePredictions = [ ];
    public $serviceIndex = 0;

    // Suku Cadang    
    public $selectedSukuCadangId = [];
    public $selectedSukuCadang;
    public $sukuCadangAmount;
    public $sukuCadangs = [];

    public $sukuCadangPredictions = [ ];
    public $sukuCadangIndex = 0;

    public function mount()
    {
        $firstPelanggan = Pelanggan::first();
        $this->pelanggan_id = $firstPelanggan->id;

    }

    public function addServicePrediction()
    {
        if(count(JenisService::whereNotIn('id', $this->selectedJenisServiceId)->get()) > 0){
            $this->serviceIndex++;

            $this->jenisServices[$this->serviceIndex] = JenisService::whereNotIn('id', $this->selectedJenisServiceId)->get();
            
            $this->selectedJenisServiceId[$this->serviceIndex] = $this->jenisServices[$this->serviceIndex]->first()->id;

            array_push($this->servicePredictions, $this->serviceIndex);
            $this->jenisServiceAmount[$this->serviceIndex] = 0;
        }
    }

    public function removeServicePrediction($index)
    {
        unset($this->selectedJenisServiceId[$this->servicePredictions[$index]]);
        
        unset($this->servicePredictions[$index]);
    }

    public function addSukuCadangPrediction()
    {
        if(count(SukuCadang::whereNotIn('id', $this->selectedSukuCadangId)->get()) > 0){
            $this->sukuCadangIndex++;

            $this->sukuCadangs[$this->sukuCadangIndex] = SukuCadang::whereNotIn('id', $this->selectedSukuCadangId)->get();
            
            $this->selectedSukuCadangId[$this->sukuCadangIndex] = $this->sukuCadangs[$this->sukuCadangIndex]->first()->id;

            array_push($this->sukuCadangPredictions, $this->sukuCadangIndex);
            $this->sukuCadangAmount[$this->sukuCadangIndex] = 0;
        }
    }

    public function removeSukuCadangPrediction($index)
    {
        unset($this->selectedSukuCadangId[$this->sukuCadangPredictions[$index]]);
        unset($this->sukuCadangPredictions[$index]);
    }

    public function save()
    {
        $this->validate([
            'keluhan' => 'max:255',
            'no_plat' => 'required',
            'pelanggan_id' => 'required|exists:pelanggans,id'
        ]);

        $pendaftaran = new PendaftaranService();
        $pendaftaran->waktu_pendaftaran = now();
        $pendaftaran->no_plat = $this->no_plat;
        $pendaftaran->pelanggan_id = $this->pelanggan_id;
        $pendaftaran->keluhan = $this->keluhan;
        $pendaftaran->user_id = Auth::user()->id;

        $pendaftaran->save();

        foreach ($this->servicePredictions as $key => $serviceIndex) {
            $perkiraanPenjualanService = new PerkiraanPenjualanService();
            $perkiraanPenjualanService->jenis_service_id = $this->selectedJenisServiceId[$serviceIndex];
            $perkiraanPenjualanService->jumlah = $this->jenisServiceAmount[$serviceIndex];
            $perkiraanPenjualanService->harga = $this->selectedJenisService[$serviceIndex]['harga'];
            $pendaftaran->perkiraan_penjualan_services()->save($perkiraanPenjualanService);
        }

        foreach ($this->sukuCadangPredictions as $key => $sukuCadangIndex) {
            $perkiraanPenggantianSukuCadang = new PerkiraanSukuCadang();
            $perkiraanPenggantianSukuCadang->suku_cadang_id = $this->selectedSukuCadangId[$sukuCadangIndex];
            $perkiraanPenggantianSukuCadang->jumlah = $this->sukuCadangAmount[$sukuCadangIndex];
            $perkiraanPenggantianSukuCadang->harga = $this->selectedSukuCadang[$sukuCadangIndex]['harga'];
            $pendaftaran->perkiraan_suku_cadangs()->save($perkiraanPenggantianSukuCadang);
        }
        
        return redirect(route('pendaftaran-services.index'));
    }

    public function render()
    {
        foreach ($this->servicePredictions as $key => $serviceIndex) {
            $this->selectedJenisService[$serviceIndex] = JenisService::find($this->selectedJenisServiceId[$serviceIndex]);
        }

        foreach ($this->sukuCadangPredictions as $key => $sukuCadangIndex) {
            $this->selectedSukuCadang[$sukuCadangIndex] = SukuCadang::find($this->selectedSukuCadangId[$sukuCadangIndex]);
        }

        $totalPerkiraanService = 0;
        foreach ($this->servicePredictions as $key => $index) {
            $totalPerkiraanService += ($this->selectedJenisService[$index]->harga * $this->jenisServiceAmount[$index]);
        }

        $totalPerkiraanSukuCadang = 0;
        foreach ($this->sukuCadangPredictions as $key => $index) {
            $totalPerkiraanSukuCadang += ($this->selectedSukuCadang[$index]->harga * $this->sukuCadangAmount[$index]);
        }

        foreach ($this->servicePredictions as $key => $index) {
            $this->jenisServices[$index] = JenisService::whereNotIn('id', $this->selectedJenisServiceId)
                ->orWhereIn('id', [$this->selectedJenisServiceId[$index]])->get();
        }

        foreach ($this->sukuCadangPredictions as $key => $index) {
            $this->sukuCadangs[$index] = SukuCadang::whereNotIn('id', $this->selectedSukuCadangId)
                ->orWhereIn('id', [$this->selectedSukuCadangId[$index]])->get();
        }

        return view('livewire.pendaftaran-service.create', [
            'pelanggans' => Pelanggan::all(),
            'totalPerkiraanService' => $totalPerkiraanService,
            'totalPerkiraanSukuCadang' => $totalPerkiraanSukuCadang
        ]);
    }
}
