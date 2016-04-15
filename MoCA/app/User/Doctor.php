<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;
use App\User\Follow;
use Exception;

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
     *  Consultation of a doctor
     */
    public function consultations()
    {
        return $this->belongsToMany('App\Consultation','DoctorsConsultations','idDoctor','idConsultation')->withTimestamps();
    }

    /**
     * Follow a new patient
     *
     * @param  Patient  $patient
     * @return Boolean
     */
    public function followPatient(Patient $patient){
        if(!$this->isFollowingPatient($patient->id)){
            $follow = new Follow();
            $follow->idDoctor = $this->id;
            $follow->idPatient = $patient->id;
            $follow->dateStartFollowed = date('c');
            return $follow->save();
        }
        else
            throw new Exception("Already following this patient!");
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
        
        $user;

        if(!isset($this->profile) && is_null(User::find($this->id)))
            $user = new User();
        else
            $user = User::find($this->id);


        $user->saveFromRequest($request);
        $this->id = $user->id;
        $this->name = $request->input('name');
        $this->firstname = $request->input('firstname');

        /*TODO
        $this->idPlace = $request->input('place');
        $this->idRole = $request->input('role');*/
        return $this->save();
    }

    /**
     * Check if the doctor already follow the patient
     *
     * @param  int  $id
     * @return Boolean
     */
    public function isFollowingPatient($idPatient){
        foreach($this->follows()->get() as $follow){
            if($follow->patient->id == $idPatient)
                return true;
        }
        return false;
    }

    /**
    * Return specific consultation
    * @return Consultation
    */
    public function getConsultation($id){
        return $this->consultations()->where('idConsultation','=',$id)->first();
    }
}
