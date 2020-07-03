<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Validation;
use Illuminate\Support\Facades\Validator;
use App\SClass;
class StudentController extends Controller
{
    public function add(Request $req){
		$validator = Validator::make($req->all(), [
            "first_name" => "required",
            "last_name" => "required",
            'class' => "required|numeric|exists:classes,id",
            'date_of_birth' => "required|date",
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'first_name,last_name,class and date_of_birth are required.',
                'message'=>$validator->errors(),
            );

        }else{
            $student=Student::createStudent($req->all());
            $class=SClass::find($req->class);
           if(count($class->students)<10){
           	    if($student){
	                $response=array(
	                    'status'=>true,
	                    'code'=>200,
	                    'message'=>'student created successfully',
	                    'data'=>$student
	                );
	            }else{

	                $response=array(
	                    'status'=>false,
	                    'code'=>500,
	                    'message'=>'student not added successfully',

	                );
	            }
           }else{
	           	$response=array(
		                    'status'=>false,
		                    'code'=>500,
		                    'message'=>'student not added because class reach the maximum student limit',
		                );
           }

        }
        return response()->json($response);
    }
    public function edit(Request $req){
		$validator = Validator::make($req->all(), [
            "id" => "required",
            'class'=>'numeric',
            'date_of_birth' => "date",
        ]);
        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'id is required. and class is integer value',
                'message'=>$validator->errors(),
            );

        }else{
            $student=Student::find($req->id);
          		if($student){
              	$student=Student::updateStudent($req->all());
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
        return response()->json($response);
    }
    public function list(){
    	$students=Student::all();
    	foreach ($students as $key => $value) {
    		$student_class_data=$value->classData;
    		$value->class=$student_class_data->code;
    		$value->class_data=$student_class_data;
    	}
    	$response=array(
                'status'=>true,
                'code'=>200,
                'message'=>'Data of all the students with class.',
                'data'=>$students
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
			$student=Student::find($req->id);
            if($student){
            	$student_class_data=$student->classData;
            	$student->class=$student_class_data->code;
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
         return response()->json($response);
    }
}
