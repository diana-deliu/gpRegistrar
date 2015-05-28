<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('create_admin', 'AdminController@create');

Route::get('admin/add_medic', 'AdminController@addMedic');
Route::post('admin/create_medic', 'AdminController@createMedic');
Route::get('admin/view_medic', 'AdminController@viewMedic');
Route::get('admin/edit_medic/{id}', 'AdminController@editMedic');
Route::post('admin/update_medic/{id}', 'AdminController@updateMedic');
Route::get('admin/remove_medic/{id}', 'AdminController@removeMedic');

Route::get('admin/view_patient', 'AdminController@viewPatient');


//Route::get('admin', 'AdminController@index');
//Route::get('medic', 'MedicController@index');
//Route::get('patient', 'PatientController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

