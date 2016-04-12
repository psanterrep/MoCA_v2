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
     * The test that belong to the consultation.
     */
    public function tests()
    {
        return $this->belongsToMany('App\Test','ConsultationsTests','idConsultation','idTest')->withPivot('result')->withTimestamps();
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
        foreach ($request->input('tests') as $idTest) {
            $test = Test::findOrFail($idTest);
            $this->tests()->attach($test);
        }
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

        $activeTests = $request->input('tests');
        $currentTests = [];

        
        //  Check if a test have been removed
        foreach($this->tests()->get() as $test){
            if(is_null($activeTests) || !in_array($test->id, $activeTests))
                $this->tests()->detach($test);
            else
                $currentTests[] = $test->id;
        }
        
        //  Check if test is not already attach
        if(!is_null($activeTests)){
            foreach ($activeTests as $idTest) {
                $test = Test::findOrFail($idTest);
                if(!in_array($test->id, $currentTests))
                    $this->tests()->attach($test);
            }
        }
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

    /**
    *  Check if the user have already done this test
    * @param int $idTest
    * @return Boolean
    */
    public function canPassTest($idTest){
        return $this->tests()->where('idTest','=',$idTest)->whereNull('result')->count() > 0;
    }

    /**
    * Saved the result for a test
    * @param int $idTest
    * @param json $result
    * @return Boolean
    */
    public function saveResult($idTest, $result){
        foreach ($this->tests as $test) {
            if($test->id == $idTest){
                $test->pivot->result = $result;
                return $test->pivot->save();;
            }
        }
        return false;
    }

    /**
    *  Check if the user have already done a test
    * @return Boolean
    */
    public function hasResult(){
        foreach ($this->tests as $test) {
            if(isset($test->pivot->result)){
                return true;
            }
        }
        return false;
    }

    /**
    *  Return content for csv file
    * @return String
    */
    public function exportResult(){
        $file = "Consultation - ". $this->date."\n";
        
        foreach ($this->tests()->get() as $test){
            $file .= $test->formatResultToCsv();
            $file .= "\n";
        }
        return $file;
    }
}