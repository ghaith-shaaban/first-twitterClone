<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class userPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\user  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, user $model)
    {
        return ($user['admin'] || $user['id'] == $model['id']);
    }

}
