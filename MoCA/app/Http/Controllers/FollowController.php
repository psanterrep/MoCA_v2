<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User\Follow;
use App\User\Patient;
use Exception;

class FollowController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the all patient for this user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $follows = Auth::user()->info()->follows;
        return view('follows.index', ['follows' => $follows]);
    }

	/**
	* Show the page to follow a new patient
	*
	* @return \Illuminate\Http\Response
	*/
    public function add(){
        return view('follows.add');
    }


     /**
     * Stop to follow a patient
     *
     * @return \Illuminate\Http\Response
     */
    public function remove($id){
        try{
            $doctor = Auth::user()->info();
            $result = $doctor->stopFollowPatient($id);

            if(!$result)
                throw new Exception("Cannot stop following this patient!");

            \Session::flash('alert-success','You stopped to follow this patient!');
            return redirect('follow');
        }
        catch(Exception $e){
            \Session::flash('alert-danger',$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Save a new follow.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
    	try{
            // Validate input before doing anything
            $validator =$this->validate($request, [
                'username' => 'required|max:255|exists:Users,username',
            ]);

            //  Get current user
            $doctor = Auth::user()->info();
        	$patient = Patient::findByUsername($request->input('username'));


            if(!$patient)
                throw new Exception("This patient doesn't exist!");

            if(!$doctor->followPatient($patient))
                throw new Exception("Cannot follow this patient!");

            \Session::flash('alert-success','You are now following this patient!');
            return redirect('follow');
        }
        catch(Exception $e){
            \Session::flash('alert-danger',$e->getMessage());
            return redirect()->back();
        }
        
    }

    /**     
    * Show result for all test for a patient
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function showresults($id){
        try{

            //  Get current user
            $doctor = Auth::user()->info();

            if(!$doctor->isFollowingPatient($id))
                throw new Exception("This is not your patient!");

            $patient = Patient::findOrFail($id);
            return view('follows.testresults', ['patient' => $patient]);
        }catch(Exception $e){
            \Session::flash('alert-danger',$e->getMessage());
            return redirect()->back();
        }
    }

     /**     
    * Export result for all test for a patient
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function exportResults($id){
        try{

            //  Get current user
            $doctor = Auth::user()->info();

            if(!$doctor->isFollowingPatient($id))
                throw new Exception("This is not your patient!");

            $patient = Patient::findOrFail($id);


            $file= "";

            //  Get all consultation
            foreach ($patient->consultations()->get() as $consultation){
                //  Get file content
                $file .= $consultation->exportResult();
                $file .= "\n";
            }
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="'.$patient->profile->username.'_export_'.date('Y-m-d').'.csv";');
            print_r($file);
            exit();

        }catch(Exception $e){
            \Session::flash('alert-danger',$e->getMessage());
            return redirect()->back();
        }
    }
}
