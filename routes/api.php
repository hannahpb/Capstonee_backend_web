<?php

use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ReqMedController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\MedicalRecordController;

Route::get('/students', [StudentController::class, 'index']);
Route::post('/add-student', [StudentController::class, 'store']);
Route::get('/count', [StudentController::class, 'num']);
Route::get('/counter', [StudentController::class, 'numall']);
Route::get('/female', [StudentController::class, 'female']);
Route::get('/male', [StudentController::class, 'male']);
Route::get('/edit-student/{id}', [StudentController::class, 'edit']);
Route::put('update-student/{id}', [StudentController::class, 'update']);
Route::get('/search/{key}', [StudentController::class, 'search']);
Route::delete('delete-student/{id}', [StudentController::class, 'destroy']);
Route::get('/join/{id}', [StudentController::class, 'joinsearch']);
Route::get('/studjoin', [StudentController::class, 'join']);

Route::get('/yrlvl', [StudentController::class, 'yrlvl']);
Route::get('/course', [StudentController::class, 'course']);

Route::get('/first', [StudentController::class, 'first']);
Route::get('/second', [StudentController::class, 'second']);
Route::get('/third', [StudentController::class, 'third']);
Route::get('/fourth', [StudentController::class, 'fourth']);
Route::get('/fifth', [StudentController::class, 'fifth']);

Route::get('/engineering', [StudentController::class, 'engineering']);
Route::get('/maritime', [StudentController::class, 'maritime']);
Route::get('/education', [StudentController::class, 'education']);
Route::get('/nursing', [StudentController::class, 'nursing']);
Route::get('/psychology', [StudentController::class, 'psychology']);
Route::get('/architecture', [StudentController::class, 'architecture']);
Route::get('/accountancy', [StudentController::class, 'accountancy']);
Route::get('/aas', [StudentController::class, 'aas']);
Route::get('/criminology', [StudentController::class, 'criminology']);
Route::get('/ccms', [StudentController::class, 'ccms']);
Route::get('/htm', [StudentController::class, 'htm']);

Route::get('/RC', [StudentController::class, 'RC']);
Route::get('/BA', [StudentController::class, 'BA']);
Route::get('/IG', [StudentController::class, 'IG']);
Route::get('/PRR', [StudentController::class, 'PRR']);

Route::get('/cvs', [StudentController::class, 'cvs']);

Route::get('/single', [StudentController::class, 'single']);
Route::get('/married', [StudentController::class, 'married']);
Route::get('/sep', [StudentController::class, 'sep']);
Route::get('/pref', [StudentController::class, 'pref']);

Route::get('/doctors', [DoctorController::class, 'index']);
Route::post('/add-doctor', [DoctorController::class, 'store']);
Route::get('/edit-doctor/{id}', [DoctorController::class, 'edit']);
Route::put('update-doctor/{id}', [DoctorController::class, 'update']);
Route::delete('delete-doctor/{id}', [DoctorController::class, 'destroy']);
Route::get('/dcount', [DoctorController::class, 'doctorcount']);

Route::get('/guardian', [GuardianController::class, 'index']);
Route::post('/add-guardian', [GuardianController::class, 'store']);
Route::get('/edit-guardian/{id}', [GuardianController::class, 'edit']);
Route::put('update-guardian/{id}', [GuardianController::class, 'update']);
Route::delete('delete-guardian/{id}', [GuardianController::class, 'destroy']);
Route::get('/search-guardian/{key}', [GuardianController::class, 'search']);


Route::post('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);
Route::get('/users',[UserController::class, 'index']);
Route::get('/edit-user/{id}',[UserController::class, 'edit']);
Route::put('/verifyuser/{id}', [UserController::class, 'update']);

Route::post('mregister',[UserAccountController::class, 'register']);
Route::post('mlogin',[UserAccountController::class, 'login']);
Route::get('/useraccdetails', [UserAccountController::class, 'index']);
Route::get('/edit/{id}', [UserAccountController::class, 'edit']);
Route::put('/update-user/{id}', [UserAccountController::class, 'update']);
Route::put('/update-pw/{id}', [UserAccountController::class, 'updatepw']);


Route::get('/appointment', [AppointmentController::class, 'index']);
Route::get('/dentalappointment', [AppointmentController::class, 'dental']);
Route::post('/addapt', [AppointmentController::class, 'store']);
Route::get('/edit-apt/{id}', [AppointmentController::class, 'edit']);
Route::put('/update-apt/{id}', [AppointmentController::class, 'update']);
Route::get('/apt/{id}', [AppointmentController::class, 'find']);
Route::get('/pending', [AppointmentController::class, 'pending']);
Route::get('/accepted', [AppointmentController::class, 'accepted']);

Route::get('/medcert', [ReqMedController::class, 'index']);
Route::post('/reqmed', [ReqMedController::class, 'store']);
Route::get('/edit-medcert/{id}', [ReqMedController::class, 'edit']);
Route::put('update-medcert/{id}', [ReqMedController::class, 'update']);
Route::get('/medi/{id}', [ReqMedController::class, 'find']);
Route::delete('delete-medcert/{id}', [ReqMedController::class, 'destroy']);

Route::get('/medrec', [MedicalRecordController::class, 'index']);
Route::post('/addmedrec', [MedicalRecordController::class, 'store']);
Route::get('/find-medrec/{id}', [MedicalRecordController::class, 'find']);