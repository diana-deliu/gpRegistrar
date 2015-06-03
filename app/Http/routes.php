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

Route::get('medic/add_patient', 'MedicController@addPatient');
Route::post('medic/create_patient', 'MedicController@createPatient');
Route::get('medic/view_patient', 'MedicController@viewPatient');
Route::get('medic/edit_patient/{id}', 'MedicController@editPatient');
Route::post('medic/update_patient/{id}', 'MedicController@updatePatient');
Route::get('medic/remove_patient/{id}', 'MedicController@removePatient');
Route::get('medic/import_patient', 'MedicController@importPatient');

Route::get('medic/patient_buttons/{id}', 'MedicController@buttonsPatient');

Route::get('medic/add_consult/{id}', 'MedicController@addConsult');
Route::post('medic/create_consult/{id}', 'MedicController@createConsult');

//Route::get('admin', 'AdminController@index');
//Route::get('medic', 'MedicController@index');
//Route::get('patient', 'PatientController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

