<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User\Follow;
use App\User\Patient;

class FollowController extends Controller
{
    /**
     * Show the all patient for this user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $follows = Auth::user()->info()->follow;
        return view('follows.index', ['follows' => $follows]);
    }

    public function add(){
        return view('follows.add');
    }

    public function remove($id){
        $follow = Follow::find($id);
        $follow->dateEndFollowed = date('c');
        $follow->save();
        return redirect('follow');
    }

    /**
     * Save a new follow.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
    	$doctor = Auth::user()->info();
    	$patient = Patient::findByUsername($request->input('username'));

        $json;
        if(!$patient){
            $json['state'] = "success";
            $json['message'] = "The patient doesnt exist";
        }
        else if($doctor->followPatient($patient)){
            $json['state'] = "The user doctor follow a new patient!";
            $json['message'] = "success";
        }    
        else{
            $json['state'] = "error";
            $json['message'] = "Failed to be saved!";
        }
    	
		return response()->json($json); 
    }
}
