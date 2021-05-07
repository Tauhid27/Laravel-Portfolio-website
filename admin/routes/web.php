<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;


Route::get('/',[HomeControll::class, 'HomeIndex'])->middleware('loginCheck');
Route::get('/visitor',[VisitorController::class, 'VisitorIndex'])->middleware('loginCheck');

//admin panel service management
Route::get('/services',[ServiceController::class, 'ServiceIndex'])->middleware('loginCheck');
Route::get('/serviceget',[ServiceController::class, 'getServicesData'])->middleware('loginCheck');
Route::post('/servicedelete',[ServiceController::class, 'ServiceDelete'])->middleware('loginCheck');
Route::post('/servicedetails',[ServiceController::class, 'getServicesDetails'])->middleware('loginCheck');
Route::post('/serviceupdate',[ServiceController::class, 'ServiceUpdata'])->middleware('loginCheck');
Route::post('/serviceadd',[ServiceController::class, 'ServiceAdd'])->middleware('loginCheck');


//admin panel course management
Route::get('/courses',[CoursesController::class, 'CoursesIndex'])->middleware('loginCheck');
Route::get('/Coursesget',[CoursesController::class, 'getCoursesData'])->middleware('loginCheck');
Route::post('/Coursesdelete',[CoursesController::class, 'CoursesDelete'])->middleware('loginCheck');
Route::post('/Coursesdetails',[CoursesController::class, 'getCoursesDetails'])->middleware('loginCheck');
Route::post('/Coursesupdate',[CoursesController::class, 'CoursesUpdata'])->middleware('loginCheck');
Route::post('/Coursesadd',[CoursesController::class, 'CoursesAdd'])->middleware('loginCheck');

//admin panel project management
Route::get('/Project',[ProjectController::class, 'ProjectIndex'])->middleware('loginCheck');
 Route::get('/getProjectData', [ProjectController::class, 'getProjectData'])->middleware('loginCheck');
 Route::post('/ProjectDetails', [ProjectController::class, 'getProjectDetails'])->middleware('loginCheck');
 Route::post('/ProjectUpdate', [ProjectController::class, 'ProjectUpdate'])->middleware('loginCheck');
 Route::post('/ProjectDelete', [ProjectController::class, 'ProjectDelete'])->middleware('loginCheck');
Route::post('/ProjectAdd', [ProjectController::class, 'ProjectAdd'])->middleware('loginCheck');

// Admin Panel Projects Management 
Route::get('/Contact', [ContactController::class, 'ContactIndex'])->middleware('loginCheck');
Route::get('/getContactData', [ContactController::class, 'getContactData'])->middleware('loginCheck');
Route::post('/ContactDelete', [ContactController::class, 'ContactDelete'])->middleware('loginCheck');


//admin panel service management
Route::get('/Review', [ReviewController::class, 'ReviewIndex'])->middleware('loginCheck');
Route::get('/getReviewData',[ReviewController::class, 'getReviewData'])->middleware('loginCheck');
Route::post('/ReviewDetails',[ReviewController::class, 'getReviewDetails'])->middleware('loginCheck');
Route::post('/ReviewUpdate',[ReviewController::class, 'ReviewUpdate'])->middleware('loginCheck');
Route::post('/ReviewDelete', [ReviewController::class, 'ReviewDelete'])->middleware('loginCheck');
Route::post('/ReviewAdd', [ReviewController::class, 'ReviewAdd'])->middleware('loginCheck');


//admin panel Login management

Route::get('/Login', [LoginController::class, 'LoginIndex']);
Route::post('/onLogin', [LoginController::class, 'onLogin']);
Route::get('/Logout', [LoginController::class, 'onLogout']);

//admin photo gallery
Route::get('/photo', [PhotoController::class, 'PhotoIndex']);




