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
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $perans = Peran::all();
        return view('auth.register', ['perans' => $perans]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'kode_peran' => 'required|exists:perans,kode_peran',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($request);
        // dd($request->all());

        $user = new User;

        $user->name = $request->name;
        $user->kode_peran = $request->kode_peran;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->noTelp = $request->noTelp;
        $user->password = Hash::make($request->password);

        if($request->hasFile('photo')){
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('avatars', 'public');
            $user->photo = $photoPath;
        }

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {
        

        return view('users.index');
    }
}
