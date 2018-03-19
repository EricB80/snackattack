<?php

namespace App\Repositories;

use App\User;
use App\Snack;

class SnackRepository{
    
    /**
     * Get the snacks owned by the user
     * @param User $user injected user instance
     * @return collection   array of query results
     */
    public function userSnacks(User $user){
        return Snack::where('owner_id', $user->id)->get();
    }
    
    /**
     * Get the details for a user owned snack
     * @param User $user
     * @param type $snack
     * @return type
     */
    public function snackDetails(User $user, $snack){
        return Snack::where('owner_id', $user->id)
                ->where('id', $snack)
                ->get();
    }
    
    /**
     * Method adds a snack tied to the user
     * Placing in Repo to separate from enpoints
     * @param obs $request HTTP Request object
     * @return boolean
     */
    public function addSnack($request){
        $snack = new Snack;
        $snack->snack_name = $request->name;
        $snack->pieces = $request->quantity;
        $snack->owner_id = $request->user()->id;
        try{
            $snack->save();
        } catch (Exception $ex) {
            return false;
        }
        
        return true;
    }
}
