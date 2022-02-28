<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Table extends Component
{
    public $query = "";

    public function render()
    {
        $users = User::search('name', $this->query)->get();

        return view('livewire.user.table', [
            'users' => $users,
        ]);
    }
}
