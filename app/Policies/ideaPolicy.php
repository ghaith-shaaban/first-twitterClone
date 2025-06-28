<?php

namespace App\Policies;

use App\Models\User;
use App\Models\idea;
use Illuminate\Auth\Access\HandlesAuthorization;

class ideaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, idea $idea)
    {
      return ($user['admin'] || $user['id'] === $idea['user_id']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, idea $idea)
    {
        return ($user['admin'] || $user['id'] === $idea['user_id']);
    }

}
