<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Auth;

class CourseReviewController extends Controller
{
    public function index()
    {
    	$course = Course::where('user_id', '!=' ,Auth::User()->id)->get();
        return view('admin.course_review.index',compact('course'));
    }
}
