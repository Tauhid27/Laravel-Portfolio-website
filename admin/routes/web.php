<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;


Route::get('/',[HomeControll::class, 'HomeIndex']);
Route::get('/visitor',[VisitorController::class, 'VisitorIndex']);

Route::get('/services',[ServiceController::class, 'ServiceIndex']);
Route::get('/serviceget',[ServiceController::class, 'getServicesData']);
Route::post('/servicedelete',[ServiceController::class, 'ServiceDelete']);
Route::post('/servicedetails',[ServiceController::class, 'getServicesDetails']);
Route::post('/serviceupdate',[ServiceController::class, 'ServiceUpdata']);
