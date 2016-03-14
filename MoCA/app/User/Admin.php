<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;

class Admin extends Model
{
    protected $table = 'Admins';

    /**
     * The profile of the patient
     */
    public function profile()
    {
        return $this->belongsTo('App\User','id','id');
    }

    
	/**
     * Update the user information.
     *
     * @param  Request  $request
     * @return Boolean
     */
    public function saveFromRequest(Request $request){
       if(!isset($this->id))
            $user = new User();
        else
            $user = User::find($this->id);


        $user->saveFromRequest($request);
       
        /*TODO
        $this->idPlace = $request->input('place');
        $this->idRole = $request->input('role');*/
        return $this->save();
    }
}