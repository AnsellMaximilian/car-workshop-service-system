<?php

namespace App\Policies;

use App\Models\SukuCadang;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SukuCadangPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SukuCadang  $sukuCadang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SukuCadang $sukuCadang)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->peran->kode_peran === "KBKL" || $user->peran->kode_peran === "KGDG";
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SukuCadang  $sukuCadang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SukuCadang $sukuCadang)
    {
        return $user->peran->kode_peran === "KBKL" || $user->peran->kode_peran === "KGDG";
        
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SukuCadang  $sukuCadang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SukuCadang $sukuCadang)
    {
        return $user->peran->kode_peran === "KBKL" || $user->peran->kode_peran === "KGDG";
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SukuCadang  $sukuCadang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SukuCadang $sukuCadang)
    {
        //
    }

    public function control_stock(User $user, SukuCadang $sukuCadang)
    {
        return $user->peran->kode_peran === "KGDG";
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SukuCadang  $sukuCadang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SukuCadang $sukuCadang)
    {
        //
    }
}
