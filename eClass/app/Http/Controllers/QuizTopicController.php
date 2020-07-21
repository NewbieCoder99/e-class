<?php

namespace App\Http\Controllers;

use App\QuizTopic;
use Illuminate\Http\Request;
use App\Quiz;
use App\QuizAnswer;

class QuizTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = QuizTopic::all();
        return view('admin.course.quiztopic.index',compact('topics'));
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

         $input = $request->all();
        $request->validate([
          'title' => 'required|string',
          'per_q_mark' => 'required',
          
          
        ]);

        if(isset($request->quiz_price)){
          $request->validate([
            'amount' => 'required'
          ]);
        }

        if(isset($request->quiz_price)){
          $input['amount'] = $request->amount;
        }else{
          $input['amount'] = null;
        }

        if(isset($request->show_ans)){
          $input['show_ans'] = "1";
        }else{
          $input['show_ans'] = "0";
        }

        if(isset($request->status)){
          $input['status'] = "1";
        }else{
          $input['status'] = "0";
        }

        if(isset($request->quiz_again)){
          $input['quiz_again'] = "1";
        }else{
          $input['quiz_again'] = "0";
        }

       
        $quiz = QuizTopic::create($input);
           
      
        return back()->with('added', 'Topic has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizTopic  $quizTopic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = QuizTopic::where('id', $id)->first();
        return view('admin.course.quiztopic.edit',compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizTopic  $quizTopic
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizTopic $quizTopic)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuizTopic  $quizTopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // return $request;
        $request->validate([

          'title' => 'required|string',
          'per_q_mark' => 'required'
          
        ]);

        if(isset($request->pricechk)){
          $request->validate([
            'amount' => 'required'
          ]);
        }

          $topic = QuizTopic::findOrFail($id);
          
          $topic->title = $request->title;
          $topic->description = $request->description;
          $topic->per_q_mark = $request->per_q_mark;
          $topic->timer = $request->timer;
          $topic->due_days = $request->due_days;

          // if(isset($request->show_ans)){
          //   $topic->show_ans = 1;
          // }else{
          //   $topic->show_ans = 0;
            
          // }

          // if(isset($request->pricechk)){
          //   $topic->amount = $request->amount;
          // }else{
          //   $topic->amount = NULL;
          // }

          if(isset($request->status)){
            $topic['status'] = "1";
          }else{
            $topic['status'] = "0";
          }

          if(isset($request->quiz_again)){
            $topic['quiz_again'] = "1";
          }else{
            $topic['quiz_again'] = "0";
          }
         

          $topic->save();


          return redirect()->route('course.show',$topic->course_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuizTopic  $quizTopic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = QuizTopic::findOrFail($id);

        $topic->delete();

        Quiz::where('topic_id', $id)->delete();
        QuizAnswer::where('topic_id', $id)->delete();
        
        return back()->with('deleted', 'Question has been deleted');
    }

    public function delete($id)
    {
        $topic = QuizTopic::where('id', $id)->first();
        $answer = QuizAnswer::where('topic_id', $id)->get();

        if($answer != NULL)
        {
          QuizAnswer::where('topic_id', $id)->delete();
        }
        return redirect()->route('course.show',$topic->course_id);
    }
}
