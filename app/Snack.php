<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Snack extends Model
{
    /**
     * Assignable variables
     */
    protected $fillable = [
        'snack_name', 'pieces', 'description'
    ];
    
    /**
     * Tie a snack to a user
     * 
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
