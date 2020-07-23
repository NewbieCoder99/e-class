<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated()
    {

        if (Auth::User()->status == 1)
        {
           
            if ( Auth::User()->role == "admin" || Auth::User()->role == "instructor" ) 
            {
                // do your magic here
                return redirect()->route('admin.index');
            }
            else
            {
                 return redirect('/home');
      
            }
        }
        else{
            
            Auth::logout();
            return redirect()->route('login')->with('delete','You are deactivated !'); 
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();

        // set the remember me cookie if the user check the box
        $remember = (Input::has('remember')) ? true : false;

        // attempt to do the login
        $auth = Auth::attempt(
            [
                'email'  => strtolower(Input::get('email')),
                'password'  => Input::get('password')    
            ], $remember
        );

        if ($user) {
            Auth::login($user);
            return redirect()-> action('HomeController@index');
        }
        else {
            return view('auth.register', ['name'=> $userSocial->getName(), 
                                            'email' => $userSocial->getEmail()]);
        }
    }
}
