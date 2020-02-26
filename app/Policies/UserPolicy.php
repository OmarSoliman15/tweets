<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can follow the user.
     *
     * @param \App\User $auther
     * @param \App\User $user
     * @return mixed
     */
    public function follow(User $auther, User $user)
    {
        return !$auther->is($user->user);
    }

    /**
     * Determine whether the user can unfollow the user.
     *
     * @param \App\User $auther
     * @param \App\User $user
     * @return mixed
     */
    public function unfollow(User $auther, User $user)
    {
        return !$auther->is($user->user);
    }
}
