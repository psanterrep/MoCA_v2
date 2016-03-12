<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use User\User_Type;
use App\User\Admin;
use App\User\Doctor;
use App\User\Patient;

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
     * Get the additional information about the user.
     */
    public function info()
    {
        if($this->type->id == 1){
            return Admin::find($this->id);
        }
        if($this->type->id == 2){
            return Doctor::find($this->id);
        }
        if($this->type->id == 3){
            return Patient::find($this->id);
        }
    }

    /**
     * Update the user information.
     *
     * @param  Request  $request
     * @return Boolean
     */
    public function saveFromRequest(Request $request){

        /*if( isset($this->idUserType))
            $this->info()->delete();*/

        $this->username = $request->input('username');
        $this->email = $request->input('email');
        $this->idUserType = $request->input('type');

        return $this->save();
    }
}
