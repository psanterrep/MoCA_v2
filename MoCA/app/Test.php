<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'Tests';

    /**
     *  Tests used in those consultations
     */
    public function consultations()
    {
        return $this->belongsToMany('App\Consultation','Results','idTest','idConsultation')->withPivot('result')->withTimestamps();
    }

    /*
    *	Base path to test
    */
    public function getBasePath(){
    	return storage_path()."/tests/".$this->name."/";
    }

    /*
    *   Full path to test
    */
    public function getFullPath(){
        return $this->getBasePath().$this->path;
    }

    /*
    *	Upload file
    */
    public function uploadFile($file){

    	//	Set the new filename
		$filename = $this->name."_v".$this->version.".".$file->getClientOriginalExtension();
		$this->path = $filename;

		//	Move to the storage folder
		$file->move($this->getBasePath(), $filename);
		$this->save();
    }

    /*
    *   Check if this test is the latest version
    */
    public function isLatestVersion(){
        $test = Test::where('name','=',$this->name)->orderBy('version','DESC')->first();
        if($test->version > $this->version)
            return false;
        return true;
    }

    /**
    *  Return content of a test for csv file
    * @return String
    */
    public function formatResultToCsv(){
        $json = $this->pivot->result;
        $results = json_decode($json, true);
        
        //  Add test's informations
        $columnsName = ['Test name', 'version'];
        $columnValue = [$this->name, $this->version];
        
        $file = "";
        //  Add test's result
        foreach ($results as $key => $value) {
            array_push($columnsName, $key);
            array_push($columnValue, $value);
        }
       
        $file .= implode($columnsName, ',')."\n";
        $file .= implode($columnValue, ',')."\n";

        return $file;
    }
}
