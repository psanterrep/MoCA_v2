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
	public function __construct(){
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
		try{
			// Validate input before doing anything
			$validator =$this->validate($request, [
				'date' => 'required|max:255',
				'type' => 'required|integer|min:1|exists:ConsultationTypes,id',
			]);

			$consultation = new Consultation();
			$patient = Patient::findOrFail($idPatient);

			if(!$consultation->createFromRequest($request, $patient, Auth::user()->info()))
				throw new Exception("Cannot save this consultation");

			\Session::flash('alert-success','This consultation have been updated!');
			return redirect('consultation');

		}catch(Exception $e){
			\Session::flash('alert-danger',$e->getMessage());
			return redirect()->back();
		}
	}

	/**		
	* Update consultation 
	*
    * @param  Request  $request
    * @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $idConsultation){
		try{
			// Validate input before doing anything
			$validator =$this->validate($request, [
				'date' => 'required|max:255',
				'type' => 'required|integer|min:1|exists:ConsultationTypes,id',
			]);

			$consultation = Consultation::findOrFail($idConsultation);
			if(!$consultation->updateFromRequest($request))
				throw new Exception("Cannot update this consultation");

			\Session::flash('alert-success','This consultation have been updated!');
			return redirect('consultation');

		}catch(Exception $e){
			\Session::flash('alert-danger',$e->getMessage());
			return redirect()->back();
		}
	}

	/**		
	* Cancel consultation 
	*
    * @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function cancel($idConsultation){
		try{
			$consultation = Consultation::findOrFail($idConsultation);
			
			if(!$consultation->cancel())
				throw new Exception("Cannot stop this consultation");

			\Session::flash('alert-success','This consultation have been canceled!');
			return redirect('consultation');

		}catch(Exception $e){
			\Session::flash('alert-danger',$e->getMessage());
			return redirect()->back();
		}
	}
}
