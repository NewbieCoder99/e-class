<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerSetting;
use Image;

class PlayerSettingController extends Controller
{
    public function get()
    {
    	$ps = PlayerSetting::first();
    	return view('admin.playersetting.edit',compact('ps'));
    }

    public function update(Request $request)
    {
      
      $request->validate([
          'logo' => 'mimes:png'
      ]);

      $ps = PlayerSetting::first();

      $input = $request->all();

        if(isset($ps))
        {
            $ps->cpy_text = $request->cpy_text;
      

            if(isset($request->logo_enable))
              {
                $ps->logo_enable = 1;
              }
              else
              {
                $ps->logo_enable = 0;
              }

              if(isset($request->share_enable))
              {
                $ps->share_enable = 1;
              }
              else
              {
                $ps->share_enable = 0;
              }
              

              if(isset($request->autoplay))
              {
                $ps->autoplay = 1;
              }
              else
              {
                $ps->autoplay = 0;
              }

              if(isset($request->download))
              {
                $ps->download = 1;
              }
              else
              {
                $ps->download = 0;
              }


            if(isset($request->logo_enable))
            {
              if ($file = $request->file('logo'))
                {

                  $name = 'logo.png';

                  if($ps->logo !="")
                   {
                    unlink('content/minimal_skin_dark/'.$ps->logo);
                   }

                  $file->move('content/minimal_skin_dark', $name);
                  
                  $ps->logo = $name;
            

                }
            }
            $ps->save();
        }
        else
        {
            if(isset($request->logo_enable))
            {
              if ($file = $request->file('logo'))
                {

                  $name = 'logo.png';

                  $optimizeImage = Image::make($file);
                  $optimizePath = public_path().'/content/minimal_skin_dark/';
                  $image = time().$file->getClientOriginalName();
                  $optimizeImage->save($optimizePath.$image, 72);
                  $input['logo'] = $name;

                }
            }

            $ps = PlayerSetting::create($input);
          
            $ps->save();
        }
    	
    	 return back()->with('success','Player Settings Updated !');
    }
}
