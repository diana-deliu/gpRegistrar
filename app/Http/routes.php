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

Route::get('medic/account_details', 'MedicController@accountDetails');
Route::get('patient/account_details', 'PatientController@accountDetails');

Route::post('medic/edit_password', 'MedicController@editPassword');
Route::post('patient/edit_password', 'PatientController@editPassword');

Route::get('admin/add_medic', 'AdminController@addMedic');
Route::post('admin/create_medic', 'AdminController@createMedic');
Route::get('admin/view_medics', 'AdminController@viewMedics');
Route::get('admin/edit_medic/{id}', 'AdminController@editMedic');
Route::post('admin/update_medic/{id}', 'AdminController@updateMedic');
Route::get('admin/remove_medic/{id}', 'AdminController@removeMedic');

Route::get('medic/add_patient', 'MedicController@addPatient');
Route::post('medic/create_patient', 'MedicController@createPatient');
Route::get('medic/view_patients', 'MedicController@viewPatients');
Route::get('medic/get_patients', 'MedicController@getPatientsArray');
Route::get('medic/edit_patient/{id}', 'MedicController@editPatient');
Route::post('medic/update_patient/{id}', 'MedicController@updatePatient');
Route::get('medic/remove_patient/{id}', 'MedicController@removePatient');
Route::get('medic/patient_details/{id}', 'MedicController@patientDetails');

Route::get('medic/import_patient', 'MedicController@importPatientForm');
Route::post('medic/import_patient', 'MedicController@importPatient');
Route::get('medic/export_patient', 'MedicController@exportPatient');

Route::get('medic/add_consult/{id}', 'MedicController@addConsult');
Route::get('medic/add_consult', 'MedicController@addConsult');
Route::post('medic/create_consult', 'MedicController@createConsult');
Route::get('medic/view_patientconsults/{id}', 'MedicController@viewPatientConsults');
Route::get('medic/view_patientlabs/{id}', 'MedicController@viewPatientLabs');
Route::get('medic/view_patientvaccines/{id}', 'MedicController@viewPatientVaccines');
Route::get('medic/view_patienttreatments/{id}', 'MedicController@viewPatientTreatments');

Route::get('medic/view_generalconsults', 'MedicController@viewGeneralConsults');
Route::get('medic/consult_details/{id}', 'MedicController@consultDetails');
Route::get('medic/edit_consult/{id}', 'MedicController@editConsult');
Route::post('medic/update_consult/{id}', 'MedicController@updateConsult');
Route::get('medic/remove_consult/{id}', 'MedicController@removeConsult');

Route::get('medic/add_lab', 'MedicController@addLab');
Route::post('medic/create_lab', 'MedicController@createLab');
Route::get('medic/view_labs', 'MedicController@viewLabs');
Route::get('medic/lab_details/{id}', 'MedicController@labDetails');
Route::get('medic/edit_lab/{id}', 'MedicController@editLab');
Route::post('medic/update_lab/{id}', 'MedicController@updateLab');
Route::get('medic/remove_lab/{id}', 'MedicController@removeLab');

Route::get('medic/add_vaccine', 'MedicController@addVaccine');
Route::post('medic/create_vaccine', 'MedicController@createVaccine');
Route::get('medic/view_vaccines', 'MedicController@viewVaccines');
Route::get('medic/vaccine_details/{id}', 'MedicController@vaccineDetails');
Route::get('medic/edit_vaccine/{id}', 'MedicController@editVaccine');
Route::post('medic/update_vaccine/{id}', 'MedicController@updateVaccine');
Route::get('medic/remove_vaccine/{id}', 'MedicController@removeVaccine');

Route::get('medic/add_treatment', 'MedicController@addTreatment');
Route::post('medic/create_treatment', 'MedicController@createTreatment');
Route::get('medic/view_treatments', 'MedicController@viewTreatments');
Route::get('medic/treatment_details/{id}', 'MedicController@treatmentDetails');
Route::get('medic/edit_treatment/{id}', 'MedicController@editTreatment');
Route::post('medic/update_treatment/{id}', 'MedicController@updateTreatment');
Route::get('medic/remove_treatment/{id}', 'MedicController@removeTreatment');

Route::get('medic/add_survey', 'MedicController@addSurvey');
Route::post('medic/create_survey', 'MedicController@createSurvey');
Route::get('medic/view_surveys', 'MedicController@viewSurveys');
Route::get('medic/survey_details/{id}', 'MedicController@surveyDetails');
Route::get('medic/edit_survey/{id}', 'MedicController@editSurvey');
Route::post('medic/update_survey/{id}', 'MedicController@updateSurvey');
Route::get('medic/remove_survey/{id}', 'MedicController@removeSurvey');

Route::get('medic/view_answers/{id}', 'MedicController@viewAnswers');
Route::get('medic/answer_details/{id}/{surveyId}', 'MedicController@answerDetails');

/*************************** PATIENT **************************/
Route::get('patient/view_registry', 'PatientController@viewRegistry');
Route::get('patient/view_consults', 'PatientController@viewConsults');
Route::get('patient/consult_details/{id}', 'PatientController@consultDetails');

Route::get('patient/view_labs', 'PatientController@viewLabs');
Route::get('patient/lab_details/{id}', 'PatientController@labDetails');

Route::get('patient/view_vaccines', 'PatientController@viewVaccines');
Route::get('patient/vaccine_details/{id}', 'PatientController@vaccineDetails');

Route::get('patient/view_treatments', 'PatientController@viewTreatments');
Route::get('patient/treatment_details/{id}', 'PatientController@treatmentDetails');

Route::get('patient/view_surveys', 'PatientController@viewSurveys');
Route::get('patient/add_answers/{id}', 'PatientController@addAnswers');
Route::post('patient/create_answers/{id}', 'PatientController@createAnswers');

Route::get('patient/edit_registry', 'PatientController@editRegistry');

Route::get('medic/calendar', 'CalendarController@medicGet');
Route::get('patient/calendar', 'CalendarController@patientGet');

Route::get('medic/notifications', 'NotificationsController@medicGet');
Route::get('patient/notifications', 'NotificationsController@patientGet');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

