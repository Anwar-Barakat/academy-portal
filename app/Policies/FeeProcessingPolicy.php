<?php

namespace App\Policies;

use App\Models\FeeProcessing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeeProcessingPolicy
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
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FeeProcessing $feeProcessing)
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
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FeeProcessing $feeProcessing)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FeeProcessing $feeProcessing)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FeeProcessing $feeProcessing)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FeeProcessing $feeProcessing)
    {
        //
    }
}
