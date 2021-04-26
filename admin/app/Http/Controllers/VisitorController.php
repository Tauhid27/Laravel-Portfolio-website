<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function VisitorIndex(){

        $VisitorData = json_decode(VisitorModel::orderBy('id','desc')->get());
        
        return view('Visitor',['VisitorData'=>$VisitorData]);
    }
}
