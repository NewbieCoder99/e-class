<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GetStarted;
use Image;
use DB;

class GetstartedController extends Controller
{

    public function show()
    {
      $show = GetStarted::first();
      return view('admin.get_started.edit',compact('show'));
    }

    public function update(Request $request)
    {

        $getstarted = GetStarted::first();

        $input = $request->all();

        if(isset($getstarted))
        {

          if ($file = $request->file('image')) 
          {
            if($getstarted->image != "")
            {
              $image_file = @file_get_contents(public_path().'/images/getstarted/'.$getstarted->image);

              if($image_file)
              {
                  unlink('images/getstarted/'.$getstarted->image);
              }
            }  
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/getstarted/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);

            $input['image'] = $image;
                         
          }

          $getstarted->update($input);

        }

        else
        {

          if ($file = $request->file('image')) 
          { 
                 
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/getstarted/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);

            $input['image'] = $image;
                         
          }

          $data = GetStarted::create($input);
          
          $data->save();

        }

        return back()->with('message','Updated Successfully');
    }

}
