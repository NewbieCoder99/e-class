<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    public function show()
    {
    	$data = About::first();
		return view('admin.about.edit',compact('data'));
    }

    public function update(Request $request)
    {
    	$about = About::first();

        $input = $request->all();

        if(isset($about))
        {
            // return $request;
            if($request->one_enable == 'on')
            {
                $input['one_enable'] = '1';
            }
            else
            {
                $input['one_enable'] = '0';
            }

            if($request->two_enable == 'on')
            {
                $input['two_enable'] = '1';
            }
            else
            {
                $input['two_enable'] = '0';
            }

            if($request->three_enable == 'on')
            {
                $input['three_enable'] = '1';
            }
            else
            {
                $input['three_enable'] = '0';
            }

            if($request->four_enable == 'on')
            {
                $input['four_enable'] = '1';
            }
            else
            {
                $input['four_enable'] = '0';
            }

            if($request->five_enable == 'on')
            {
                $input['five_enable'] = '1';
            }
            else
            {
                $input['five_enable'] = '0';
            }

            if($request->six_enable == 'on')
            {
                $input['six_enable'] = '1';
            }
            else
            {
                $input['six_enable'] = '0';
            }

            if ($file = $request->file('one_image'))
            {
                if($about->one_image != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->one_image);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->one_image);
                    }
                }  
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['one_image'] = $name;
            }
            if ($file = $request->file('two_imageone'))
            {
                if($about->two_imageone != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->two_imageone);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->two_imageone);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imageone'] = $name;
            }
            if ($file = $request->file('two_imagetwo'))
            {
                if($about->two_imagetwo != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->two_imagetwo);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->two_imagetwo);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imagetwo'] = $name;
            }
            if ($file = $request->file('two_imagethree'))
            {
                if($about->two_imagethree != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->two_imagethree);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->two_imagethree);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imagethree'] = $name;
            }
            if ($file = $request->file('two_imagefour'))
            {
                if($about->two_imagefour != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->two_imagethree);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->two_imagefour);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imagefour'] = $name;
            }
            if ($file = $request->file('four_imageone'))
            {
                if($about->four_imageone != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->four_imageone);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->four_imageone);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['four_imageone'] = $name;
            }
            if ($file = $request->file('four_imagetwo'))
            {
                if($about->four_imagetwo != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->four_imagetwo);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->four_imagetwo);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['four_imagetwo'] = $name;
            }
            if ($file = $request->file('five_imageone'))
            {
                if($about->five_imageone != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->five_imageone);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->five_imageone);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['five_imageone'] = $name;
            }
            if ($file = $request->file('five_imagetwo'))
            {
                if($about->five_imagetwo != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->five_imagetwo);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->five_imagetwo);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['five_imagetwo'] = $name;
            }
            if ($file = $request->file('five_imagethree'))
            {
                if($about->five_imagethree != "")
                {
                    $image_file = @file_get_contents(public_path().'/images/about/'.$about->five_imagethree);

                    if($image_file)
                    {
                        unlink('images/about/'.$about->five_imagethree);
                    }
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['five_imagethree'] = $name;
            }

            $about->save();
            $about->update($input);

        }

        else
        {
            if($request->one_enable == 'on')
            {
                $input['one_enable'] = '1';
            }
            else
            {
                $input['one_enable'] = '0';
            }

            if($request->two_enable == 'on')
            {
                $input['two_enable'] = '1';
            }
            else
            {
                $input['two_enable'] = '0';
            }

            if($request->three_enable == 'on')
            {
                $input['three_enable'] = '1';
            }
            else
            {
                $input['three_enable'] = '0';
            }

            if($request->four_enable == 'on')
            {
                $input['four_enable'] = '1';
            }
            else
            {
                $input['four_enable'] = '0';
            }

            if($request->five_enable == 'on')
            {
                $input['five_enable'] = '1';
            }
            else
            {
                $input['five_enable'] = '0';
            }

            if($request->six_enable == 'on')
            {
                $input['six_enable'] = '1';
            }
            else
            {
                $input['six_enable'] = '0';
            }



            if ($file = $request->file('one_image'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['one_image'] = $name;
            }
            if ($file = $request->file('two_imageone'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imageone'] = $name;
            }
            if ($file = $request->file('two_imagetwo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imagetwo'] = $name;
            }
            if ($file = $request->file('two_imagethree'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imagethree'] = $name;
            }
            if ($file = $request->file('two_imagefour'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['two_imagefour'] = $name;
            }
            if ($file = $request->file('four_imageone'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['four_imageone'] = $name;
            }
            if ($file = $request->file('four_imagetwo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['four_imagetwo'] = $name;
            }
            if ($file = $request->file('five_imageone'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['five_imageone'] = $name;
            }
            if ($file = $request->file('five_imagetwo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['five_imagetwo'] = $name;
            }
            if ($file = $request->file('five_imagethree'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/about', $name);
                $input['five_imagethree'] = $name;
            }

            $data = About::create($input);
          
            $data->save();

        }
        
        return back()->with('success','Updated Successfully');
    }

    public function aboutpage()
    {
        $about = About::first();
        return view('front.about',compact('about'));
    }
}


