<?php

namespace App\Http\Controllers;

use App\CourseInclude;
use Illuminate\Http\Request;
use DB;
use App\Course;
use Session;
use Image;

class CourseincludeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $courseinclude = CourseInclude::all();
        return view('admin.course.courseinclude.index',compact("courseinclude"));
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseinclude = Course::all();
        return view('admin.course.courseinclude.insert',compact('courseinclude'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        $data = $this->validate($request,[
            'detail' => 'required|max:50',
        ]);

        $input = $request->all();
        $data = CourseInclude::create($input);

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }

        $data->save();

        Session::flash('success','Added Successfully !');
        return redirect()->route('course.show',$request->course_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\courseinclude  $courseinclude
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate = CourseInclude::find($id);
        $courses = Course::all();
        return view('admin.course.courseinclude.edit',compact('cate','courses'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\courseinclude  $courseinclude
     * @return \Illuminate\Http\Response
     */
    public function edit(courseinclude $courseinclude)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\courseinclude  $courseinclude
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $this->validate($request,[
            'detail' => 'required|max:50',
        ]);

        $data = CourseInclude::findorfail($id);
        $input = $request->all();

        if(isset($request->status))
        {
            $input['status'] = '1';
        }
        else
        {
            $input['status'] = '0';
        }

        $data->update($input);

        Session::flash('success','Updated Successfully !'); 
        return redirect()->route('course.show',$request->course_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courseinclude  $courseinclude
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
         
      DB::table('course_includes')->where('id',$id)->delete();
      return back(); 
    }

}
