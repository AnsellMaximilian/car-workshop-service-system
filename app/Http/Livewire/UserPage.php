<?php

namespace App\Http\Livewire;

use App\Models\Peran;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class UserPage extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Search and sort
    public $query = "";
    public $sortField;
    public $sortDir = "asc";

    // Modal
    public $isModalOpen = false;

    // New and edit
    public $name, $kode_peran, $email, $alamat, $photo, $noTelp, $password, $password_confirmation;
    public $userToUpdate;

    public $editMode = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'kode_peran' => 'required|exists:perans,kode_peran',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function mount()
    {
        $this->kode_peran = Peran::first()->kode_peran;
    }

    public function setEditMode($state)
    {
        $this->editMode = $state;
    }

    public function setSort($field)
    {
        if($this->sortField === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDir = 'asc';
        }

        $this->sortField = $field;
    }

    public function store()
    {
        $this->validate();
        $user = new User;

        $user->name = $this->name;
        $user->kode_peran = $this->kode_peran;
        $user->email = $this->email;
        $user->alamat = $this->alamat;
        $user->noTelp = $this->noTelp;
        $user->password = Hash::make($this->password);

        if($this->photo){
            $photoFile = $this->photo;
            $photoPath = $photoFile->store('avatars', 'public');
            $user->photo = $photoPath;
        }

        $user->save();

        event(new Registered($user));

        $this->reset(['name', 'kode_peran', 'email', 'alamat', 'photo', 'noTelp', 'password', 'password_confirmation']);
        $this->isModalOpen = false;
    }

    public function edit(User $user)
    {
        $this->userToUpdate = $user;

        $this->name = $user->name;
        $this->kode_peran = $user->kode_peran;
        $this->email = $user->email;
        $this->alamat = $user->alamat;
        $this->noTelp = $user->noTelp;
        
        $this->editMode = true;
        $this->isModalOpen = true;
    }
    
    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'kode_peran' => 'required|exists:perans,kode_peran'
        ]);

        if($this->userToUpdate){
            $this->userToUpdate->name = $this->name;
            $this->userToUpdate->kode_peran = $this->kode_peran;
            $this->userToUpdate->alamat = $this->alamat;
            $this->userToUpdate->noTelp = $this->noTelp;

            $this->userToUpdate->save();
        }
        $this->reset(['name', 'kode_peran', 'email', 'alamat', 'photo', 'noTelp', 'password', 'password_confirmation']);
        
        $this->isModalOpen = false;
    }

    public function destroy(User $user)
    {
        $user->delete();
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
