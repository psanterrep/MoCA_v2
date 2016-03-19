<?php

namespace App\Consultation;

use Illuminate\Database\Eloquent\Model;

class Consultation_Type extends Model
{
    protected $table = 'ConsultationTypes';

    const SUPERVISED = 1;
    const UNSUPERVISED = 2;

    /**
     * Get consultation.
     */
    public function consultation()
    {
        return $this->belongsToMany('App\Consultations');
    }
}
