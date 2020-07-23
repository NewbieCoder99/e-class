<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use App\User; 
use App\Course;
use DB;
use Session;

class AnnounsmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'announsment' => 'required',
        ]);

        $input = $request->all();
        $data = Announcement::create($input);

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
     * @param  \App\announsment  $announsment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $annou = Announcement::find($id);
        $user =  User::all();
        $courses = Course::all();
        return view('admin.course.announsment.edit',compact('annou','courses','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\announsment  $announsment
     * @return \Illuminate\Http\Response
     */
    public function edit(announsment $announsment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\announsment  $announsment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Announcement::findorfail($id);
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
     * @param  \App\announsment  $announsment
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        DB::table('announcements')->where('id',$id)->delete();
        return back();
    }
}
