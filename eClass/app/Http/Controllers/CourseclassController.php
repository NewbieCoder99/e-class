<?php

namespace App\Http\Controllers;

use App\CourseClass;
use Illuminate\Http\Request;
use Notification;
use DB;
use App\CourseChapter;
use App\Course;
use App\Order;
use App\User;
use App\Notifications\CourseNotification;
use App\Subtitle;
use Session;

class CourseclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseclass = CourseClass::all();
        return view('admin.course.courseclass.index',compact("courseclass"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseclass = CourseClass::all();
        return view('admin.course.courseclass.insert',compact('courseclass')); 
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'video' => 'mimes:mp4,avi,wmv'
        ]);

        $courseclass = new CourseClass;
        $courseclass->course_id = $request->course_id;
        $courseclass->coursechapter_id =  $request->course_chapters;
        $courseclass->title = $request->title;
        $courseclass->duration = $request->duration;
        $courseclass->status = $request->status;
        $courseclass->featured = $request->featured;
        $courseclass->video = $request->video;
        $courseclass->image = $request->image;
        $courseclass->zip = $request->zip;
        $courseclass->pdf = $request->pdf;
        $courseclass->size = $request->size;
        $courseclass->url = $request->url;
        $courseclass->date_time = $request->date_time;
        $courseclass->detail = $request->detail;

        $courseclass['position'] = (CourseClass::count()+1);

        if(isset($request->status))
        {
            $courseclass->status = '1';
        }
        else
        {
            $courseclass->status = '0';
        }
        

        if(isset($request->featured))
        {
            $courseclass->featured = '1';
        }
        else
        {
            $courseclass->featured = '0';
        }

             
        if($request->type == "video")
        {
            $courseclass->type = "video";
                    
            if($request->checkVideo == "url")
            {
                $courseclass->url = $request->vidurl;
                $courseclass->video = null;
                $courseclass->iframe_url = null;
            }
            else if($request->checkVideo == "uploadvideo")
            {
                if($file = $request->file('video_upld'))
                {
                    $name = 'video_course_'.time().$file->getClientOriginalExtension();
                    $file->move('video/class',$name);
                    $courseclass->video = $name;
                    $courseclass->url = null;
                    $courseclass->iframe_url = null;
                }
            }

            else if($request->checkVideo == "iframeurl")
            {
                $courseclass->iframe_url = $request->iframe_url;
                $courseclass->url = null;
                $courseclass->video = null;
            }
            elseif($request->checkVideo == "liveurl")
            {
                $courseclass->url = $request->vidurl;
                $courseclass->video = null;
                $courseclass->iframe_url = null;
            }
        }

        

                    
        if(!isset($request->preview_type))
        {
            $courseclass['preview_url'] = $request->url;
            $courseclass['preview_type'] = "url";
        }
        else
        {
            if($file = $request->file('video'))
            {
                
              $filename = time().$file->getClientOriginalName();
              $file->move('video/class/preview',$filename);
              $courseclass['preview_video'] = $filename;
            }
            $courseclass['preview_type'] = "video";
        }



        if($request->type == "image")
        { 
            $courseclass->type = "image";

            if($request->checkImage == "url")
            {
                $courseclass->url = $request->imgurl;
                $courseclass->image = null;
            }
            else if($request->checkImage == "uploadimage")
            {
                if($file = $request->file('image'))
                {
                    $name = time().$file->getClientOriginalName();
                    $file->move('images/class',$name);
                    $courseclass->image = $name;
                    $courseclass->url = null;
                }
            }
        }


        if($request->type == "zip")
        {
            $courseclass->type = "zip";

            if($request->checkZip == "zipURLEnable")
            {
                $courseclass->url = $request->zipurl;
                $courseclass->zip = null;
            }
            else if($request->checkZip == "zipEnable")
            {
                if($file = $request->file('uplzip'))
                {
                    $name = time().$file->getClientOriginalName();
                    $file->move('files/zip',$name);
                    $courseclass->zip = $name;
                    $courseclass->url = null;
                }
            }
        } 


        if($request->type == "pdf")
        {
            $courseclass->type = "pdf";

            if($request->checkPdf == "pdfURLEnable")
            {
                $courseclass->url = $request->pdfurl;
                $courseclass->pdf = null;
            }
            elseif($request->checkPdf == "pdfEnable")
            {
                if($file = $request->file('pdf'))
                {
                    $name = time().$file->getClientOriginalName();
                    $file->move('files/pdf',$name);
                    $courseclass->pdf = $name;
                    $courseclass->url = null;
                }
            }
        }


        if($request->type == "audio")
        {
            $courseclass->type = "audio";

            if($request->checkAudio == "audiourl")
            {
                $courseclass->url = $request->audiourl;
                $courseclass->audio = null;
            }
            elseif($request->checkAudio == "uploadaudio")
            {
                if($file = $request->file('audioupload'))
                {
                    $name = time().$file->getClientOriginalName();
                    $file->move('files/audio',$name);
                    $courseclass->audio = $name;
                    $courseclass->url = null;
                }
            }
        }



        

        // Notification when course class add
        $cor = Course::where('id', $request->course_id)->first();

        $course = [
          'title' => $cor->title,
          'image' => $cor->preview_image,
        ];

        $enroll = Order::where('course_id', $request->course_id)->get();

        if(!$enroll->isEmpty())
        {
            foreach($enroll as $enrol)
            {
              if($courseclass->save()) 
              {
                $user = User::where('id', $enrol->user_id)->get();
                Notification::send($user,new CourseNotification($course));
              }
            }
        }
        else
        {
            $courseclass->save();
        }
          
        // Subtitle 
        if($request->has('sub_t')){
        foreach($request->file('sub_t') as $key=> $image)
          {
          
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/subtitles/', $name);  
           
            $form= new Subtitle();
            $form->sub_lang = $request->sub_lang[$key];
            $form->sub_t=$name;
            $form->c_id = $courseclass->id;
            $form->save(); 
          }
        }

        return back()->with('success','Course Class is Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\courseclass  $courseclass
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        
        $subtitles = Subtitle::where('c_id', $id)->get();
        $cate = CourseClass::find($id);
        $coursechapt = CourseChapter::where('course_id', $cate->course_id)->get();

        $datetimevalue= strtotime($cate->date_time);
        $formatted = date('Y-m-d', $datetimevalue);

        $pd = $cate['date_time'];
        $live_date = str_replace(" ", "T", $pd);

        return view('admin.course.courseclass.edit',compact('cate','coursechapt','subtitles', 'live_date')); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\courseclass  $courseclass
     * @return \Illuminate\Http\Response
     */
    public function edit(courseclass $courseclass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\courseclass  $courseclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'video' => 'mimes:mp4,avi,wmv'
        ]);

        $courseclass = CourseClass::findOrFail($id);

        $courseclass->coursechapter_id=$request->coursechapter_id;
        $courseclass->title = $request->title;
        $courseclass->duration = $request->duration;
        $courseclass->status = $request->status;
        $courseclass->featured = $request->featured;
        $courseclass->size = $request->size;
        $courseclass->date_time = $request->date_time;
        $courseclass->detail = $request->detail;
         
        $coursefind  = CourseChapter::findOrFail($request->coursechapter);
        $maincourse = Course::findorfail($coursefind->course_id);
        

        if($request->type == "video")
        {

            $courseclass->type = "video";
                
            if($request->checkVideo == "url")
            {

                $courseclass->url = $request->vidurl;
                $courseclass->video = null;
                $courseclass->iframe_url = null;
            }

            else if($request->checkVideo == "uploadvideo")
            {

                if($file = $request->file('video_upld'))
                {
                    if($courseclass->video !="")
                    {
                        $content = @file_get_contents(public_path().'/video/class/'.$courseclass->video);

                        if ($content) {
                            unlink(public_path().'/video/class/'.$courseclass->video);
                        }
                    }
                
                    $name = 'video_course_'.time().'.'.$file->getClientOriginalExtension();
                    $file->move('video/class',$name);
                    $courseclass->video = $name;
                    $courseclass->url = null;
                    $courseclass->iframe_url = null;
                }
            }

            else if($request->checkVideo == "iframeurl")
            {
                $courseclass->iframe_url = $request->iframe_url;
                $courseclass->url = null;
                $courseclass->video = null;
            }
            elseif($request->checkVideo == "liveurl")
            {
                $courseclass->url = $request->vidurl;
                $courseclass->video = null;
                $courseclass->iframe_url = null;
            }
        } 


        if($request->type == "audio")
        { 
            $courseclass->type = "audio";

            if($request->checkAudio == "audiourl")
            {
                $courseclass->url = $request->audiourl;
                $courseclass->audio = null;
            }
            else if($request->checkAudio == "uploadaudio")
            {
                if($file = $request->file('audio'))
                {
                    if($courseclass->audio !="")
                    {
                        $content = @file_get_contents(public_path().'/files/audio/'.$courseclass->audio);

                        if ($content) {
                            unlink(public_path().'/files/audio/'.$courseclass->audio);
                        }
                    }

                    $name = time().$file->getClientOriginalName();
                    $file->move('files/audio',$name);
                    $courseclass->audio = $name;
                    $courseclass->url = null;
                 }
            }

        } 


        if($request->type == "image")
        { 
            $courseclass->type = "image";

            if($request->checkImage == "url")
            {
                $courseclass->url = $request->imgurl;
                $courseclass->image = null;
            }
            else if($request->checkImage == "uploadimage")
            {
                if($file = $request->file('image'))
                {
                    if($courseclass->image !="")
                    {
                        $content = @file_get_contents(public_path().'/images/class/'.$courseclass->image);

                        if ($content) {
                            unlink(public_path().'/images/class/'.$courseclass->image);
                        }
                    }

                    $name = time().$file->getClientOriginalName();
                    $file->move('images/class',$name);
                    $courseclass->image = $name;
                    $courseclass->url = null;
                 }
            }

        } 

        if($request->type == "zip")
        {

            $courseclass->type = "zip";

            if($request->checkZip == "zipURLEnable")
            {
                $courseclass->url = $request->zipurl;
                $courseclass->zip = null;
            }
            else if($request->checkZip == "zipEnable")
            {
                if($file = $request->file('uplzip'))
                {
                    $content = @file_get_contents(public_path().'/files/zip/'.$courseclass->zip);

                    if ($content) {
                        unlink(public_path().'/files/zip/'.$courseclass->zip);
                    }

                    $name = time().$file->getClientOriginalName();
                    $file->move('files/zip',$name);
                    $courseclass->zip = $name;
                    $courseclass->url = null;
                }
            }
        }


        if($request->type == "pdf")
        {
            $courseclass->type = "pdf";

            if($request->checkPdf == "url")
            {
                $courseclass->url = $request->pdfurl;
                $courseclass->pdf = null;
            }
            else if($request->checkPdf == "uploadpdf")
            {
                if($file = $request->file('pdf'))
                {
                    $content = @file_get_contents(public_path().'/files/pdf/'.$courseclass->pdf);

                    if ($content) {
                        unlink(public_path().'/files/pdf/'.$courseclass->pdf);
                    }
        
                    
                    $name = time().$file->getClientOriginalName();
                    $file->move('files/pdf',$name);
                    $courseclass->pdf = $name;
                    $courseclass->url = null;
                 }
            }
        }

        if(isset($request->preview_type))
        {
          $courseclass['preview_type'] = "video";
        }
        else
        {
          $courseclass['preview_type'] = "url";
        }

        
        if(!isset($request->preview_type))
        {
            $courseclass->preview_url = $request->preview_url;
            $courseclass->preview_video = null;
            
        }
        else if($request->preview_type )
        {
            if($file = $request->file('video'))
            {
              if($courseclass->preview_video != "")
              {
                $content = @file_get_contents(public_path().'/video/class/preview/'.$courseclass->preview_video);
                if ($content) {
                  unlink(public_path().'/video/class/preview/'.$courseclass->preview_video);
                }
              }
              
              $filename = time().$file->getClientOriginalName();
              $file->move('video/class/preview',$filename);
              $courseclass['video'] = $filename;
              $courseclass->preview_url = null;

            }
        }

        if(isset($request->status))
        {
            $courseclass['status'] = '1';
        }
        else
        {
            $courseclass['status'] = '0';
        }

        if(isset($request->featured))
        {
            $courseclass['featured'] = '1';
        }
        else
        {
            $courseclass['featured'] = '0';
        }


        $courseclass->save();
        Session::flash('success','Updated Successfully !');
        return redirect()->route('course.show',$maincourse->id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courseclass  $courseclass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $courseclass = CourseClass::find($id);

        if($courseclass->type == "video")
        {
                
            $video_file = @file_get_contents(public_path().'/video/class/'.$courseclass->video);

            if($video_file)
            {
                unlink(public_path().'/video/class/'.$courseclass->video);
            }
        }

        if($courseclass->type == "audio")
        {
                
            $video_file = @file_get_contents(public_path().'/files/audio/'.$courseclass->audio);

            if($video_file)
            {
                unlink(public_path().'/files/audio/'.$courseclass->audio);
            }
        }

        if($courseclass->type == "image")
        {
                
            $image_file = @file_get_contents(public_path().'/images/class/'.$courseclass->image);

            if($image_file)
            {
                unlink(public_path().'/images/class/'.$courseclass->image);
            }
        }

        if($courseclass->type == "zip")
        {
                
            $zip_file = @file_get_contents(public_path().'/files/zip/'.$courseclass->zip);

            if($zip_file)
            {
                unlink(public_path().'/files/zip/'.$courseclass->zip);
            }
        }

        if($courseclass->type == "pdf")
        {
                
            $pdf_file = @file_get_contents(public_path().'/files/pdf/'.$courseclass->pdf);

            if($pdf_file)
            {
                unlink(public_path().'/files/pdf/'.$courseclass->pdf);
            }
        }

        if($courseclass->preview_type = "video")
        {
            $content = @file_get_contents(public_path().'/video/class/preview/'.$courseclass->preview_video);
            if($content) {
              unlink(public_path().'/video/class/preview/'.$courseclass->preview_video);
            }
        }

        $courseclass->delete();
        
        return back();
    }


    public function sort(Request $request){
        
        $posts = CourseClass::all();

        foreach ($posts as $post) {

            foreach ($request->order as $order) {

                if ($order['id'] == $post->id) {

                    \DB::table('course_classes')->where('id',$post->id)->update(['position' => $order['position']]);
                    
                }
            }
        }
        
        return response()->json('Update Successfully.', 200);
    }

   
}
