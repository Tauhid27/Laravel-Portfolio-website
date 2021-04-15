<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControll extends Controller
{
    function HomeIndex(){

        return view('home');
    }
}
