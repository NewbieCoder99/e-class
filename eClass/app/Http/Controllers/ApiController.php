<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class ApiController extends Controller
{
    
  public function setApiView()
  {
      $setting = Setting::first();
      $env_files = [
        'STRIPE_KEY' => env('STRIPE_KEY'),
        'STRIPE_SECRET' => env('STRIPE_SECRET'),
        'PAYPAL_CLIENT_ID' => env('PAYPAL_CLIENT_ID'),
        'PAYPAL_SECRET' => env('PAYPAL_SECRET'),
        'PAYPAL_MODE' => env('PAYPAL_MODE'),
        'IM_API_KEY'=> env('IM_API_KEY'),
        'IM_AUTH_TOKEN'=> env('IM_AUTH_TOKEN'),
        'IM_URL'=> env('IM_URL'),
        'RAZORPAY_KEY' => env('RAZORPAY_KEY'),
        'RAZORPAY_SECRET' => env('RAZORPAY_SECRET'),
        'PAYSTACK_PUBLIC_KEY'=> env('PAYSTACK_PUBLIC_KEY'),
        'PAYSTACK_SECRET_KEY'=> env('PAYSTACK_SECRET_KEY'),
        'PAYSTACK_PAYMENT_URL'=> env('PAYSTACK_PAYMENT_URL'),
        'PAYSTACK_MERCHANT_EMAIL'=> env('PAYSTACK_MERCHANT_EMAIL'),
        'PAYTM_ENVIRONMENT' => env('PAYTM_ENVIRONMENT'),
        'PAYTM_MERCHANT_ID' => env('PAYTM_MERCHANT_ID'),
        'PAYTM_MERCHANT_KEY' => env('PAYTM_MERCHANT_KEY'),
        'PAYTM_MERCHANT_WEBSITE' => env('PAYTM_MERCHANT_WEBSITE'),
        'PAYTM_CHANNEL' => env('PAYTM_CHANNEL'),
        'PAYTM_INDUSTRY_TYPE' => env('PAYTM_INDUSTRY_TYPE'),
        'NOCAPTCHA_SITEKEY' => env('NOCAPTCHA_SITEKEY'),
        'NOCAPTCHA_SECRET' => env('NOCAPTCHA_SECRET'),
      ];

      return view('admin.setting.api', compact('env_files', 'setting'));
  }

  public function changeEnvKeys(Request $request)
  {
      
      $input = $request->all();
      $setting = Setting::first();

      $env_update = $this->changeEnv([
        'STRIPE_KEY' => $input['STRIPE_KEY'],
        'STRIPE_SECRET' => $input['STRIPE_SECRET'],
        'PAYPAL_CLIENT_ID' => $input['PAYPAL_CLIENT_ID'],
        'PAYPAL_SECRET' => $input['PAYPAL_SECRET'],
        'PAYPAL_MODE' => $input['PAYPAL_MODE'],
        'IM_API_KEY'=> $input['IM_API_KEY'],
        'IM_AUTH_TOKEN'=> $input['IM_AUTH_TOKEN'],
        'IM_URL'=> $input['IM_URL'],
        'RAZORPAY_KEY' => $input['RAZORPAY_KEY'],
        'RAZORPAY_SECRET' => $input['RAZORPAY_SECRET'],
        'PAYSTACK_PUBLIC_KEY' => $input['PAYSTACK_PUBLIC_KEY'],
        'PAYSTACK_SECRET_KEY' => $input['PAYSTACK_SECRET_KEY'],
        'PAYSTACK_PAYMENT_URL' => $input['PAYSTACK_PAYMENT_URL'],
        'PAYSTACK_MERCHANT_EMAIL' => $input['PAYSTACK_MERCHANT_EMAIL'],
        'PAYTM_ENVIRONMENT' => $input['PAYTM_ENVIRONMENT'],
        'PAYTM_MERCHANT_ID' => $input['PAYTM_MERCHANT_ID'],
        'PAYTM_MERCHANT_KEY' => $input['PAYTM_MERCHANT_KEY'],
        'PAYTM_MERCHANT_WEBSITE' => $input['PAYTM_MERCHANT_WEBSITE'],
        'PAYTM_CHANNEL' => $input['PAYTM_CHANNEL'],
        'PAYTM_INDUSTRY_TYPE' => $input['PAYTM_INDUSTRY_TYPE'],
        'NOCAPTCHA_SITEKEY' => $input['NOCAPTCHA_SITEKEY'],
        'NOCAPTCHA_SECRET' => $input['NOCAPTCHA_SECRET'],
      ]);

      if(isset($request->stripe_check))
      {
        $setting->stripe_enable = "1";
      }else
      {
        $setting->stripe_enable = "0";
      }

      if(isset($request->paypal_check))
      {
        $setting->paypal_enable = "1";
      }else
      {
        $setting->paypal_enable = "0";
      }

      if(isset($request->instamojo_check))
      {
        $setting->instamojo_enable = "1";
      }else
      {
        $setting->instamojo_enable = "0";
      }

      if(isset($request->braintree_check))
      {
        $setting->braintree_enable = "1";
      }else
      {
        $setting->braintree_enable = "0";
      }

      if(isset($request->razor_check))
      {
        $setting->razorpay_enable = "1";
      }else
      {
        $setting->razorpay_enable = "0";
      }

      if(isset($request->paystack_check))
      {
        $setting->paystack_enable = "1";
      }else
      {
        $setting->paystack_enable = "0";
      }

      if(isset($request->paytm_check))
      {
        $setting->paytm_enable = "1";
      }else
      {
        $setting->paytm_enable = "0";
      }

      if(isset($request->captcha_check))
      {
        $setting->captcha_enable = "1";
      }else
      {
        $setting->captcha_enable = "0";
      }

      $setting->save();

      if($env_update) 
      {
        return back()->with('updated', 'Api settings has been saved');
      } 
      else 
      {
        return back()->with('deleted', 'Api settings could not be saved');
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

      }else{
        return false;
      }
    }
  }


}
