<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;


Route::get('/',[HomeControll::class, 'HomeIndex']);
Route::get('/visitor',[VisitorController::class, 'VisitorIndex']);

//admin panel service management
Route::get('/services',[ServiceController::class, 'ServiceIndex']);
Route::get('/serviceget',[ServiceController::class, 'getServicesData']);
Route::post('/servicedelete',[ServiceController::class, 'ServiceDelete']);
Route::post('/servicedetails',[ServiceController::class, 'getServicesDetails']);
Route::post('/serviceupdate',[ServiceController::class, 'ServiceUpdata']);
Route::post('/serviceadd',[ServiceController::class, 'ServiceAdd']);


//admin panel course management
Route::get('/courses',[CoursesController::class, 'CoursesIndex']);
Route::get('/Coursesget',[CoursesController::class, 'getCoursesData']);
Route::post('/Coursesdelete',[CoursesController::class, 'CoursesDelete']);
Route::post('/Coursesdetails',[CoursesController::class, 'getCoursesDetails']);
Route::post('/Coursesupdate',[CoursesController::class, 'CoursesUpdata']);
Route::post('/Coursesadd',[CoursesController::class, 'CoursesAdd']);

//admin panel project management
Route::get('/Project',[ProjectController::class, 'ProjectIndex']);
 Route::get('/getProjectData', [ProjectController::class, 'getProjectData']);
 Route::post('/ProjectDetails', [ProjectController::class, 'getProjectDetails']);
 Route::post('/ProjectUpdate', [ProjectController::class, 'ProjectUpdate']);
 Route::post('/ProjectDelete', [ProjectController::class, 'ProjectDelete']);
Route::post('/ProjectAdd', [ProjectController::class, 'ProjectAdd']);

// Admin Panel Projects Management 
Route::get('/Contact', [ContactController::class, 'ContactIndex']);
Route::get('/getContactData', [ContactController::class, 'getContactData']);
Route::post('/ContactDelete', [ContactController::class, 'ContactDelete']);


