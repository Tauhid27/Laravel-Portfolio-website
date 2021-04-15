<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;
use App\Http\Controllers\VisitorController;


Route::get('/',[HomeControll::class, 'HomeIndex']);
Route::get('/visitor',[VisitorController::class, 'VisitorIndex']);