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
    public $selectedJenisServiceId;
    public $selectedJenisService;
    public $jenisServiceAmount;

    public $servicePredictions = [ ];
    public $serviceIndex = 0;

    // Suku Cadang    
    public $selectedSukuCadangId;
    public $selectedSukuCadang;
    public $sukuCadangAmount;

    public $sukuCadangPredictions = [ ];
    public $sukuCadangIndex = 0;

    public function mount()
    {
        $firstPelanggan = Pelanggan::first();
        $this->pelanggan_id = $firstPelanggan->id;

        $firstJenisService = JenisService::first();
        
        $this->selectedJenisServiceId[0] = $firstJenisService->id;
        $this->jenisServiceAmount[0] = 0;

        $firstSukuCadang = SukuCadang::first();
        
        $this->selectedSukuCadangId[0] = $firstSukuCadang->id;
        $this->sukuCadangAmount[0] = 0;
    }

    public function addServicePrediction()
    {
        $this->serviceIndex++;

        $firstJenisService = JenisService::first();
        
        $this->selectedJenisServiceId[$this->serviceIndex] = $firstJenisService->id;

        array_push($this->servicePredictions, $this->serviceIndex);
        $this->jenisServiceAmount[$this->serviceIndex] = 0;
    }

    public function removeServicePrediction($index)
    {
        unset($this->servicePredictions[$index]);
    }

    public function addSukuCadangPrediction()
    {
        $this->sukuCadangIndex++;

        $firstSukuCadang = SukuCadang::first();
        
        $this->selectedSukuCadangId[$this->sukuCadangIndex] = $firstSukuCadang->id;

        array_push($this->sukuCadangPredictions, $this->sukuCadangIndex);
        $this->sukuCadangAmount[$this->sukuCadangIndex] = 0;
    }

    public function removeSukuCadangPrediction($index)
    {
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


        // Add for index 0
        $perkiraanPenjualanService = new PerkiraanPenjualanService();
        $perkiraanPenjualanService->jenis_service_id = $this->selectedJenisServiceId[0];
        $perkiraanPenjualanService->jumlah = $this->jenisServiceAmount[0];
        $perkiraanPenjualanService->harga = $this->selectedJenisService[0]['harga'];
        $pendaftaran->perkiraan_penjualan_services()->save($perkiraanPenjualanService);

        foreach ($this->servicePredictions as $key => $serviceIndex) {
            $perkiraanPenjualanService = new PerkiraanPenjualanService();
            $perkiraanPenjualanService->jenis_service_id = $this->selectedJenisServiceId[$serviceIndex];
            $perkiraanPenjualanService->jumlah = $this->jenisServiceAmount[$serviceIndex];
            $perkiraanPenjualanService->harga = $this->selectedJenisService[$serviceIndex]['harga'];
            $pendaftaran->perkiraan_penjualan_services()->save($perkiraanPenjualanService);
        }

        // Add for index 0
        $perkiraanPenggantianSukuCadang = new PerkiraanSukuCadang();
        $perkiraanPenggantianSukuCadang->suku_cadang_id = $this->selectedSukuCadangId[0];
        $perkiraanPenggantianSukuCadang->jumlah = $this->sukuCadangAmount[0];
        $perkiraanPenggantianSukuCadang->harga = $this->selectedSukuCadang[0]['harga'];
        $pendaftaran->perkiraan_suku_cadangs()->save($perkiraanPenggantianSukuCadang);

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
        // $selectedJenisService = [];
        $this->selectedJenisService[0] = JenisService::find($this->selectedJenisServiceId[0]);
        foreach ($this->servicePredictions as $key => $serviceIndex) {
            $this->selectedJenisService[$serviceIndex] = JenisService::find($this->selectedJenisServiceId[$serviceIndex]);
        }

        // $selectedSukuCadang = [];
        $this->selectedSukuCadang[0] = SukuCadang::find($this->selectedSukuCadangId[0]);
        foreach ($this->sukuCadangPredictions as $key => $sukuCadangIndex) {
            $this->selectedSukuCadang[$sukuCadangIndex] = SukuCadang::find($this->selectedSukuCadangId[$sukuCadangIndex]);
        }

        $totalPerkiraanService = ($this->selectedJenisService[0]->harga * $this->jenisServiceAmount[0]);
        foreach ($this->servicePredictions as $key => $index) {
            $totalPerkiraanService += ($this->selectedJenisService[$index]->harga * $this->jenisServiceAmount[$index]);
        }

        $totalPerkiraanSukuCadang = ($this->selectedSukuCadang[0]->harga * $this->sukuCadangAmount[0]);
        foreach ($this->sukuCadangPredictions as $key => $index) {
            $totalPerkiraanSukuCadang += ($this->selectedSukuCadang[$index]->harga * $this->sukuCadangAmount[$index]);
        }

        return view('livewire.pendaftaran-service.create', [
            'pelanggans' => Pelanggan::all(),
            'jenisServices' => JenisService::all(),
            'sukuCadangs' => SukuCadang::all(),
            // 'selectedJenisService' => $selectedJenisService,
            // 'selectedSukuCadang' => $selectedSukuCadang,
            'totalPerkiraanService' => $totalPerkiraanService,
            'totalPerkiraanSukuCadang' => $totalPerkiraanSukuCadang
        ]);
    }
}
