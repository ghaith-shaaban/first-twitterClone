<?php

namespace App\Policies;

use App\Models\User;
use App\Models\comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class commentPolicy
{
    use HandlesAuthorization;




    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, comment $comment)
    {
       return ($user['id'] === $comment['user_id']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, comment $comment)
    {
        return ($user['admin'] || $user['id'] === $comment['user_id']);
    }




}
