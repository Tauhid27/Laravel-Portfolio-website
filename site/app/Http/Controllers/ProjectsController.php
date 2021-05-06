<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projectsModel;

class ProjectsController extends Controller
{
    function ProjectsPage(){
        $ProjectData = json_decode(projectsModel::orderBy('id','desc')->get());
        return view('Projects',['ProjectData'=>$ProjectData]);
    }

}
