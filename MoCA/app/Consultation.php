<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User\Doctor;
use App\User\Patient;

class Consultation extends Model
{
    protected $table = 'Consultations';

    /**
     * The consultation that belong to the patient.
     */
    public function patients()
    {
        return $this->belongsToMany('App\User\Patient','PatientsConsultations','idConsultation','idPatient')->withTimestamps();
    }

    /**
     * The consultation that belong to the doctors.
     */
    public function doctors()
    {
        return $this->belongsToMany('App\User\Doctor','DoctorsConsultations','idConsultation','idDoctor')->withTimestamps();
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
        $this->idType = 1;
        $this->save();
        $this->patients()->attach($patient);
        $this->doctors()->attach($doctor);
        return true;
    }
}