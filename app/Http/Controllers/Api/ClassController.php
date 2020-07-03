<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SClass;
use Illuminate\Support\Facades\Validator;
class ClassController extends Controller
{
   public function add(Request $req){
		$validator = Validator::make($req->all(), [
            "code" => "required|unique:classes|numeric",
            "name" => "required",
            'status' => "required|in:opened,closed",
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'code,name and status are required.',
                'message'=>$validator->errors(),
            );

        }else{

            $class=SClass::createclass($req->all());
            if($class){
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'class created successfully',
                    'data'=>$class
                );
            }else{
               
                $response=array(
                    'status'=>false,
                    'code'=>500,
                    'message'=>'class not add successfully',
                );
            }
        }
        return response()->json($response);
    }
    public function edit(Request $req){
		$validator = Validator::make($req->all(), [
            "id" => "required",
            'status' => "in:opened,closed",
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'id is required.',
                'message'=>$validator->errors(),
            );

        }else{
            $class=SClass::find($req->id);
            if($class){
     //        	if($req->code){
					// $class->code=$req->code;
     //        	}
				$class=SClass::updateClass($req->all());
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'class updated successfully',
                    'data'=>$class
                );
            }else{
               
                $response=array(
                    'status'=>false,
                    'code'=>400,
                    'message'=>'class not found',
                );
            }
        }
        return response()->json($response);
    }
    public function list(){
    	$classes=SClass::all();
    	foreach ($classes as $key => $value) {
    		$value->maximum_students=$value->maximum_students;
            $value->availble_student=$value->students?count($value->students):0;
    	}
    	$response=array(
                'status'=>true,
                'code'=>200,
                'message'=>'Data of all the students with class.',
                'data'=>$classes
            );
    	 return response()->json($response);
    }
    public function view(Request $req){
    	$validator = Validator::make($req->all(), [
            "id" => "required|numeric",
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'id is required.',
                'message'=>'Please fill the all required feild.',
            );

        }else{
			$class=SClass::find($req->id);
            if($class){
            	$class->maximum_students=$class->maximum_students;
            	$class->availble_student=$class->students?count($class->students):0;
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'student updated successfully',
                    'data'=>$class
                );
            }else{
               
                $response=array(
                    'status'=>false,
                    'code'=>400,
                    'message'=>'student not found',
                );
            }
        }
         return response()->json($response);
    }
}
