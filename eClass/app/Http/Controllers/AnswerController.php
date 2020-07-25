<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Answer;
use App\Course;
use App\Question;
use Session;

class AnswerController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $course = Course::all();
        return view('admin.course.answer.add',compact('course'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'answer' => 'required',
            'question_id' => 'required'
        ]);

        $input = $request->all();
        $data = Answer::create($input);
        $data->save(); 

        Session::flash('success','Added Successfully !');
        return redirect()->route('course.show',$request->course_id);
    }

    public function edit($id)
    {
        $show= Answer::find($id);
        return view('admin.course.answer.edit', compact('show'));
    }

    public function update(Request $request, $id)
    {
        
        $data = Answer::findorfail($id);
        $input = $request->all();
        $data->update($input);

        return redirect()->route('course.show',$request->course_id);
    }

    public function destroy($id)
    {
        DB::table('answers')->where('id',$id)->delete();
        return back()->with('delete','Answer Deleted !!');
    }

    public function answer(Request $request, $id)
    {
        $input = $request->all();
        $data = Answer::create($input);
        $data->save();
         
        Session::flash('success','Added Successfully !');
        return back();
    }
}
