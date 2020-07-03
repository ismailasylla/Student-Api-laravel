<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SClass extends Model
{
	protected $table='classes';
    protected $fillable=['code','name','maximum_students','status','description'];
    public function students(){
   	return $this->hasMany('App\Student','class','id');
   }
   public static function createClass($data){
	   	$class= SClass::create([
	                'code'=>$data['code'],
	                'name'=>$data['name'],
	                'status'=>$data['status'],
	                'description'=>isset($data['description'])?$data['description']:'',
	            ]);
	   	return $class;
   }
   public static function updateClass($data){
   	$class=SClass::find($data['id']);
   	if(isset($data['name']) && $data['name']){
			$class['name']=$data['name'];
		}
		if(isset($data['status']) && $data['status'] && ($data['status']=='opened') || ($data['status']=='closed')){
			$class['status']=$data['status'];
		}
		if(isset($data['code']) && $data['code']){
			$class['code']=$data['code'];
		}
		$class->save();
		$class->availble_student=$class->students?count($class->students):0;
   		return $class;
   } 
}
