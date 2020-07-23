<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function genreal()
    {
      $env_files = [
        'APP_URL' => env('APP_URL'),
        'APP_DEBUG' => env('APP_DEBUG'),
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        'MAIL_DRIVER' => env('MAIL_DRIVER'),
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        'FACEBOOK_CLIENT_ID' => env('FACEBOOK_CLIENT_ID'),
        'FACEBOOK_CLIENT_SECRET' => env('FACEBOOK_CLIENT_SECRET'),
        'FACEBOOK_CALLBACK_URL' => env('FACEBOOK_CALLBACK_URL'),
        'GOOGLE_CLIENT_ID' => env('GOOGLE_CLIENT_ID'),
        'GOOGLE_CLIENT_SECRET' => env('GOOGLE_CLIENT_SECRET'),
        'GOOGLE_CALLBACK_URL' => env('GOOGLE_CALLBACK_URL'),
        'GITLAB_CLIENT_ID' => env('GITLAB_CLIENT_ID'),
        'GITLAB_CLIENT_SECRET' => env('GITLAB_CLIENT_SECRET'),
        'GITLAB_CALLBACK_URL' => env('GITLAB_CALLBACK_URL'),
        'AMAZON_LOGIN_ID' => env('AMAZON_LOGIN_ID'),
        'AMAZON_LOGIN_SECRET' => env('AMAZON_LOGIN_SECRET'),
        'AMAZON_LOGIN_REDIRECT' => env('AMAZON_LOGIN_REDIRECT'),
        'LINKEDIN_CLIENT_ID' => env('LINKEDIN_CLIENT_ID'),
        'LINKEDIN_CLIENT_SECRET' => env('LINKEDIN_CLIENT_SECRET'),
        'LINKEDIN_CALLBACK_URL' => env('LINKEDIN_CALLBACK_URL'),
        'TWITTER_CLIENT_ID' => env('TWITTER_CLIENT_ID'),
        'TWITTER_CLIENT_SECRET' => env('TWITTER_CLIENT_SECRET'),
        'TWITTER_CALLBACK_URL' => env('TWITTER_CALLBACK_URL')
      ];
      $setting = Setting::first();
      $css = @file_get_contents("css/custom-style.css");
      $js = @file_get_contents("js/custom-js.js");
      return view('admin.setting.setting',compact('css','js','setting','env_files'));
    }

    public function store(Request $request)
    {
      $request->validate([
          'project_title' => 'required',
          'APP_URL' => 'required',
          'favicon' => 'mimes:ico,png',
          'logo' => 'mimes:png,jpeg,jpg'
        ],
        [
          'project_title.required' => 'Project Title is required',
          'APP_URL.required' => 'App URL is required'
        ]
        );

        $active = @file_get_contents(public_path().'/config.txt');

        if(!$active){
            $putS = 1;
            file_put_contents(public_path().'/config.txt',$putS);
        }

       
        $d = \Request::getHost();
        $domain = str_replace("www.", "", $d); 

        if($domain == 'localhost' || strstr( $domain, '192.168.0' ) || strstr( $domain, 'mediacity.co.in' )){
            return $this->extraupdate($request);
        }else{

          $token = (file_exists(public_path().'/intialize.txt') &&  file_get_contents(public_path().'/intialize.txt') != null) ? file_get_contents(public_path().'/intialize.txt') : 0;
          
          $code = (file_exists(public_path().'/code.txt') &&  file_get_contents(public_path().'/code.txt') != null) ? file_get_contents(public_path().'/code.txt') : 0;
          
            $ch = curl_init();
            $options = array(
              CURLOPT_URL => "https://mediacity.co.in/purchase/public/api/check/{$domain}",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_TIMEOUT => 20, 
              CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    "Authorization: Bearer ".$token
              ),
            );
            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);
        
          if (curl_errno($ch) > 0) { 
             $message = "Error connecting to API.";
             return back()->with('delete',$message);
          }
          $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          if ($responseCode == 200) {
              $body = json_decode($response);
              return $this->extraupdate($request);    
          }
          else{
               $message = "Failed";
               $putS = 0;
               file_put_contents(public_path().'/config.txt', $putS);
               return redirect()->route('inactive');
          }
        }
        
      
    }

    public function extraupdate($request){
      
      $setting = Setting::first();

        $setting->project_title = $request->project_title;
        $setting->rightclick = $request->rightclick;
        $setting->inspect = $request->inspect;
        $setting->cpy_txt = $request->cpy_txt;
        $setting->wel_email = $request->wel_email;
        $setting->default_address = $request->default_address;
        $setting->default_phone = $request->default_phone;
        $setting->feature_amount = $request->feature_amount;
        $setting->map_lat = $request->map_lat;
        $setting->map_long = $request->map_long;
        $setting->promo_text = $request->promo_text;
        $setting->promo_link = $request->promo_link;
        $setting->map_api = $request->map_api;


        $env_update = $this->changeEnv([
            'APP_NAME' => $string = preg_replace('/\s+/', '', $request->project_title),
            'APP_URL' => $request->APP_URL,
            
        ]);


        if(isset($request->APP_DEBUG)){
          $env_update = $this->changeEnv([
            'APP_DEBUG' => 'true'
          ]);
        }else{
          $env_update = $this->changeEnv([
            'APP_DEBUG' => 'false'
          ]);
        }
        
     
        if($file = $request->file('logo')) {
          $name = 'logo_' . time() . $file->getClientOriginalName();
          if($setting->logo != null) {
            $content = @file_get_contents(public_path().'/images/logo/'.$setting->logo);
            if($content) {
              unlink(public_path().'/images/logo/'.$setting->logo);
            }
          }
          $file->move('images/logo', $name);
          $setting['logo'] = $name;
          $setting->update([
          'logo' => $setting['logo']
          ]);

          $setting->logo_type = 'L';
        }

        if($file = $request->file('favicon')) {
          $name = 'favicon.png';
          if($setting->favicon != null) {
              $content = @file_get_contents(public_path().'/images/favicon/'.$setting->favicon);
              if($content) {
                unlink(public_path().'/images/favicon/'.$setting->favicon);
              }
          }
          $file->move('images/favicon', $name);
          $setting['favicon'] = $name;
          $setting->update([
            'favicon' => $setting['favicon']
            ]);
        }

        if($file = $request->file('contact_image')) {
          $name = 'contact.png';
          if($setting->contact_image != null) {
              $content = @file_get_contents(public_path().'/images/contact/'.$setting->contact_image);
              if($content) {
                unlink(public_path().'/images/contact/'.$setting->contact_image);
              }
          }
          $file->move('images/contact', $name);
          $setting['contact_image'] = $name;
          $setting->update([
            'contact_image' => $setting['contact_image']
            ]);
        }
        

        if(isset($request->project_logo))
        {
          $setting->logo_type = 'L';
        }
        else
        {
          $setting->logo_type = 'T';
        }

        if(isset($request->rightclick))
        {
          $setting->rightclick = 0;
        }
        else
        {
          $setting->rightclick = 1;
        }

        if(isset($request->inspect))
        {
          $setting->inspect = 0;
        }
        else
        {
          $setting->inspect = 1;
        }

        if(isset($request->w_email_enable))
        {
          if (env('MAIL_USERNAME')!=null) {
             $setting->w_email_enable = '1';
          }else{
            return back()->with('delete', 'Update your mail API !!');
          }
        }
        else
        {
          $setting->w_email_enable = '0';
        }

        if(isset($request->verify_enable))
        {
          if (env('MAIL_USERNAME')!=null) {
             $setting->verify_enable = '1';
          }else{
            return back()->with('delete', 'Update your mail API !!');
          }
        }
        else
        {
          $setting->verify_enable = '0';
        }

        if(isset($request->instructor_enable))
        {
          $setting->instructor_enable = '1';
        }
        else
        {
          $setting->instructor_enable = '0';
        }

        if(isset($request->cat_enable))
        {
          $setting->cat_enable = '1';
        }
        else
        {
          $setting->cat_enable = '0';
        }

        if(isset($request->preloader_enable))
        {
          $setting->preloader_enable = '1';
        }
        else
        {
          $setting->preloader_enable = '0';
        }

        if(isset($request->zoom_enable)){
          $setting->zoom_enable = 1;
        }else{
           $setting->zoom_enable = 0;
        }


        if(isset($request->bbl_enable)){
          $setting->bbl_enable = 1;
        }else{
           $setting->bbl_enable = 0;
        }

        if(isset($request->mobile_enable)){
          $setting->mobile_enable = 1;
        }else{
          $setting->mobile_enable = 0;
        }

        if(isset($request->map_enable)){
          $setting->map_enable = 'map';
        }else{
          $setting->map_enable = 'image';
        }

        if(isset($request->promo_enable)){
          $setting->promo_enable = 1;
        }else{
          $setting->promo_enable = 0;
        }


        $setting->save();
        return redirect()->route('gen.set')->with('success','Settings Updated !');
    }

    public function updateMailSetting(Request $request)
    {
      
        $input = $request->all();
        $setting = Setting::first();
        
        
        $env_update = $this->changeEnv([
          'MAIL_FROM_NAME' => $input['MAIL_FROM_NAME'],
          'MAIL_FROM_ADDRESS' => $input['MAIL_FROM_ADDRESS'],
          'MAIL_DRIVER' => $input['MAIL_DRIVER'],
          'MAIL_HOST' => $input['MAIL_HOST'],
          'MAIL_PORT' => $input['MAIL_PORT'],
          'MAIL_USERNAME'=> $input['MAIL_USERNAME'],
          'MAIL_PASSWORD'=> $input['MAIL_PASSWORD'],
          'MAIL_ENCRYPTION'=> $input['MAIL_ENCRYPTION']
        ]);
        

        if($env_update) 
        {
          return back()->with('updated', 'Mail settings has been saved');
        } 
        else 
        {
          return back()->with('deleted', 'Mail settings could not be saved');
        }
    }

    public function updateSeo(Request $request)
    {

        $setting = Setting::first();
        $setting->meta_data_desc = $request->meta_data_desc;
        $setting->meta_data_keyword = $request->meta_data_keyword;
        $setting->google_ana = $request->google_ana;
        $setting->fb_pixel = $request->fb_pixel;

        $setting->save();
        return redirect()->route('gen.set')->with('success','Seo Setting Updated !');
    }


    public function storeCSS(Request $request)
    {

        
        $css = $request->css;
        file_put_contents("css/custom-style.css",$css.PHP_EOL);
        return redirect()->route('gen.set')->with('success','Custom CSS Updated !');
    }

    public function storeJS(Request $request)
    {

      $js = $request->js;
      file_put_contents("js/custom-js.js",$js.PHP_EOL);
      return redirect()->route('gen.set')->with('success','Added Javascript Updated !');
    }

    public function slfb(Request $request)
    {
       $setting = Setting::first();

        if(isset($request->fb_enable))
        {
          $setting->fb_login_enable = "1";
        }else
        {
          $setting->fb_login_enable = "0";
        }
       
        $env_update = $this->changeEnv([
          'FACEBOOK_CLIENT_ID' => $request->FACEBOOK_CLIENT_ID,
          'FACEBOOK_CLIENT_SECRET' => $request->FACEBOOK_CLIENT_SECRET,
          'FACEBOOK_CALLBACK_URL' => $request->FACEBOOK_CALLBACK_URL
          
        ]);


       $setting->save();

       return redirect()->route('gen.set')->with('success','Facebook Login Setting Updated !');
    }

    public function slgl(Request $request)
    {
        $setting = Setting::first();

        if(isset($request->google_enable))
        {
          $setting->google_login_enable = "1";
        }else
        {
          $setting->google_login_enable = "0";
        }
       
        $env_update = $this->changeEnv([
          'GOOGLE_CLIENT_ID' => $request->GOOGLE_CLIENT_ID,
          'GOOGLE_CLIENT_SECRET' => $request->GOOGLE_CLIENT_SECRET,
          'GOOGLE_CALLBACK_URL' => $request->GOOGLE_CALLBACK_URL
          
        ]);

        $setting->save();

        return redirect()->route('gen.set')->with('success','Google Login Setting Updated !');
    }

    public function slgit(Request $request)
    {
        $setting = Setting::first();

        if(isset($request->gitlab_enable))
        {
          $setting->gitlab_login_enable = "1";
        }else
        {
          $setting->gitlab_login_enable = "0";
        }
       
        $env_update = $this->changeEnv([
          'GITLAB_CLIENT_ID' => $request->GITLAB_CLIENT_ID,
          'GITLAB_CLIENT_SECRET' => $request->GITLAB_CLIENT_SECRET,
          'GITLAB_CALLBACK_URL' => $request->GITLAB_CALLBACK_URL
          
        ]);

        $setting->save();

        return redirect()->route('gen.set')->with('success','GitLab Login Setting Updated !');
    }

    public function slamazon(Request $request)
    {
        $setting = Setting::first();

        if(isset($request->amazon_enable))
        {
          $setting->amazon_enable = "1";
        }else
        {
          $setting->amazon_enable = "0";
        }
       
        $env_update = $this->changeEnv([
          'AMAZON_LOGIN_ID' => $request->AMAZON_LOGIN_ID,
          'AMAZON_LOGIN_SECRET' => $request->AMAZON_LOGIN_SECRET,
          'AMAZON_LOGIN_REDIRECT' => $request->AMAZON_LOGIN_REDIRECT
          
        ]);

        $setting->save();

        return redirect()->route('gen.set')->with('success','Amazon Login Setting Updated !');
    }

    public function sllinkedin(Request $request)
    {
        $setting = Setting::first();

        if(isset($request->linkedin_enable))
        {
          $setting->linkedin_enable = "1";
        }else
        {
          $setting->linkedin_enable = "0";
        }
       
        $env_update = $this->changeEnv([
          'LINKEDIN_CLIENT_ID' => $request->LINKEDIN_CLIENT_ID,
          'LINKEDIN_CLIENT_SECRET' => $request->LINKEDIN_CLIENT_SECRET,
          'LINKEDIN_CALLBACK_URL' => $request->LINKEDIN_CALLBACK_URL
          
        ]);

        $setting->save();

        return redirect()->route('gen.set')->with('success','Linkedin Login Setting Updated !');
    }

    public function sltwitter(Request $request)
    {
        $setting = Setting::first();

        if(isset($request->twitter_enable))
        {
          $setting->twitter_enable = "1";
        }else
        {
          $setting->twitter_enable = "0";
        }
       
        $env_update = $this->changeEnv([
          'TWITTER_CLIENT_ID' => $request->TWITTER_CLIENT_ID,
          'TWITTER_CLIENT_SECRET' => $request->TWITTER_CLIENT_SECRET,
          'TWITTER_CALLBACK_URL' => $request->TWITTER_CALLBACK_URL
          
        ]);

        $setting->save();

        return redirect()->route('gen.set')->with('success','Twitter Login Setting Updated !');
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
}
