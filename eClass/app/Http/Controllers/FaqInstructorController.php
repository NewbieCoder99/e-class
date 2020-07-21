<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaqInstructor;
use DB;

class FaqInstructorController extends Controller
{
    public function index()
    {
    	$faq = FaqInstructor::all();
        return view('admin.faq_instructor.index',compact('faq'));
    }

    public function create()
    {
    	return view('admin.faq_instructor.create');
    }

    public function store(Request $request)
    {
    	$data = $this->validate($request,[
            'title'=>'required',
            'details'=>'required',
            'status'=>'required',
        ]);

        
        $input = $request->all();
        $data = FaqInstructor::create($input);

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }

        $data->save();

        return redirect('faqinstructor');

    }

    public function show()
    {

    }

    public function edit($id)
    {
    	$find= FaqInstructor::find($id);
        return view('admin.faq_instructor.update', compact('find'));
    }

    public function update(Request $request, $id)
    {
    	$data = FaqInstructor::findorfail($id);
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
        
        return redirect('faqinstructor');
    }

    public function destroy($id)
    {
    	DB::table('faq_instructors')->where('id',$id)->delete();
        return redirect('faqinstructor');
    }


}
