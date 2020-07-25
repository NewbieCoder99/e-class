<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\CourseChapter;

class InstructorController extends Controller
{

    public function index()
    {   
        if(Auth::User()->role == "instructor")
        {
            return view('instructor.dashboard');
        }
        else
        {
            return "You're Not a Instructor !";
        }
    }


	
}
