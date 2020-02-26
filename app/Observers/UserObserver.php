<?php

namespace App\Observers;

use App\User;
use Carbon\Carbon;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->age = Carbon::parse($user->date_of_birth)->diffInYears();
    }
}
