<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\User;
use Image;
use DB;
use Auth;

class BlogController extends Controller
{
    public function index()
    {
        if(Auth::User()->role == "admin"){
    	   $items = Blog::all();
        }
        else{
           $items = Blog::where('user_id', Auth::User()->id)->get(); 
        }

    	return view('admin.blog.index',compact('items'));
    }

    public function create()
    {
    	$show = Blog::all();
    	return view('admin.blog.create',compact('show'));
    }

    public function store(Request $request)
    {
    	  $data = $this->validate($request,[
    		    'date' => 'required',
            'image'=>'required',
            'heading' => 'required|min:5',
            'text' => 'required',
            'detail' => 'required|min:200',
        ]);


        $input = $request->all();
        if ($file = $request->file('image')) 
         {            
          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/blog/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);
          $input['image'] = $image;         
          
        }

        $data = Blog::create($input); 

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }

        if(isset($request->approved))
        {
            $data->approved = '1';
        }
        else
        {
            $data->approved = '0';
        }

        $data->save();

        return redirect()->route('blog.index');
    }

    public function show()
    {

    }

    public function edit($id)
    {
      $show = Blog::where('id', $id)->first();
      return view('admin.blog.edit',compact('show'));
    }

    public function update(Request $request, $id)
    {

        $blog = Blog::findOrFail($id);

        $input = $request->all();

        if ($file = $request->file('image')) 
        { 
          if($blog->image != "")
          {
            $image_file = @file_get_contents(public_path().'/images/blog/'.$blog->image);

            if($image_file)
            {
                unlink(public_path().'/images/blog/'.$blog->image);
            }
          }       
          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/blog/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $input['image'] = $image;
                       
        }

        if(isset($request->approved))
        {
            $input['approved'] = '1';
        }
        else
        {
            $input['approved'] = '0';
        }

        if(isset($request->status))
        {
            $input['status'] = '1';
        }
        else
        {
            $input['status'] = '0';
        }

        $blog->update($input);

        return redirect()->route('blog.index');
    }

    public function destroy($id)
    {

        $blog = Blog::find($id);
        if ($blog->image != null)
        {
                
            $image_file = @file_get_contents(public_path().'/images/blog/'.$blog->image);

            if($image_file)
            {
                unlink(public_path().'/images/blog/'.$blog->image);
            }
        }

        $value = $blog->delete();

        if($value)
        {
            return redirect()->route('blog.index');
        }
    }

    public function blogpage()
    {
      $blogs = Blog::orderby('id','desc')->paginate(5);
      return view('front.blog.blog',compact('blogs'));
    }

    public function blogdetailpage($id)
    {
      $blog = Blog::findorfail($id);
      return view('front.blog.blog_detail',compact('blog'));
    }
}
