<?php

namespace App\Policies;

use App\User;
use App\Snack;
use Illuminate\Auth\Access\HandlesAuthorization;

class snackPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Confirm user is allowed to edit snack
     * @param User $user
     * @param Snack $snack
     * @return bool
     */
    public function edit(User $user, Snack $snack){
        return $user->id === $snack->owner_id;
    }
    
    /**
     * Confirm user is allowed to delete book
     * @param User $user
     * @param Snack $snack
     * @return bool
     */
    public function delete(User $user, Snack $snack){
        return $user->id === $snack->owner_id;
    }
}
