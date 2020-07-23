<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Auth;
use App\Course;
use App\Question;
use Session;
use App\User;

class InstructorAnswerController extends Controller
{
    public function index()
    {
    	$answers = Answer::where('instructor_id', Auth::User()->id)->get();
    	return view('instructor.answer.index',compact('answers'));
    }

    public function create()
    {
    	$course = Course::where('user_id', Auth::User()->id)->get();
        $questions = Question::where('user_id', Auth::User()->id)->get();
        return view('instructor.answer.add',compact('course', 'questions'));
    }

    public function store(Request $request)
    {
    	$data = $this->validate($request,[
            'course_id' => 'required',
            'answer' => 'required',
        ]);

        $input = $request->all();
        $data = Answer::create($input);
        $data->save(); 

        Session::flash('success','Added Successfully !');
        return redirect('instructoranswer');

    }

    public function show($id)
    {
        $answer = Answer::find($id);
        $user =  User::all();
        $courses = Course::all();
        return view('instructor.answer.edit',compact('answer','courses','user'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'answer' => 'required',
        ]);
        
        $data = Answer::findorfail($id);
        $input = $request->all();
        $data->update($input);

        Session::flash('success','Updated Successfully !');
        return redirect('instructoranswer');

    }

    public function destroy($id)
    {
        Answer::where('id',$id)->delete();
        return back();
    }

}
