<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */

    public function show(User $user, Project $project)
    {

        return $project->owner_id == $user->id || 4;
    }

    public function update(User $user, Project $project)
    {
        // has this user got permission to view this project

        //dd($user);
        return $project->owner_id == $user->id;
    }

}
