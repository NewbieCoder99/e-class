<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;

class CareersController extends Controller
{
    public function show()
    {
    	$careers = Career::first();
    	return view('admin.careers.edit', compact('careers'));
    }

    public function update(Request $request)
    {

    	$data = Career::first();

        $input = $request->all();

        if(isset($data))
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


            if ($file = $request->file('one_video'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->one_video);

                if($image_file)
                {
                    unlink('images/careers/'.$data->one_video);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['one_video'] = $name;
            }
            if ($file = $request->file('three_bg_image'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->three_bg_image);

                if($image_file)
                {
                    unlink('images/careers/'.$data->three_bg_image);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['three_bg_image'] = $name;
            }
            if ($file = $request->file('three_video'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->three_video);

                if($image_file)
                {
                    unlink('images/careers/'.$data->three_video);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['three_video'] = $name;
            }
            if ($file = $request->file('four_img_one'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_one);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_one);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_one'] = $name;
            }
            if ($file = $request->file('four_img_two'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_two);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_two);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_two'] = $name;
            }
            if ($file = $request->file('four_img_three'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_three);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_three);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_three'] = $name;
            }
            if ($file = $request->file('four_img_four'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_four);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_four);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_four'] = $name;
            }
            if ($file = $request->file('four_img_five'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_five);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_five);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_five'] = $name;
            }
            if ($file = $request->file('four_img_six'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_six);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_six);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_six'] = $name;
            }
            if ($file = $request->file('four_img_seven'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_seven);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_seven);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_seven'] = $name;
            }
            if ($file = $request->file('four_img_eight'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_eight);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_eight);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_eight'] = $name;
            }
            if ($file = $request->file('four_img_nine'))
            {
                $image_file = @file_get_contents(public_path().'/images/careers/'.$data->four_img_nine);

                if($image_file)
                {
                    unlink('images/careers/'.$data->four_img_nine);
                }
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_nine'] = $name;
            }

            $data->update($input);

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


            if ($file = $request->file('one_video'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['one_video'] = $name;
            }
            if ($file = $request->file('three_bg_image'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['three_bg_image'] = $name;
            }
            if ($file = $request->file('three_video'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['three_video'] = $name;
            }
            if ($file = $request->file('four_img_one'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_one'] = $name;
            }
            if ($file = $request->file('four_img_two'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_two'] = $name;
            }
            if ($file = $request->file('four_img_three'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_three'] = $name;
            }
            if ($file = $request->file('four_img_four'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_four'] = $name;
            }
            if ($file = $request->file('four_img_five'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_five'] = $name;
            }
            if ($file = $request->file('four_img_six'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_six'] = $name;
            }
            if ($file = $request->file('four_img_seven'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_seven'] = $name;
            }
            if ($file = $request->file('four_img_eight'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_eight'] = $name;
            }
            if ($file = $request->file('four_img_nine'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images/careers', $name);
                $input['four_img_nine'] = $name;
            }

            $data = Career::create($input);
          
            $data->save();
        }

        return back()->with('success','Updated Successfully');

    }

    public function careerpage()
    {
        $data = Career::first();
        return view('front.careers',compact('data'));
    }
}
