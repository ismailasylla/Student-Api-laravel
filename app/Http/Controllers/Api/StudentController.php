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
        $code=0;
		$validator = Validator::make($req->all(), [
            "first_name" => "required",
            "last_name" => "required",
            'class' => "required|numeric|exists:classes,code",
            'date_of_birth' => "required|date",
        ]);

        if ($validator->fails()) {
            $code=400;
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'first_name,last_name,class and date_of_birth are required.',
                'message'=>$validator->errors(),
            );

        }else{
            $student=Student::createStudent($req->all());
            $class=SClass::where('code',$req->class)->first();
           if(count($class->students)<10){
           	    if($student){
                    $code=200;
	                $response=array(
	                    'status'=>true,
	                    'code'=>200,
	                    'message'=>'student created successfully',
	                    'data'=>$student
	                );
	            }else{
	               $code=500;
	                $response=array(
	                    'status'=>false,
	                    'code'=>500,
	                    'message'=>'student not added successfully',

	                );
	            }
           }else{
            $code=500;
	           	$response=array(
		                    'status'=>false,
		                    'code'=>500,
		                    'message'=>'student not added because class reach the maximum student limit',
		                );
           }

        }
        return response()->json($response,$code)->header('Content-Type', 'application/x-www-form-urlencoded')
                  ->header('Access-Control-Allow-Origin', '*');
    }
    public function edit(Request $req){
		$validator = Validator::make($req->all(), [
            "id" => "required",
            'class'=>'numeric',
            'date_of_birth' => "date",
        ]);
        if ($validator->fails()) {
            $code=400;
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
                $code=200;
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'student updated successfully',
                    'data'=>$student
                );
            }else{
               $code=400;
                $response=array(
                    'status'=>false,
                    'code'=>400,
                    'message'=>'student not found',
                );
            }
        }
        return response()->json($response)->header('Content-Type', 'application/x-www-form-urlencoded')
                  ->header('Access-Control-Allow-Origin', '*');
    }
    public function list(){
    	$students=Student::all();
        $students2=[];
    	foreach ($students as $key => $value) {
    		$student_class_data=$value->classData;
    		$value->class=$student_class_data->code;
    		$value->class_data=$student_class_data;
            // $students2[$key]['id']=$value->id;
            // $students2[$key]['first_name']=$value->first_name;
            // $students2[$key]['first_name']=$value->first_name;
    	}
        $code=200;
    	$response=array(
                'status'=>true,
                'code'=>200,
                'message'=>'Data of all the students with class.',
                'data'=>$students
            );
    	//  return response()->json($students,$code)->header('Content-Type', 'application/x-www-form-urlencoded')->header('Access-Control-Allow-Origin', '*');
    	 return response()->json($students,$code)->header('Access-Control-Allow-Origin', '*');

    }
    public function view(Request $req){
    	$validator = Validator::make($req->all(), [
            "id" => "required|numeric",
        ]);

        if ($validator->fails()) {
            $code=400;
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
                $code=200;
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'student updated successfully',
                    'data'=>$student
                );
            }else{
               $code=400;
                $response=array(
                    'status'=>false,
                    'code'=>400,
                    'message'=>'student not found',
                );
            }
        }
         return response()->json($response,$code)->header('Content-Type', 'application/x-www-form-urlencoded')
                  ->header('Access-Control-Allow-Origin', '*');
    }
}
