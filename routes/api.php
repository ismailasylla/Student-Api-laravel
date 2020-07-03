<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//student api route
Route::post('student/add','Api\StudentController@add');
Route::post('student/edit','Api\StudentController@edit');
Route::get('student/all','Api\StudentController@list');
Route::get('student/view','Api\StudentController@view');
//class api route
Route::post('class/add','Api\ClassController@add');
Route::post('class/edit','Api\ClassController@edit');
Route::get('class/all','Api\ClassController@list');
Route::get('class/view','Api\ClassController@view');