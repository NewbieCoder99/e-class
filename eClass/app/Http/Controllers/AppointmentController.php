<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\User;
use Mail;
use App\Mail\UserAppointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appoint = Appointment::find($id);
        return view('admin.course.appointment.view', compact('appoint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $data = Appointment::findorfail($id);
        $maincourse = Course::findorfail($request->course_id);
        $input['accept'] = $request->accept;
        

        if(isset($request->accept))
        {
            
            Appointment::where('id', $id)
                    ->update(['reply' => $request->reply, 'accept' => 1]);
            
        }
        else
        { 
            
            Appointment::where('id', $id)
                    ->update(['reply' => NULL, 'accept' => 0]);
            
        }

        

        return redirect()->route('course.show',$maincourse->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Appointment::where('id', $id)->delete();
        return back()->with('delete','Appointment is Deleted');
    }

    public function delete($id)
    {
        Appointment::where('id', $id)->delete();
        return back()->with('delete','Appointment is Deleted');
    }

    public function request(Request $request, $id)
    {
        $appointment = Appointment::create([
                'user_id' => Auth::User()->id,
                'instructor_id' => $request->instructor_id,
                'course_id' => $id,
                'title' => $request->title,
                'detail' =>  $request->detail,
                'accept' =>  '0',
                'start_time' =>  $request->date_time,
            ]
        );

        $users = User::where('id', $request->instructor_id)->first();


        if($appointment){
            if(env('MAIL_USERNAME')!=null) {
                try{
                    
                    /*sending email*/
                    $x = 'You get Appointment Request';
                    $request = $appointment;
                    Mail::to($users->email)->send(new UserAppointment($x, $request));


                }catch(\Swift_TransportException $e){
                    return back()->with('success','Appointment request sent Successfully ! but Mail will not sent because of error in mail configuration !');
                }
            }
        }

        return back()->with('success','Request Successfully !'); 
    }
}
