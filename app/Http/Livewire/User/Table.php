<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Table extends Component
{
    public $query = "";

    public function render()
    {
        $users = $this->query ? User::where('name', 'like', '%'.$this->query.'%')->get() : User::all();
        return view('livewire.user.table', [
            'users' => $users,
        ]);
    }
}
