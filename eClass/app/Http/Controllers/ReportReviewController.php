<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportReview;
use DB;
use Auth;
use Session;

class ReportReviewController extends Controller
{

    public function store(Request $request, $id)
    {
       
    	DB::table('report_reviews')->insert(
            array(
                'course_id'  => $id,
                'user_id'    => Auth::User()->id,
                'review_id'  => $request->review_id,
                'title'      => $request->title,
                'email'      => $request->email,
                'detail'     => $request->detail,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            )
        );
        Session::flash('success', 'Report successfully');
        return back();
    }
    public function show($id)
    {
        $show = ReportReview::where('id', $id)->first();
        return view('admin.course.reviewreport.edit',compact('show'));
    }

    public function edit($id)
    {
    	
    }


    public function update(Request $request, $id)
    {
    	$data = ReportReview::findorfail($id);
    	$input = $request->all();
    	$data ->update($input);
    	return redirect()->route('course.show',$request->course);
    }

    public function destroy($id)
    {
        DB::table('report_reviews')->where('id',$id)->delete();
        return redirect()->route('reports.index');
    }
}
