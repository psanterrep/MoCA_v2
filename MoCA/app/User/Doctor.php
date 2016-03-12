<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;

class Doctor extends Model
{
    protected $table = 'Doctors';

    /**
     * Update the user information.
     *
     * @param  Request  $request
     * @return Boolean
     */
    public function saveFromRequest(Request $request){
        if(User::find($this->id))
        	$user = User::find($this->id);
        else
        	$user = new User();


        $user->saveFromRequest($request);
        $this->name = $request->input('type');
        $this->firstname = $request->input('firstname');
       
        /*TODO
        $this->idPlace = $request->input('place');
        $this->idRole = $request->input('role');*/
        return $this->save();
    }
}
