<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeText;
use DB;
use Session;

class HomeTextController extends Controller
{
    public function index()
    {
    	$items = HomeText::all();
    	return view('admin.home_text.index',compact('items'));
    }

    public function create()
    {
    	$show = HomeText::all();
    	return view('admin.home_text.create',compact('show'));
    }
    
    public function store(Request $request)
    {

    	$data = $this->validate($request,[
            'heading' => 'required',
            'sub_heading' => 'required',
            'button_txt' => 'required',
        ]);

        $input = $request->all();
        $data = HomeText::create($input);
        $data->save();

        Session::flash('success','Added Successfully !');
        return redirect()->route('hometext.index');
    }

    public function show()
    {

    }

    public function edit($id)
    {
    	$show = HomeText::where('id', $id)->first();
    	return view('admin.home_text.edit',compact('show'));
    }

    public function update(Request $request, $id)
    {

        $data = $this->validate($request,[
            'heading' => 'required',
            'sub_heading' => 'required',
            'button_txt' => 'required',
        ]);
        
    	$data = HomeText::findorfail($id);
        $input = $request->all();
        $data->update($input);

        Session::flash('success','Updated Successfully !');
		return redirect()->route('hometext.index');
    }

    public function destroy($id)
    {
    	DB::table('home_texts')->where('id',$id)->delete();
        return redirect()->route('hometext.index');
    }
}
