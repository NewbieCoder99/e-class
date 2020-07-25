<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Course;
use Auth;
use Session;

class InstructorAnnouncementController extends Controller
{
    public function index()
    {
    	$announs = Announcement::where('user_id', Auth::User()->id)->get();
    	return view('instructor.announcement.index', compact('announs'));
    }

    public function create()
    {
    	$course = Course::where('user_id', Auth::User()->id)->get();
    	return view('instructor.announcement.create', compact('course'));
    }

    public function store(Request $request)
    {
       $data = $this->validate($request,[
            'course_id' => 'required',
            'announsment' => 'required',
        ]);

        $input = $request->all();
        $data = Announcement::create($input);
        $data->save(); 

        Session::flash('success','Added Successfully !');
        return redirect('instructor/announcement'); 
    }

    public function show($id)
    {
        $course = Course::where('user_id', Auth::User()->id)->get();
        $announs = Announcement::find($id);
        return view('instructor.announcement.edit', compact('course', 'announs'));

    }

    public function edit()
    {
        
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'announsment' => 'required',
        ]);
        
        $data = Announcement::findorfail($id);
        $input = $request->all();
        $data->update($input);

        Session::flash('success','Updated Successfully !');
        return redirect('instructor/announcement');

    }

    public function destroy($id)
    {
        Announcement::where('id',$id)->delete();
        return back();
    }

}
