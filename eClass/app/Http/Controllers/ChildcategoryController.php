<?php

namespace App\Http\Controllers;

use App\ChildCategory;
use Illuminate\Http\Request;
use DB;
use App\SubCategory;
use App\Categories;
use Auth;
use Session;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childcategory = ChildCategory::all();
        return view('admin.category.childcategory.index',compact("childcategory"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Categories::all();
        $childcategory = SubCategory::all();
        return view('admin.category.childcategory.insert',compact('category','childcategory')); 
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
            "title"=>"required|unique:child_categories,title",
            "title.required"=>"Please enter category title !",
            "title.unique" => "This Category name is already exist !"
        ]);

        $input = $request->all();
        $input['subcategory_id'] = $request->subcategories;

        $slug = str_slug($input['title'],'-');
        $input['slug'] = $slug;



        $data = ChildCategory::create($input);

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }

        $data->save();

        return redirect ('childcategory');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate = ChildCategory::find($id);
        return view('admin.category.childcategory.edit',compact('cate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(childcategory $childcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $this->validate($request,[
            "title"=>"required|unique:child_categories,title",
            "title.required"=>"Please enter category title !",
            "title.unique" => "This Category name is already exist !"
        ]);

        $data = ChildCategory::findorfail($id);
        $input = $request->all();

        
        $slug = str_slug($input['title'],'-');
        $input['slug'] = $slug;

        if(isset($request->status))
        {
            $input['status'] = '1';
        }
        else
        {
            $input['status'] = '0';
        }

        
        $data->update($input);
        Session::flash('success','Updated Successfully !');


        return redirect ('childcategory');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\childcategory  $childcategory
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if(Auth::User()->role == "admin"){
            DB::table('child_categories')->where('id',$id)->delete();
        }
     
        return redirect('childcategory');
    }
}
