<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Test;

class TestController extends Controller
{
    public function __construct(){
		$this->middleware('auth');
	}

	/**
     * Show the test dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		$tests = Test::all();
		return view('tests.index', ['tests' => $tests]);
    }

    /**
     * Show view for Add Test
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
		return view('tests.edit');
    }

    /**
     * Show view for edit Test
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    	$test = Test::findOrFail($id);
		return view('tests.edit',['test'=>$test]);
    }

    /**
     * Show view for Add Test
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,$id){
		try{
			// Validate input before doing anything
			$validator =$this->validate($request, [
				'name' => 'required|max:255',
			]);
			// TODO validate name and version for the futur, cannot edit a test if a new version exists
			$test;
			if($id == 0){
				$test = new Test();
				$test->version = 1;	
			}
			else{
				$test = Test::findOrFail($id);
				
				//	If new file, we make a new version
				if($request->hasFile('file')){
					$old_test = $test;
					$test = new Test();
					$test->name = $old_test->name;
					$test->version = $old_test->version + 1;
				}
			}
				
			$test->name = $request->input('name');
			$test->active = ($request->input('active') !== null && $request->input('active') == 'on') ? true : false;

			if($request->hasFile('file')){
				//	Get temp file
				$file = $request->file('file');
				$test->uploadFile($file);
			}

			if(!$test->save())
				throw new Exception("Cannot save this test");

			\Session::flash('alert-success','This test have been saved!');
			return redirect('test');

		}catch(Exception $e){
			\Session::flash('alert-danger',$e->getMessage());
			return redirect()->back();
		}
    }
}
