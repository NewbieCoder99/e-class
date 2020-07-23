<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::all();
        return view('admin.pages.index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.page_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            'title'=>'required',
            'details'=>'required',
            'status'=>'required',
        ]);

        $input = $request->all();

        $slug = str_slug($input['title'],'-');
        $input['slug'] = $slug;
        $data = Page::create($input);
        $data->save();

        Session::flash('success','Added Successfully !');
        return redirect('page');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $find= Page::find($id);
        return view('admin.pages.page_edit', compact('find'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this -> validate($request,[
            'title'=>'required',
            'details'=>'required',
            'status'=>'required',
        ]);

        $data = Page::findorfail($id);
        $input = $request->all();

        $slug = str_slug($input['title'],'-');
        $input['slug'] = $slug;

        
        $data->update($input);
        Session::flash('success','Updated Successfully !');
        return redirect('page'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        
        DB::table('pages')->where('id',$id)->delete();
        return redirect('page');
    }


    public function showpage($slug)
    {
        $page = Page::where('slug', '=', $slug)->first();
        
        return view('page',compact('page'));
    }
}
