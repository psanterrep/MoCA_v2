<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Consultation;
use App\Test;
use App\Consultation\Consultation_Type;
use App\User\Patient;
use View;
use Hash;

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
		$user = Auth::user();
		$consultations = $user->info()->consultations()->where('date','>',$now)->orderBy('date','ASC')->get();  

		if(Auth::user()->isPatient()) 	
			return view('consultations.indexpatient', ['consultations' => $consultations]);
		elseif(Auth::user()->isDoctor())
			return view('consultations.indexdoctor', ['consultations' => $consultations]);
	}


	/**
	 * Show the consultation list for a patient specified in the search
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function updateConsultationList(Request $request){
		$patientName = $request->input('name');
		$patients = Patient::getPatientsWithName($patientName);
		$consultations = Consultation::select(array('Consultations.id','Consultations.idType','Consultations.date','Consultations.comment'))
										->join('PatientsConsultations', 'PatientsConsultations.idConsultation', '=', 'Consultations.id')
										->join('DoctorsConsultations', 'DoctorsConsultations.idConsultation', '=', 'Consultations.id')
										->where('DoctorsConsultations.idDoctor','=',Auth::user()->id)
										->orderBy('date', 'DESC');
		if($patientName != '')
			$consultations->whereIn('PatientsConsultations.idPatient',$patients);

		$consultations = $consultations->get();
		return response()->json(['html' => View::make('consultations.items')->with(['consultations'=>$consultations])->render()]);
	}

	/**
	 * Activate a test for a user
	 *
	 * @param  Request  $request
	 * @param  int  $idConsultation
	 * @param  int  $idTest
	 * @return \Illuminate\Http\Response
	 */
	public function activateSupervisedTest(Request $request, $idConsultation, $idTest){
		
		try{
			$consultation = Consultation::findOrFail($idConsultation);
			$canPassTest = $consultation->canPassTest($idTest);
			if($canPassTest){
				foreach ($consultation->doctors()->get() as $doctor) {
					if($doctor->profile->username == $request->input('password'))
						return response()->json(['passwordMatch'=>true]);
				}
			}
			return response()->json(['passwordMatch'=>false,'error'=>'Password not matching']);
			
		}
		catch(Exception $e){
			return response()->json(['passwordMatch'=>false,'error'=>$e->getMessage()]);
		}
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
	* @param  int  $idPatient
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
	* @param  int  $idConsultation
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

	/**		
	* Show the page for a test for this consultation 
	*
	* @param  int  $idConsultation
	* @param  int  $idTest
	* @return \Illuminate\Http\Response
	*/
	public function takeTest($idConsultation, $idTest){
		try{
			//	TODO Add validation check here
			$consultation = Consultation::findOrFail($idConsultation);
			$test = Test::findOrFail($idTest);
			return view('consultations.test', ['consultation' => $consultation,'test'=>$test]);
		}catch(Exception $e){
			\Session::flash('alert-danger',$e->getMessage());
			return redirect()->back();
		}
	}

	/**		
	* Save result for a test
	*
	* @param  int  $idConsultation
	* @param  int  $idTest
	* @return \Illuminate\Http\Response
	*/
	public function saveTestResult(Request $request, $idConsultation, $idTest){
		try{
			$consultation = Consultation::findOrFail($idConsultation);
			if(!$consultation->saveResult($idTest, $request->input('result')))
				return response()->json(['error'=>'Cannot save the result for this test']);

			//return response()->json(['message'=>'Data saved!']);
		}catch(Exception $e){
			return response()->json(['error'=> $e->getMessage()]);
		}
	}
}