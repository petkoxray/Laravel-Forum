<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param User $signInUser
     * @return bool
     */
    public function update(User $user, User $signInUser)
    {
        return $signInUser->id === $user->id;
    }
}
