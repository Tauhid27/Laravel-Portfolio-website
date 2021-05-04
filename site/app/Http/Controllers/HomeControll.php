<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\projectsModel;

class HomeControll extends Controller
{
    function HomeIndex()
    {

        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address' => $UserIP, 'visit_time' => $timeDate]);

        $ServicesData = json_decode(ServicesModel::limit(4)->get());
        $courseData = json_decode(CourseModel::orderBy('id', 'desc')->limit(6)->get());
        $ProjectData = json_decode(projectsModel::orderBy('id','desc')->limit(10)->get());
        return view(
            'home',
            [
                'ServicesData' => $ServicesData,
                'courseData' => $courseData,
                'ProjectData' =>$ProjectData
            ]
        );
    }
}
