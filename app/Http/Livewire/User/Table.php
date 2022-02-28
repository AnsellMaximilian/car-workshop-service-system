<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Table extends Component
{
    public $query = "";
    public $sortField;
    public $sortDir = "asc";

    public function setSort($field)
    {
        $this->sortField = $field;
    }

    public function render()
    {
        $users = User::search('name', $this->query)
            ->optionalSort($this->sortField, $this->sortDir)
            ->get();

        return view('livewire.user.table', [
            'users' => $users,
        ]);
    }
}
