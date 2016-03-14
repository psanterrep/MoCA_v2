<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;
use App\User\Follow;

class Doctor extends Model
{
    protected $table = 'Doctors';

    /**
     * The patient that belong to the doctor.
     */
    public function follows()
    {
        return $this->hasMany('App\User\Follow','idDoctor');
    }

    /**
     * The profile of the patient
     */
    public function profile()
    {
        return $this->belongsTo('App\User','id','id');
    }

    /**
     * Follow a new patient
     *
     * @param  Patient  $patient
     * @return Boolean
     */
    public function followPatient(Patient $patient){
       $follow = new Follow();
       $follow->idDoctor = $this->id;
       $follow->idPatient = $patient->id;
       $follow->dateStartFollowed = date('c');
       return $follow->save();
    }

    public function stopFollowPatient($id){
        foreach($this->follows as $follow){
            if($follow->id == $id){
                $follow->dateEndFollowed = date('c');
                return  $follow->save();
            }
        }
        return false;       
    }
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
