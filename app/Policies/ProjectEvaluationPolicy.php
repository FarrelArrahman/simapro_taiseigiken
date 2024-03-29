<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\ProjectEvaluation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectEvaluationPolicy
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
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProjectEvaluation $projectEvaluation)
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
        return in_array($user->role, [RoleEnum::Manager]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProjectEvaluation $projectEvaluation)
    {
        return in_array($user->role, [RoleEnum::Manager]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProjectEvaluation $projectEvaluation)
    {
        return in_array($user->role, [RoleEnum::Manager]) && $projectEvaluation->evaluatedBy->id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProjectEvaluation $projectEvaluation)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProjectEvaluation $projectEvaluation)
    {
        return in_array($user->role, [RoleEnum::Admin]);
    }
}
