<?php

namespace App\Policies;

use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KendaraanPolicy
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
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Kendaraan $kendaraan)
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
        //
        return $user->peran->kode_peran === "KBKL" || $user->peran->kode_peran === "ADMN";

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Kendaraan $kendaraan)
    {
        //
        return $user->peran->kode_peran === "KBKL" || $user->peran->kode_peran === "ADMN";

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Kendaraan $kendaraan)
    {
        //
        return $user->peran->kode_peran === "KBKL" || $user->peran->kode_peran === "ADMN";

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Kendaraan $kendaraan)
    {
        //
    }
}
