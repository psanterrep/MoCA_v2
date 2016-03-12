<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use User\User_Type;

class User extends Authenticatable
{
    protected $table = 'Users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get the type record associated with the user.
     */
    public function type()
    {
        return $this->hasOne('App\User\User_Type','id','idUserType');
    }

    /**
     * Update the user information.
     *
     * @param  Request  $request
     * @return Boolean
     */
    public function saveFromRequest(Request$request){

        $this->username = $request->input('username');
        $this->email = $request->input('email');
        $this->idUserType = $request->input('type');
        return $this->save();
    }
}
