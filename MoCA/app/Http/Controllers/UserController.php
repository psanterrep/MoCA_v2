<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\User\Admin;
use App\User\Doctor;
use App\User\Patient;
use App\User\User_Type;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the new user page.
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $types = User_Type::All();
        return view('users.edit', ['types' => $types]);
    }

    /**
     * Show the edit user page.
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $user = User::find($id);
        $types = User_Type::All();
        return view('users.edit', ['user' => $user, 'types' => $types]);
    }

    /**
     * Delete this user.
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('user');
    }

    /**
     * Save user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,$id){
        
        // Get the instance of the user
        $user = $this->getUserClassByType($request->input('type'),$id);

        $saved = $user->saveFromRequest($request);

        $json;
        if($saved){
            $json['state'] = "The user {$user->username} has been saved!";
            $json['message'] = "success";
        }    
        else{
            $json['state'] = "error";
            $json['message'] = "The user {$user->username} failed to be saved!";
        }
       
        return response()->json($json);  
    }

    /**
     * Update the user information.
     *
     * @param  Int  $type_id
     * @return Instance of Doctor, Admin or Patient
     */
    private function getUserClassByType($type_id, $id){
        $user;
        switch($type_id){
            case 1 :
                if(Admin::find($id))
                    $user = Admin::find($id);
                else
                    $user = new Admin();
            break;
            case 2 :
                if(Doctor::find($id))
                    $user = Doctor::find($id);
                else
                    $user = new Doctor();
            break;
            case 3 :
                if(Patient::find($id))
                    $user = Patient::find($id);
                else
                    $user = new Patient();
            break;
        }
        $user->id = $id;
        return $user;
    }
}
