<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function add(){
		$validator = Validator::make($req->all(), [
            "code" => "required",
            "name" => "required",
            'status' => "required",
        ]);

        if ($validator->fails()) {
            $response=array(
                'status'=>false,
                'code'=>400,
                'param'=>'code,name and status are required.',
                'message'=>'Please fill the all required data.',
            );

        }else{
            $class=SClass::create([
                'code'=>$req->code,
                'name'=>$req->name,
                'status'=>$req->status,
                'description'=>$req->description,
            ]);
            if($class){
                $response=array(
                    'status'=>true,
                    'code'=>200,
                    'message'=>'class created successfully',
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
    public function edit(){

    }
    public function list(){

    }
    public function view(){

    }
}
