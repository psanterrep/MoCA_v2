<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Consultation;
use App\User\Patient;

class ConsultationController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
     * Show the consultation dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$consultations = Auth::user()->info()->consultations();
    	return view('consultations.index', ['consultations' => $consultations]);
    }

    /**		
	* Show the page add consultation 
	*
    * @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function add($id){
		return view('consultations.add', ['id' => $id]);
	}

	/**		
	* Show the page add consultation 
	*
    * @param  Request  $request
    * @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function save(Request $request, $idPatient){
		$consultation = new Consultation();
		$patient = Patient::find($idPatient);
		$json;
		if($consultation->createFromRequest($request, $patient, Auth::user()->info())){
			$json['state'] = "success";
			$json['message'] = "success!";
		}    
		else{
			$json['state'] = "error";
			$json['message'] = "Failed to be saved!";
		}
		//return view('consultation.add', ['id' => $id]);
	}
}
