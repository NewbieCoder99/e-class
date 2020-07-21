<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseLanguage;
use DB;
use Session;

class CourseLanguageController extends Controller
{
    public function index()
    {
        $language = CourseLanguage::all();
        return view('admin.course_language.index',compact("language"));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $data = $this->validate($request,[
            'name' => 'required',
            'status' => 'required',
        ]);


        $input = $request->all();
        $data = CourseLanguage::create($input);

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }

        $data->save();

        Session::flash('success','Course Language Added Successfully !');
        return redirect('courselang');
    }
    
    public function show(language $language)
    {
        
    }

   
    public function edit($id)
    {
        $language = CourseLanguage::where('id',$id)->first();
        return view('admin.course_language.edit',compact("language"));
    }

   
    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'name' => 'required',
            'status' => 'required',
        ]);
        
        $data = CourseLanguage::findorfail($id);
        $input = $request->all();
        $data->update($input);

        return redirect('courselang');
    }

   
    public function destroy( $id)
    {
        DB::table('course_languages')->where('id',$id)->delete();
        return back();
    
    }
}
