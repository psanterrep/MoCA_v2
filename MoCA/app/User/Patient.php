<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;

class Patient extends Model
{
    protected $table = 'Patients';

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
        $this->id = $user->id;
        $this->name = $request->input('type');
        $this->firstname = $request->input('firstname');
       
        /*TODO
        $this->idPlace = $request->input('place');
        $this->idRole = $request->input('role');*/
        return $this->save();
    }
}
