<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\User; 
use App\Course;
use DB;
use Auth;
use Session;

class QuestionanswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::all();
        return view('admin.questionanswer.index',compact("course")); 
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
            'question' => 'required',
        ]);

        $input = $request->all();
        $data = Question::create($input);
        $data->save(); 

        Session::flash('success','Added Successfully !');
        return redirect()->route('course.show',$request->course_id);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\questionanswer  $questionanswer
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\questionanswer  $questionanswer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $que = Question::find($id);
        $user =  User::all();
        $courses = Course::all();
        return view('admin.course.questionanswer.edit',compact('que','courses','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\questionanswer  $questionanswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $this->validate($request,[
            'question' => 'required',
        ]);
        
        $data = Question::findorfail($id);
        $input = $request->all();
        $data->update($input);

        Session::flash('success','Updated Successfully !');
        return redirect()->route('course.show',$request->course_id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\questionanswer  $questionanswer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('questions')->where('id',$id)->delete();
        DB::table('answers')->where('question_id',$id)->delete();
        return back();
    }

    public function question(Request $request, $id)
    {
        $data = $this->validate($request,[
            'question' => 'required',
        ]);

        $input = $request->all();
        $data = Question::create($input);
        $data->save();        

        return back()->with('success','Posted Successfully');
    }
}
