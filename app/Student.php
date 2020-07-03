<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   protected $fillable=['first_name','last_name','class','date_of_birth'];
   public function classData(){
   	return $this->belongsto('App\SClass','class','id');
   }
   public static function createStudent($data){
   	$student=Student::create([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'class'=>$data['class'],
                'date_of_birth'=>$data['date_of_birth'],
            ]);
   	return $student;
   }
   public static function updateStudent($data){
   	$student=Student::find($data['id']);
   	 if($student){
    	if(isset($data['first_name'] )&& $data['first_name']) {
			$student->first_name=$data['first_name'];
    	}
		if(isset($data['last_name']) && $data['last_name']){
			$student->last_name=$data['last_name'];
    	}
    	if(isset($data['class']) && $data['class']){
			$student->class=$data['class'];
    	}
    	if(isset($data['date_of_birth']) && $data['date_of_birth']){
			$student->code=$data['date_of_birth'];
    	}
    	$student->save();
    	return $student;
   }
}
}
