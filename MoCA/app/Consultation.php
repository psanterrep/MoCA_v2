<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User\Doctor;
use App\User\Patient;
use App\Consultation\Consultation_Type;

class Consultation extends Model
{
    protected $table = 'Consultations';

    /**
     * The patients that belong to the consultations.
     */
    public function patients()
    {
        return $this->belongsToMany('App\User\Patient','PatientsConsultations','idConsultation','idPatient')->withTimestamps();
    }

    /**
     * The doctors that belong to the consultation.
     */
    public function doctors()
    {
        return $this->belongsToMany('App\User\Doctor','DoctorsConsultations','idConsultation','idDoctor')->withTimestamps();
    }

    /**
    * Get the type record associated with the consultation.
    */
    public function type()
    {
        return $this->hasOne('App\Consultation\Consultation_Type','id','idType');
    
    }

    /*
    *  Get all type  for a consultation
    */
    public static function allTypes(){
        $types = Consultation_Type::all();
        return $types;
    }

	/**
     * Create the consultation .
     *
     * @param  Request  $request
     * @param  Patient       $patient
     * @param  Doctor       $doctor
     * @return Boolean
     */
    public function createFromRequest(Request $request, $patient, $doctor){
        $this->date = $request->input('date');
        $this->comment = $request->input('comment');
        $this->idType = $request->input('type');
        $this->save();
        $this->patients()->attach($patient);
        $this->doctors()->attach($doctor);
        return true;
    }

    /**
     * Update the consultation .
     *
     * @param  Request  $request
     * @return Boolean
     */
    public function updateFromRequest(Request $request){
        $this->date = $request->input('date');
        $this->comment = $request->input('comment');
        $this->idType = $request->input('type');
        $this->save();
        return true;
    }

    /**
     * Cancel the consultation .
     *
     * @param  Request  $request
     * @return Boolean
     */
    public function cancel(){
        $this->date = date('c');
        $this->save();
        return true;
    }
}