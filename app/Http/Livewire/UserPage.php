<?php

namespace App\Http\Livewire;

use App\Models\Peran;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserPage extends Component
{
    use WithPagination;

    // Search and sort
    public $query = "";
    public $sortField;
    public $sortDir = "asc";

    // New entry

    public function setSort($field)
    {
        if($this->sortField === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDir = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $users = User::search('name', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->paginate(10);

        return view('livewire.user-page', [
            'users' => $users,
            'perans' => Peran::all(),
        ]);
    }
}
