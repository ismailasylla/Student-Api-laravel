<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function add(Request $req){
		$validator = Validator::make($req->all(), [
            "first_name" => "required",
            "last_name" => "required",
            'class' => "required",
            'date_of_birth' => "required",
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'first_name,last_name,class and date_of_birth are required.',
                'message'=>'Please fill the all required data.',
            );

        }else{
            $student=Student::create([
                'first_name'=>$req->first_name,
                'last_name'=>$req->last_name,
                'class'=>$req->class,
                'date_of_birth'=>$req->date_of_birth,
            ]);
            if($student){
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'student created successfully',
                );
            }else{
               
                $response=array(
                    'status'=>false,
                    'code'=>500,
                    'message'=>'student not add successfully',
                );
            }
        }
        return response()->json($response);
    }
    public function edit(Request $req){
		$validator = Validator::make($req->all(), [
            "id" => "required",
            'class'=>'numeric'
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'id is required. and class is integer value',
                'message'=>'Please fill the all required feild.',
            );

        }else{
            $student=Student::find($req->id);
            if($student){
            	if($req->first_name){
					$student->first_name=$req->first_name;
            	}
				if($req->last_name){
					$student->last_name=$req->last_name;
            	}
            	if($req->class){
					$student->class=$req->class;
            	}
            	if($req->code){
					$student->code=$req->code;
            	}
            	$student->save();
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'student updated successfully',
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
    public function list(){
    	
    }
    public function view($id){
    	$validator = Validator::make($req->all(), [
            "id" => "required",
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'id is required.',
                'message'=>'Please fill the all required feild.',
            );

        }else{
			$student=Student::find($req->id);
            if($student){
            	$student_class_data=$student->class;
            	$student->class=$student_class_data;
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'student updated successfully',
                    'data'=>$student
                );
            }else{
               
                $response=array(
                    'status'=>false,
                    'code'=>400,
                    'message'=>'student not found',
                );
            }
        }
    }
}
