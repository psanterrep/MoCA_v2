<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\User\Admin;
use App\User\Doctor;
use App\User\Patient;
use App\User\User_Type;
use View;
use App;
use Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
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
        try{
            $user = User::find($id);
            if(!$user->delete())
                throw new Exception("Cannot remove this user!");
            
            \Session::flash('alert-success','This user have been deleted!');
            return redirect('user');

        }catch(Exception $e){
            \Session::flash('alert-danger',$e->getMessage());
            return redirect()->back();
        
        }
    }

    /**
     * Save user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,$id){
        
        try{
            $rules = array(
                        'username' => 'required|max:255',
                        'type' => 'required|integer|min:1'
                    );
            if($id == 0)
                $rules['email'] ='required|email|max:255|unique:Users,email';
            else 
                $rules['email'] ='required|email|max:255';
            
            // Validate input before doing anything
            $validator =$this->validate($request, $rules);
                
            // Get the instance of the user
            $user = $this->getUserClassByType($request->input('type'),$id);

            $saved = $user->saveFromRequest($request);

            if(!$saved){
                throw new Exception("Cannot save user!");
            }

            if($id == 0)    
                \Session::flash('alert-success','This user have been created! The password is the same as the username');
            else
                \Session::flash('alert-success','This user have been saved!');
            return redirect('user');
       }
       catch(Exception $e){
            \Session::flash('alert-danger',$e->getMessage());
            return redirect()->back();
       }
    }

    /**
     * Update the view user information.
     *
     * @param  Int  $idType
     * @return JSon response
     */
    public function reloaduserinfo($idType){
        return response()->json(['html' => View::make('users.more_user_info')->with(['idType'=>$idType])->render()]);
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

    /**
     * Update the user information.
     *
     * @param  Int  $type_id
     * @return Instance of Doctor, Admin or Patient
     */
    private function getInfoView($type_id, $id){
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

    /**
     * Change lang
     *
     * @param  String  $lang
     * @return view
     */
    public function switchLang($lang){
        $language = Session::set('language',$lang);
        return redirect()->back();
    }
}
