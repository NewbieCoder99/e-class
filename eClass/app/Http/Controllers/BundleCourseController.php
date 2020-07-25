<?php

namespace App\Http\Controllers;

use App\BundleCourse;
use Illuminate\Http\Request;
use App\Course;
use Image;
use DB;
use Auth;
use App\Cart;
use App\Order;

class BundleCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = BundleCourse::get();
        return view('admin.bundle.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::get();
        return view('admin.bundle.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        $this->validate($request,[
            'course_id' => 'required',
            'title' => 'required',
            'detail' => 'required',
        ]);

        $input = $request->all();

        $data = BundleCourse::create($input); 

        if(isset($request->type))
        {
          $data->type = "1";
        }
        else
        {
          $data->type = "0";
        }


        if($file = $request->file('preview_image')) 
        {        
          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/bundle/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $data->preview_image = $image;
          
        }


        $slug = str_slug($request->title,'-');
        $data->slug = $slug;

        $data->save();

        return redirect('bundle');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BundleCourse  $bundleCourse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cor = BundleCourse::find($id);
        $courses = Course::get();
        return view('admin.bundle.edit', compact('cor', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BundleCourse  $bundleCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(BundleCourse $bundleCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BundleCourse  $bundleCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'title' => 'required',

        ]);

          
        $course = BundleCourse::findOrFail($id);
        $input = $request->all();
           


        if(isset($request->type))
        {
          $input['type'] = "1";
        }
        else
        {
          $input['type'] = "0";
        }

        
        if ($file = $request->file('image')) {
          
          if($course->preview_image != null) {
            $content = @file_get_contents(public_path().'/images/bundle/'.$course->preview_image);
            if ($content) {
              unlink(public_path().'/images/bundle/'.$course->preview_image);
            }
          }

          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/bundle/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $input['preview_image'] = $image;
          
        }


        

        $slug = str_slug($input['title'],'-');
        $input['slug'] = $slug;

       

        Cart::where('bundle_id', $id)
         ->update([
             'price' => $request->price,
             'offer_price' => $request->discount_price,
          ]);


        $course->update($input);

        return redirect('bundle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BundleCourse  $bundleCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = BundleCourse::find($id);

        $order = Order::where('bundle_id', $id)->get();

        if(!$order->isEmpty())
        {
          return back()->with('delete','Users are Enrolled in Course' );
        }
        else{
        
          Cart::where('bundle_id', $id)->delete();
          
          if ($course->preview_image != null)
          {
                  
              $image_file = @file_get_contents(public_path().'/images/bundle/'.$course->preview_image);

              if($image_file)
              {
                  unlink(public_path().'/images/bundle/'.$course->preview_image);
              }
          } 

          $value = $course->delete();
        }

        return redirect('bundle');
    }


    public function addtocart(Request $request, $id)
    {

            $bundle_course = BundleCourse::where('id', $id)->first();
            
            DB::table('carts')->insert(
            array(

                'user_id' => Auth::User()->id,
                'course_id' => NULL,
                'price' => $bundle_course->price,
                'offer_price' => $bundle_course->discount_price,
                'bundle_id' => $id,
                'type' => '1',
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),

                )
            );


        return back()->with('success','Course is added to your cart !');
      
    }


    public function detailpage(Request $request, $id)
    {
        $bundle = BundleCourse::where('id', $id)->first();
        return view('front.bundle_detail', compact('bundle'));
    }

    public function enroll(Request $request, $id)
    {
        // return $id;
        $course = BundleCourse::where('id', $id)->first();

        $bundle_course_id = $course->course_id;

        

        $created_order = Order::create([
            'user_id' => Auth::User()->id,
            'instructor_id' => $course->user_id,
            'course_id' => NULL,
            'total_amount' => 'Free',
            'bundle_id' => $course->id,
            'bundle_course_id' => $bundle_course_id,
            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
            ]
        );



        return back()->with('success','You Are Enrolled Successfully !');
    }
}
