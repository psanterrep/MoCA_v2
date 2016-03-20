<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Consultation;
use App\Test;
use App\Consultation\Consultation_Type;
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
    	$now = date('Y-m-d H:i:s');
		$consultations = Auth::user()->info()->consultations()->where('date','>',$now)->get();
    	return view('consultations.index', ['consultations' => $consultations]);
    }

    /**
     * Show the consultation edit page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    	$consultation = Consultation::findOrFail($id);
    	$tests = Test::all();
    	return view('consultations.edit', ['consultation' => $consultation, 'tests'=> $tests]);
    }

    /**		
	* Show the page add consultation 
	*
    * @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function add($idPatient){
		$types = Consultation_Type::all();
		$tests = Test::all();

		return view('consultations.add', ['id' => $idPatient,'types'=>$types,'tests'=> $tests]);
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
		$patient = Patient::findOrFail($idPatient);
		$json;
		if($consultation->createFromRequest($request, $patient, Auth::user()->info())){
			$json['state'] = "success";
			$json['message'] = "success!";
		}    
		else{
			$json['state'] = "error";
			$json['message'] = "Failed to be saved!";
		}
		return response()->json($json);
	}

	/**		
	* Update consultation 
	*
    * @param  Request  $request
    * @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $idConsultation){
		$consultation = Consultation::findOrFail($idConsultation);
		$json;
		if($consultation->updateFromRequest($request)){
			$json['state'] = "success";
			$json['message'] = "success!";
		}    
		else{
			$json['state'] = "error";
			$json['message'] = "Failed to be updated!";
		}
		return response()->json($json);
	}

	/**		
	* Cancel consultation 
	*
    * @param  Request  $request
    * @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function cancel($idConsultation){
		$consultation = Consultation::findOrFail($idConsultation);
		$json;
		if($consultation->cancel()){
			$json['state'] = "success";
			$json['message'] = "success!";
		}    
		else{
			$json['state'] = "error";
			$json['message'] = "Failed to be updated!";
		}
		 return redirect('consultation');
	}
}
