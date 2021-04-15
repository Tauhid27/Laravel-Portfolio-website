<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;




Route::get('/', [HomeControll::class, 'HomeIndex']);
