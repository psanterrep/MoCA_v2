<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\User\Doctor;
use App\User\Patient;

class Follow extends Model
{
    protected $table = 'Follow';


    /**
     * The patient that belong to the doctor.
     */
    public function patient()
    {
        return $this->belongsTo('App\User\Patient','idPatient','id');
    }

    /**
     * The patient that belong to the doctor.
     */
    public function doctor()
    {
        return $this->belongsTo('App\User\Doctor','idDocteur','id');
    }
}
