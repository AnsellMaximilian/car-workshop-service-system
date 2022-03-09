<?php

namespace App\Http\Livewire\Peran;

use App\Models\Peran;
use Livewire\Component;

class Index extends Component
{
    public $query = "";
    public $sortField;
    public $sortDir = "asc";

    public $nama_peran;
    public $peranToEditCode;

    public $isModalOpen = false;
    
    public function setSort($field)
    {
        if($this->sortField === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDir = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit($code)
    {
        $peran = Peran::find($code);

        $this->peranToEditCode = $code;

        $this->nama_peran = $peran->nama_peran;

        $this->isModalOpen = true;

    }

    public function update()
    {
        $this->validate([
            'nama_peran' => 'required|max:25'
        ]);

        $peran = Peran::find($this->peranToEditCode);

        $peran->nama_peran = $this->nama_peran;
        $peran->save();
        $this->reset(['nama_peran']);

        $this->isModalOpen = false;
    }

    public function render()
    {

        $perans = Peran::search('nama_peran', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)->get();

        return view('livewire.peran.index', [
            'perans' => $perans
        ]);
    }
}
