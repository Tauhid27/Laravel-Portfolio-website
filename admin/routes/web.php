<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;


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
Route::post('/Coursesdetails',[CoursesController::class, 'CoursesDetails']);
Route::post('/Coursesupdate',[CoursesController::class, 'CoursesUpdata']);
Route::post('/Coursesadd',[CoursesController::class, 'CoursesAdd']);