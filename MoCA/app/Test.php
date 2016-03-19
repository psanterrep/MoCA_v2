<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'Tests';

    /*
    *	Base path to test
    */
    public function getBasePath(){
    	return storage_path()."/tests/";
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
}
