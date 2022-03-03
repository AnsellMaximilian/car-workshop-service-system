<?php

namespace App\Http\Livewire\SukuCadang;

use App\Models\PemasukkanSukuCadang;
use App\Models\PengeluaranSukuCadang;
use App\Models\SukuCadang;

use Livewire\Component;

class Show extends Component
{
    public $sukuCadang;
    public $jumlah_pemasukkan = 0;
    public $jumlah_pengeluaran = 0;

    public function mount($id)
    {
        $this->sukuCadang = SukuCadang::findOrFail($id);
    }

    public function addToStock()
    {
        $this->validate([
            'jumlah_pemasukkan' => 'required|numeric|min:0'
        ]);
        $pemasukkan = new PemasukkanSukuCadang;
        $pemasukkan->jumlah = $this->jumlah_pemasukkan;

        $this->sukuCadang->pemasukkan_suku_cadangs()->save($pemasukkan);
        $this->sukuCadang->refresh();

        $this->reset(['jumlah_pemasukkan']);
    }

    public function removeFromStock()
    {
        $this->validate([
            'jumlah_pengeluaran' => 'required|numeric|min:0'
        ]);
        $pengeluaran = new PengeluaranSukuCadang;
        $pengeluaran->jumlah = $this->jumlah_pengeluaran;

        $this->sukuCadang->pengeluaran_suku_cadangs()->save($pengeluaran);
        $this->sukuCadang->refresh();

        $this->reset(['jumlah_pengeluaran']);
    }

    public function render()
    {
        // dd($this->sukuCadang->getTotalPemasukkan());

        return view('livewire.suku-cadang.show', ['sukuCadang' => $this->sukuCadang]);
    }
}
