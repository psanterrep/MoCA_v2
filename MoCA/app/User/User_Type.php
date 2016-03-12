<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class User_Type extends Model
{
    protected $table = 'UserTypes';

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
