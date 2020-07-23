<?php

namespace App\Http\Controllers;

use App\ReviewRating;
use Illuminate\Http\Request;
use App\User; 
use App\Course;
use DB;
use Auth;
use App\Order;

class ReviewratingController extends Controller
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
        DB::table('review_ratings')->insert(
        array(
            'course_id' => $request->course,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'status' => $request->status,
            'approved' => $request->approved,
            'featured' => $request->featured,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            )
        );
        return redirect()->route('course.show',$request->course);
    }   
 

    /**
     * Display the specified resource.
     *
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $jp = ReviewRating::find($id);
        $users = User::all();
        $courses = Course::all();
        return view('admin.course.reviewrating.edit',compact('jp','courses','users'));
   
    }
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function edit(reviewrating $reviewrating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $data = ReviewRating::findorfail($id);
        $input = $request->all();
        $data ->update($input);
       
        return redirect()->route('course.show',$request->course);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reviewrating  $reviewrating
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('review_ratings')->where('id',$id)->delete();
        return back();
    }


    public function rating(Request $request,$id)
    {

        $orders = Order::where('user_id', Auth::User()->id)->where('course_id', $id)->first();
        $review = ReviewRating::where('user_id', Auth::User()->id)->where('course_id', $id)->first();

        if(!empty($orders)){
            if(!empty($review))
            {
                return back()->with('delete','You already reviewed this course');
            }
            else{

                $input = $request->all();
                $input['course_id'] = $id;
                $input['user_id'] = Auth::User()->id;
                $data = ReviewRating::create($input);
                $data->save();

                return back()->with('success','Review Successfully');
            }
            return back()->with('success','Review Successfully');
        }
        else{
            return back()->with('delete','Purchase to review this course');

        }
        
    }

    
}
