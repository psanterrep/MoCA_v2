<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;

class Patient extends Model
{
    protected $table = 'Patients';


    /**
     * The patient that belong to the doctor.
     */
    public function followedby()
    {
        return $this->belongsTo('App\User\Follow');
    }

    /**
     * The profile of the patient
     */
    public function profile()
    {
        return $this->belongsTo('App\User','id','id');
    }

    /**
     *  Consultation of a patient
     */
    public function consultations()
    {
        return $this->belongsToMany('App\Consultation','PatientsConsultations','idPatient','idConsultation')->withTimestamps();
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
       
        /*TODO
        $this->idPlace = $request->input('place');
        $this->idRole = $request->input('role');*/
        return $this->save();
    }

    /**
     * Get a patient associated with the username
     *
     * @param  String  $username
     * @return Boolean or Patient
     */
     public static function findByUsername($username){
        $patients = self::all();
        foreach($patients as $patient){
            if($patient->profile->username == $username)
                return $patient;
        }

        return false;
     }

     /**
     *  Return all id where username is similar to the search
     *
     * @param  String  $name
     * @return Array of id
     */
     public static function getPatientsWithName($name){
        $name = '%'.$name.'%';
        $users = User::where('username','LIKE',$name)->get();
        $ids = [];

        //  Transform all user to patient
        foreach ($users as $user) {
            if($user->isPatient())
                $ids[] = $user->id;
        }
        return $ids;
     }

    /**
    * Return specific consultation
    * @return Consultation
    */
    public function getConsultation($id){
        return $this->consultations()->where('idConsultation','=',$id)->first();
    }
}
