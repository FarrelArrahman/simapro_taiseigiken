<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\ProjectDesignatorProgressUpdate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectDesignatorProgressUpdatePolicy
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
     * @param  \App\Models\ProjectDesignatorProgressUpdate  $projectDesignatorProgressUpdate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProjectDesignatorProgressUpdate $projectDesignatorProgressUpdate)
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
        return in_array($user->role, [RoleEnum::Worker, RoleEnum::ProjectHead]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectDesignatorProgressUpdate  $projectDesignatorProgressUpdate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProjectDesignatorProgressUpdate $projectDesignatorProgressUpdate)
    {
        return in_array($user->role, [RoleEnum::Manager, RoleEnum::ProjectHead]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectDesignatorProgressUpdate  $projectDesignatorProgressUpdate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProjectDesignatorProgressUpdate $projectDesignatorProgressUpdate)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectDesignatorProgressUpdate  $projectDesignatorProgressUpdate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProjectDesignatorProgressUpdate $projectDesignatorProgressUpdate)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectDesignatorProgressUpdate  $projectDesignatorProgressUpdate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProjectDesignatorProgressUpdate $projectDesignatorProgressUpdate)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }
}
