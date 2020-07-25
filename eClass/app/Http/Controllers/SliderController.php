<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Image;
use Auth;
use Session;

class SliderController extends Controller
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
        $sliders = Slider::orderBy('position','ASC')->get();
        return view("admin.slider.index",compact("sliders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.slider.insert');
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
            'heading' => 'required',
            'sub_heading' => 'required',
            'search_text' => 'required',
            'detail' => 'required',
            'image'=>'required',
        ]);


        $input = $request->all();

        if($file = $request->file('image')) 
        {        
          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/slider/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $input['image'] = $image;
          
        }


        $input['position'] = (Slider::count()+1);

        $data = Slider::create($input);

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }
        
        $data->save();

        Session::flash('success','Added Successfully !');
        return redirect('slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate = Slider::find($id);
        return view('admin.slider.update',compact('cate'));
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)
    {

        $slider = Slider::findorfail($id);

        $input = $request->all();

        if($file = $request->file('image'))
        {
            if($slider->image != null) {
                $content = @file_get_contents(public_path().'/images/slider/'.$slider->image);
                if ($content) {
                  unlink(public_path().'/images/slider/'.$slider->image);
                }
            }

            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/slider/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);

            $input['image'] = $image;
        }

        if(isset($request->status))
        {
            $input['status'] = '1';
        }
        else
        {
            $input['status'] = '0';
        }

        $slider->update($input);

        Session::flash('success','Updated Successfully !');
        return redirect('slider'); 
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $cate = Slider::find($id);

        if ($cate->image != null)
        {
                
            $image_file = @file_get_contents(public_path().'/images/slider/'.$cate->image);

            if($image_file)
            {
                unlink(public_path().'/images/slider/'.$cate->image);
            }
        }
        
        $value = $cate->delete();

        if($value)
        {
            session()->flash("delete","Slider has been deleted");
            return redirect("slider");
        }

    }

    public function reposition(Request $request)
    {

        $data= $request->all();
        
        $posts = Slider::all();
        $pos = $data['id'];
       
        $position =json_encode($data);
     
        foreach($posts as $key => $item) {
            
            Slider::where('id', $item->id)->update(array('position' => $pos[$key]));
        }

        return response()->json(['msg'=>'Updated Successfully', 'success'=>true]);


    }
}
