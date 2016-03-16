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
    public function __construct()
    {
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
        $doctor = Auth::user()->info();
        $doctor->stopFollowPatient($id);
        // TODO Manage error
        return redirect('follow');
    }

    /**
     * Save a new follow.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
    	try{
            $doctor = Auth::user()->info();
    	$patient = Patient::findByUsername($request->input('username'));

        $json;
        if(!$patient)
            throw new Exception("The patient doesnt exist");

        if(!$doctor->followPatient($patient))
            throw new Exception("Failed to be saved!");


        $json['state'] = "success";
        $json['message'] = "The user doctor follow a new patient!";
       
        }
        catch(Exception $e){
            $json['state'] = "error";
            $json['message'] = $e->getMessage();
        }
    	
		return response()->json($json); 
    }
}
