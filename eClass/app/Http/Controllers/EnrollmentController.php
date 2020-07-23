<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Course;

class EnrollmentController extends Controller
{

    public function enroll(Request $request,$id)
    {
        $course = Course::where('id', $id)->first();

        DB::table('orders')->insert(
            array(
                'user_id' => Auth::User()->id,
                'instructor_id' => $course->user_id,
                'course_id' => $id,
                'total_amount' => 'Free',
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
            )
        );

        return back()->with('success','You Are Enrolled Successfully !');
    }
}
   