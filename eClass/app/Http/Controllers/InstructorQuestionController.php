<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
use App\Course;
use Session;
use App\User;
use App\Answer;

class InstructorQuestionController extends Controller
{
    public function index()
    {
    	$questions = Question::where('instructor_id', Auth::User()->id)->get();
    	return view('instructor.question.index',compact('questions' ));
    }

    public function create()
    {
    	$course = Course::where('user_id', Auth::User()->id)->get();
        return view('instructor.question.add',compact("course"));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'course_id' => 'required',
            'question' => 'required',
        ]);

        $input = $request->all();
        $data = Question::create($input);
        $data->save(); 

        Session::flash('success','Added Successfully !');
        return redirect('instructorquestion');
    }

    public function show($id)
    {
        $que = Question::find($id);
        $user =  User::all();
        $courses = Course::all();
        return view('instructor.question.edit',compact('que','courses','user'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'question' => 'required',
        ]);
        
        $data = Question::findorfail($id);
        $input = $request->all();
        $data->update($input);

        Session::flash('success','Updated Successfully !');
        return redirect('instructorquestion');

    }

    public function destroy($id)
    {
        Question::where('id',$id)->delete();
        Answer::where('question_id',$id)->delete();
        return back();
    }
}
