<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ContactController;




Route::get('/', [HomeControll::class, 'HomeIndex']);
Route::post('/contactSend', [HomeControll::class, 'ContactSend']);

Route::get('/Courses', [CoursesController::class, 'CoursePage']);
Route::get('/Projects', [ProjectsController::class, 'ProjectsPage']);
Route::get('/Policy', [PolicyController::class, 'PolicyPage']);
Route::get('/Terms', [TermsController::class, 'TermsPage']);
Route::get('/Contact', [ContactController::class, 'ContactPage']);
