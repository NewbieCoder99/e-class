<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComingSoon;

class ComingSoonController extends Controller
{
    public function show()
    {
    	$comingsoon = ComingSoon::first();
		return view('admin.coming_soon.edit',compact('comingsoon'));
    }

    public function update(Request $request)
    {
    	$items = ComingSoon::first();

        $input = $request->all();

        if(isset($items))
        {
            if ($file = $request->file('bg_image'))
            {
                $image_file = @file_get_contents(public_path().'/images/comingsoon/'.$items->bg_image);

                if($image_file)
                {
                    unlink('images/comingsoon/'.$items->bg_image);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/comingsoon', $name);
                $input['bg_image'] = $name;
            }

            $items->update($input);
        }
        else
        {
            if ($file = $request->file('bg_image'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/comingsoon', $name);
                $input['bg_image'] = $name;
            }
            
            $data = ComingSoon::create($input);
          
            $data->save();
        }

        return back()->with('message','Updated Successfully');
    }

    public function comingsoonpage()
    {
        $data = ComingSoon::first();
        return view('front.coming_soon.show',compact('data'));
    }
}
