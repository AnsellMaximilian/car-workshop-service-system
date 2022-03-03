<?php

namespace App\Http\Livewire\MerkDanTipe;

use App\Models\Merk;
use App\Models\Tipe;
use Livewire\Component;

class Index extends Component
{
    // Search and sort
    public $tipeSortField;
    public $tipeSortDir = "asc";

    public $merkSortField;
    public $merkSortDir = "asc";

    // Create and Edit
    public $isMerkModalOpen = false;
    public $isTipeModalOpen = false;
    public $isMerkEditMode = false;
    public $isTipeEditMode = false;

    // Merk
    public $merk;
    public $merkToEditId;

    // Tipe
    public $merk_id;
    public $tipe;
    public $tipeToEditId;


    public function mount()
    {
        $firstMerk = Merk::first();
        
        if(old('merk_id')){
            $this->merk_id = old('merk_id');
        }else {
            if($firstMerk) {
                $this->merk_id = $firstMerk->id;
            }
        }
    }
    
    public function setSortTipe($field)
    {
        if($this->tipeSortField === $field) {
            $this->tipeSortDir = $this->tipeSortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->tipeSortDir = 'asc';
        }

        $this->tipeSortField = $field;
    }

    public function setSortMerk($field)
    {
        if($this->merkSortField === $field) {
            $this->merkSortDir = $this->merkSortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->merkSortDir = 'asc';
        }

        $this->merkSortField = $field;
    }

    public function setEditMode($model, $state)
    {
        if($model === 'tipe'){
            $this->isTipeEditMode = $state;
        }else {
            $this->isMerkEditMode = $state;

        }
    }

    public function setMerkModalOpen($state)
    {
        $this->isMerkModalOpen = $state;
    }

    public function setTipeModalOpen($state)
    {
        $this->isTipeModalOpen = $state;
    }

    public function storeTipe()
    {
        $this->validate([
            'tipe' => 'required|max:25',
            'merk_id' => 'required|exists:merks,id',
        ]);

        $newTipe = new Tipe;
        $newTipe->tipe = $this->tipe;
        $newTipe->merk_id = $this->merk_id;

        $newTipe->save();

        $this->reset(['tipe']);
        $this->setTipeModalOpen(false);
    }

    public function editTipe($id)
    {
        $tipeToEdit = Tipe::findOrFail($id);
        $this->isTipeEditMode = true;
        $this->tipeToEditId = $id;
        $this->tipe = $tipeToEdit->tipe;
        $this->merk_id = $tipeToEdit->merk_id;

        $this->isTipeModalOpen = true;
    }
    
    public function updateTipe()
    {
        $this->validate([
            'tipeToEditId' => 'required',
            'tipe' => 'required|max:25',
            'merk_id' => 'required|exists:merks,id',
        ]);

        $tipeToEdit = Tipe::findOrFail($this->tipeToEditId);
        $tipeToEdit->tipe = $this->tipe;
        $tipeToEdit->merk_id = $this->merk_id;

        $tipeToEdit->save();
        $this->reset(['tipe']);
        $this->isTipeModalOpen = false;
    }

    public function storeMerk()
    {
        $this->validate([
            'merk' => 'required|max:25',
        ]);

        $newMerk = new Merk;
        $newMerk->merk = $this->merk;

        $newMerk->save();

        $this->reset(['merk']);
        $this->setMerkModalOpen(false);
    }

    public function editMerk($id)
    {
        $merkToEdit = Merk::findOrFail($id);
        $this->isMerkEditMode = true;
        $this->merkToEditId = $id;
        $this->merk = $merkToEdit->merk;

        $this->isMerkModalOpen = true;
    }
    
    public function updateMerk()
    {
        $this->validate([
            'merkToEditId' => 'required',
            'merk' => 'required|max:25',
        ]);

        $merkToEdit = Merk::findOrFail($this->merkToEditId);
        $merkToEdit->merk = $this->merk;

        $merkToEdit->save();
        $this->reset(['merk']);
        $this->isMerkModalOpen = false;
    }

    public function destroyTipe(Tipe $tipe)
    {
        $tipe->delete();
    }

    public function destroyMerk(Merk $merk)
    {
        $merk->delete();
    }

    public function render()
    {
        $tipes = Tipe::query()
         ->optionalSort($this->tipeSortField, $this->tipeSortDir)->get();

         $merks = Merk::query()
         ->optionalSort($this->merkSortField, $this->merkSortDir)->get();

        return view('livewire.merk-dan-tipe.index', [
            'tipes' => $tipes,
            'merks' => $merks,
        ]);
    }
}
