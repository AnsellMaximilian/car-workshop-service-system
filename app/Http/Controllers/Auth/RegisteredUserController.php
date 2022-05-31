<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Peran;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{

    public function create()
    {
        $perans = Peran::all();
        return view('users.create', ['perans' => $perans]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'kode_peran' => 'required|exists:perans,kode_peran',
            'photo' => 'mimes:jpg,jpeg,png',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->kode_peran = $request->kode_peran;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->noTelp = $request->noTelp;
        $user->password = Hash::make($request->password);

        if($request->hasFile('photo')){
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('avatars', 'public_uploads');
            $user->photo = $photoPath;
        }

        $user->save();

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {
        return view('users.index');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);


        return view('users.edit', ['user' => $user, 'perans' => Peran::all()]);
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kode_peran' => 'required|exists:perans,kode_peran',
            'photo' => 'mimes:jpg,jpeg,png',
        ]);

        $user->update($data);

        if($request->hasFile('photo')){
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('avatars', 'public');
            $user->photo = $photoPath;
            $user->save();
        }

        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if(
            count($user->pendaftaran_services) > 0 ||
            count($user->pembayarans) > 0 ||
            count($user->persetujuan_services) > 0
        ){
            return redirect(route('users.index'))->with('error', 'Tidak bisa hapus.');
 
        }
        $user->delete();

        return redirect(route('users.index'));
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }
}
