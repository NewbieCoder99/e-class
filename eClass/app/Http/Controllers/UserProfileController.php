<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Country;
use App\State;
use App\City;
use Session;
use Image;
use Auth;
use Hash;
use Redirect;

class UserProfileController extends Controller
{
    public function userprofilepage($id)
    {
        if(Auth::check())
        {
            $course = Course::all();
            $countries = Country::all();
            $states = State::all();
            $cities = City::all();
            $orders = User::where('id', Auth::User()->id)->first();
            return view('front.user_profile.profile',compact('orders', 'course', 'countries', 'states', 'cities'));  
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');
    }

    public function userprofile(Request $request,$id)
    {

        $user = User::findorfail($id);

        $input = $request->all();

        if($file = $request->file('user_img'))
        {
            if($user->user_img != "")
            {
                $content = @file_get_contents(public_path().'/images/user_img/'.$user->user_img);

                if ($content) {
                    unlink(public_path().'/images/user_img/'.$user->user_img);
                }
            }

            $name = time().$file->getClientOriginalName();
            $file->move('images/user_img', $name);
            $input['user_img'] = $name;
        }

        if(isset($request->update_pass)){
          
            $input['password'] = Hash::make($request->password);
        }
        else{
            $input['password'] = $user->password;
        }

        $user->update($input);

        Session::flash('success','User Updated Successfully !');
        return back();
    }
}
