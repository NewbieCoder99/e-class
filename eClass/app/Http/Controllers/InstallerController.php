<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Artisan;
use App\Setting;
use Image;
use App\User;
use Hash;
use App\Currency;
use DB;
use Crypt;

class InstallerController extends Controller
{
    public function verifylicense(){
        if(Session::get('servercheck') == 'OK') {
          return view('install.verifylicense');
        }else{
          return redirect()->route('servercheck');
        }
    }

    public function verify(){

        if(env('IS_INSTALLED') == 0){
          $getstatus = @file_get_contents(public_path('step1.txt'));
          $getstatus = Crypt::decrypt($getstatus);
          if($getstatus == 'complete'){
            return view('install.verify');
          }else{
              return redirect()->route('servercheck');
          }
        
        }else{
          return redirect('/');
        }

    }

    public function eula(){

        if(env('IS_INSTALLED') == 0){
            return view('install.eula');
        }else{
            return redirect('/');
        }

    }

    public function storeserver(){

      if(env('IS_INSTALLED') == 0){
          $status = 'complete';
          $status = Crypt::encrypt($status);
          @file_put_contents(public_path('step2.txt'), $status);
          return redirect()->route('verifyApp');
      }else{
          return redirect('/');
      }

    }

  

    public function serverCheck(Request $request){

        if(env('IS_INSTALLED') == 0){
          $getstatus = @file_get_contents(public_path('step1.txt'));
          $getstatus = Crypt::decrypt($getstatus);
          if ($getstatus == 'complete') {
              return view('install.servercheck');
          }else{
              return redirect()->route('installer');
          }
        }else{
          return redirect('/');
        }
    }
  

    public function storeeula(Request $request){

      if (isset($request->eula)) {
          $status = 'complete';
          $status = Crypt::encrypt($status);
          @file_put_contents(public_path('step1.txt'), $status);
          return redirect()->route('servercheck');

      }else{
        Session::flash('delete','Please accept terms of condition !');
        return back();
      }
    }

    public function index(){
        if(env('IS_INSTALLED') == 0){
            $getstatus = @file_get_contents(public_path('step3.txt'));
            $getstatus = Crypt::decrypt($getstatus);
            if ($getstatus == 'complete') {
                  return view('install.index');
            }
      }else{
        return redirect('/');
      }
    }

    public function step1(Request $request){
      
      $env_update = $this->changeEnv([
          'APP_NAME' => $string = preg_replace('/\s+/', '', $request->APP_NAME),
          'APP_URL' => $request->APP_URL,
          'MAIL_FROM_NAME' => $mail = preg_replace('/\s+/', '', $request->MAIL_FROM_NAME),
          'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
          'MAIL_DRIVER' => $request->MAIL_DRIVER,
          'MAIL_HOST'  => $request->MAIL_HOST,
          'MAIL_PORT' => $request->MAIL_PORT,
          'MAIL_USERNAME' => $request->MAIL_USERNAME,
          'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
          'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION
        ]);

        $status = 'complete';
        $status = Crypt::encrypt($status);
        @file_put_contents(public_path('step4.txt'), $status);

        if($env_update) {
          return redirect()->route('get.step2');
        }

    }

    public function getstep2(){
      
      if(env('IS_INSTALLED') == 0){
          $getstatus = @file_get_contents(public_path('step4.txt'));
          $getstatus = Crypt::decrypt($getstatus);
          if ($getstatus == 'complete') {
              return view('install.step2');
          }else{
             return redirect()->route('installApp');
          }
      }else{
          return redirect('/');
      }
      
    }

   
    public function step2(Request $request){

     
        $env_update = $this->changeEnv([
          'DB_HOST'     => $request->DB_HOST,
          'DB_PORT'     => $request->DB_PORT,
          'DB_DATABASE' => $request->DB_DATABASE,
          'DB_USERNAME' => $request->DB_USERNAME,
          'DB_PASSWORD' => $request->DB_PASSWORD
        ]);

        try
        {
            \DB::connection()->getPdo();

            if ($env_update)
            {
                 $status = 'complete';
                 $status = Crypt::encrypt($status);
                 @file_put_contents(public_path('step5.txt'), $status);
                 return redirect()->route('get.step3');
            }

        }catch(\Exception $e)
        {
          
          $errorcode = $e->getCode();
           if($errorcode){
              Session::flash('delete','Invalid Database details please check !');
              return view('install.step2');
           }
        }
        

    }

    public function getstep3(){

      try
        {
           ini_set('max_execution_time', 300);

            \DB::connection()
                ->getPdo();

            if (env('IS_INSTALLED') == 0)
            {

                if (!\Schema::hasTable('genrals'))
                {
                    Artisan::call('migrate');
                    Artisan::call('db:seed');
                }

                $getstatus = @file_get_contents(public_path('step5.txt'));
                $getstatus = Crypt::decrypt($getstatus);
                if ($getstatus == 'complete')
                {
                    return view('install.step3');
                }
                

            }
            else
            {
                return redirect('/');
            }

        }
        catch(\Exception $e)
        {

            $errorcode = $e->getCode();

            if ($errorcode == 1045 || $errorcode == 1049)
            {
              Session::flash('delete','Error Connecting in Database Please check details !');
              return redirect()->route('get.step2');

            }

            if ($errorcode == 2002 )
            {
              Session::flash('delete','Invalid Database host or port !');
              return redirect()->route('get.step2');
            }

            Session::flash('delete','Error Connecting to Database !');
              
            return redirect()->route('get.step2');

        }
       
        
      
    }

    public function storeStep3(Request $request){
        // store seo details

        $seo = Setting::first();

        $seo->project_title = $request->project_name;
      
        
        $seo->save();
        

        //store genral settings

        $newGenral = Setting::first();

        $newGenral->project_title = $request->project_name;

        
        
        $newGenral->wel_email   = $request->email;

       

        $newGenral->save();

        

        $status = 'complete';
        $status = Crypt::encrypt($status);
        @file_put_contents(public_path('step6.txt'), $status);

        return redirect()->route('get.step4');


    }

    public function getstep4(){

      if(env('IS_INSTALLED') == 0){
        $getstatus = @file_get_contents(public_path('step6.txt'));
        $getstatus = Crypt::decrypt($getstatus);
        if ($getstatus == 'complete') {
            return view('install.step4');
        }
      }else{
        return redirect('/');
      }
      
    }

     public function storeStep4(Request $request){

        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $useralready = User::first();

        if (isset($useralready)) {

            User::query()->truncate();

        }

        $dir = 'images/user_img';
        $leave_files = array('index.php');

        foreach( glob("$dir/*") as $file ) {
            if( !in_array(basename($file), $leave_files) ){
                unlink($file);
            }
        }

            $user = new User;

            $user->fname    = $request->fname;
            $user->lname    = $request->lname;
            $user->email    = $request->email;
            $user->role     = 'admin';
            $user->password = Hash::make($request->password);

           

            $user->save();
        
        
        $status = 'complete';
        $status = Crypt::encrypt($status);
        @file_put_contents(public_path('step7.txt'), $status);

        return redirect()->route('get.step5');

     }

     public function getstep5(){
      
      if(env('IS_INSTALLED') == 0){
         $getstatus =  @file_get_contents(public_path('step7.txt'));
         $getstatus = Crypt::decrypt($getstatus);
         if ($getstatus == 'complete') {
          return view('install.step5');
        }
      }else{
        return redirect('/');
      }
      

     }

     public function storeStep5(Request $request){
      
            $setting = Setting::first();

            if($request->rightclick == 'on')
            {
              $setting->rightclick = 1;
            }
            else{
              $setting->rightclick = 0;
            }

            if($request->inspect == 'on')
            {
              $setting->inspect = 1;
            }
            else{
              $setting->inspect = 0;
            }

            if($request->wel_email == 'on')
            {
              $setting->w_email_enable = 1;
            }
            else{
              $setting->w_email_enable = 0;
            }

            if($request->instructor_enable == 'on')
            {
              $setting->instructor_enable = 1;
            }
            else{
              $setting->instructor_enable = 0;
            }

            $setting->save();

            $apistatus = $this->update_status('1');

            if($apistatus == 1){
              $env_update = $this->changeEnv([
                'IS_INSTALLED' => '1'
              ]);

            Session::flush();

            $remove_step_files = array('step1.txt','step2.txt','step3.txt','step4.txt','step5.txt','step6.txt','step7.txt');

            foreach ($remove_step_files as $key => $file) {
                
                @unlink(public_path($file));

            }


            \Artisan::call('cache:clear');
            \Artisan::call('view:cache');
            \Artisan::call('view:clear');

            return redirect('/'); 
            }else{
              \Artisan::call('cache:clear');
              \Artisan::call('view:cache');
              \Artisan::call('view:clear');
              return redirect()->route('get.step5');
            }

               

     }


  protected function changeEnv($data = array()){
    {
        if ( count($data) > 0 ) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){
              // Loop through .env-data
              foreach($env as $env_key => $env_value){
                // Turn the value into an array and stop after the first split
                // So it's not possible to split e.g. the App-Key by accident
                $entry = explode("=", $env_value, 2);

                // Check, if new key fits the actual .env-key
                if($entry[0] == $key){
                    // If yes, overwrite it with the new one
                    $env[$env_key] = $key . "=" . $value;
                } else {
                    // If not, keep the old one
                    $env[$env_key] = $env_value;
                }
              }
            }

            // Turn the array back to an String
            $env = implode("\n\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;

        } else {

          return false;
        }
    }
  }

    public function update_status($status)
    {
        return 1;
        // $token = (file_exists(public_path() . '/intialize.txt') && file_get_contents(public_path() . '/intialize.txt') != null) ? file_get_contents(public_path() . '/intialize.txt') : '0';

        //  $d = \Request::getHost();
        //  $domain = str_replace("www.", "", $d);   

        // $ch = curl_init();

        // $options = array(
        //     CURLOPT_URL => "https://mediacity.co.in/purchase/public/api/updatestatus",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_TIMEOUT => 20,
        //     CURLOPT_POSTFIELDS => "status={$status}&domain={$domain}",
        //     CURLOPT_HTTPHEADER => array(
        //         'Accept: application/json',
        //         "Authorization: Bearer " . $token
        //     ) ,
        // );

        // curl_setopt_array($ch, $options);
        // $response = curl_exec($ch);
        // if (curl_errno($ch) > 0)
        // {
        //     $message = "Error connecting to API.";
        //     return 2;
        // }
        
        // $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // if ($responseCode == 200)
        // {
        //     $body = json_decode($response);
        //     return $body->status;
        // }
        // else
        // {
        //     return 2;
        // }
    }




}
