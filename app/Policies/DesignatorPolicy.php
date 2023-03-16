<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Designator;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DesignatorPolicy
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
        return in_array($user->role, [RoleEnum::Admin, RoleEnum::ProjectHead]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Designator $designator)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array($user->role, [RoleEnum::Admin, RoleEnum::ProjectHead]);
    }

    /**
     * Determine whether the user can edit any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function editAny(User $user)
    {
        return in_array($user->role, [RoleEnum::Admin, RoleEnum::ProjectHead]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Designator $designator)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Designator $designator)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Designator $designator)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Designator $designator)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }
}
