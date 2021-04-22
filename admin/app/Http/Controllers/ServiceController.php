<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesModel;

class ServiceController extends Controller
{
    function ServiceIndex(){

      
        
        return view('Services');
    }

    function getServicesData(){
     $result=  json_encode(ServicesModel::get());
     return $result;
    }
}
