<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\CourseClass;
use App\CourseChapter;
use App\Course;
use Auth;
use Crypt;
use Redirect;
use App\BundleCourse;

class WatchController extends Controller
{
    public function watch($id)
    {
        if(Auth::check())
        {
        	$order = Order::where('user_id', Auth::User()->id)->where('course_id', $id)->first();

            $courses = Course::where('id', $id)->first();

            $bundle = Order::where('user_id', Auth::User()->id)->where('bundle_id', '!=', NULL)->get();

            $course_id = array();

            foreach($bundle as $b)
            {
               $bundle = BundleCourse::where('id', $b->bundle_id)->first();
                array_push($course_id, $bundle->course_id);
            }

            $course_id = array_values(array_filter($course_id));

            $course_id = array_flatten($course_id);
        

            if(Auth::User()->role == "admin")
            {
            	return view('watch',compact('courses'));
            }
            else
            {
                if(!empty($class))
                {
                    return view('watch',compact('courses'));
                }
                elseif(isset($course_id) && in_array($id, $course_id))
                {
                    return view('watch',compact('courses'));
                }
                else
                {
                    return back()->with('delete', '401 Unauthorized Action !');
                }
                
            }
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');

    }


    public function watchclass($id)
    {
        $class = CourseClass::where('id',$id)->first();

        if(Auth::check())
        {
            if(!empty($class))
            {
                return view('classwatch',compact('class'));
            }
            else
            {
                return back()->with('delete', '401 Unauthorized Action !');
            }
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');
    }

    public function view($url, $course_id)
    {
        $course = $course_id;
        $url = Crypt::decrypt($url);
        return view('iframe',compact('url', 'course'));
    }

    public function lightbox($id)
    {
        $class = CourseClass::where('id',$id)->first();
        
        return view('lightbox',compact('class'));
    }


    public function audioclass($id)
    {
        // return $id;
        $class = CourseClass::where('id',$id)->first();

        if(Auth::check())
        {
            if(!empty($class))
            {
                return view('audioclass',compact('class'));
            }
            else
            {
                return back()->with('delete', '401 Unauthorized Action !');
            }
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');
    }

   
}
