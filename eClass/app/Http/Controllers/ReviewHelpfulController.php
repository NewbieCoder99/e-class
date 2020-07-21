<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\ReviewHelpful;

class ReviewHelpfulController extends Controller
{
    public function store(Request $request, $id)
    {
    	$help = ReviewHelpful::where('review_id', $request->review_id)->first();

        if($help == NULL)
        {
            
        	DB::table('review_helpfuls')->insert(
                array(
                    'course_id'=>$id,
                    'user_id'=>Auth::User()->id,
                    'review_id'=>$request->review_id,
                    'helpful'=>$request->helpful,
                )
            );
            
        }

        return back();
    }



    public function destroy($id)
    {
        DB::table('review_helpfuls')->where('course_id',$id)->delete();
        return back();
    }
}
