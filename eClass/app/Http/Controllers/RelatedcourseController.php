<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\RelatedCourse;
use App\Course;
use Session;

class RelatedcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $related = RelatedCourse::all();
        return view('admin.course.relatedcourse.index',compact("related"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relatedcourse = Course::all();
        return view('admin.course.relatedcourse.insert',compact('relatedcourse')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        
        $related = RelatedCourse::where('main_course_id', $request->main_course_id )->where('course_id', $request->course_id )->first();

        if(!empty($related)){

            return back()->with('delete','course is already exits');
            
        }
        else{
            DB::table('related_courses')->insert(
            array(

                'course_id' => $request->course_id,
                'main_course_id' => $request->main_course_id,
                'user_id' => $request->user_id,
                'status' => $request ->status,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                )
            );
            return back()->with('success','Related Course is Added');  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\relatedcourse  $relatedcourse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate = RelatedCourse::find($id);
        
        $courses = Course::all();
        return view('admin.course.relatedcourse.edit',compact('cate','courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\relatedcourse  $relatedcourse
     * @return \Illuminate\Http\Response
     */
    public function edit(relatedcourse $relatedcourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\relatedcourse  $relatedcourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        DB::table('related_courses')->where('id',$id)
            ->update([

            'course_id' => $request->course_id,
            'main_course_id' => $request->main_course_id,
            'user_id' => $request->user_id,
            'status' => $request ->status,
            'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),

        ]);

        Session::flash('success','Updated Successfully !');
        

        return redirect()->route('course.show',$request->main_course_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\relatedcourse  $relatedcourse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::table('related_courses')->where('id',$id)->delete();
     
        return back();
    }
}
