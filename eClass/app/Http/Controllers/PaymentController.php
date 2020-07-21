<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payout;
use App\User;
use App\Currency;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\CompletedPayout;
use App\PendingPayout;
use Auth;
use Session;


class PaymentController extends Controller
{
	  private $_api_context;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      /** PayPal api context **/
      $paypal_conf = \Config::get('paypal');
      $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
      $this
          ->_api_context
          ->setConfig($paypal_conf['settings']);
    }

    public function paypal(Request $request, $id)
    {

     $all_checked =  $request->checked;
      $pay_total =  $request->total;

      $user = User::where('id', $id)->first();


        if($user->prefer_pay_method == "paypal") 
        {
          	$amount = $request->total;

          	$user = User::where('id', $id)->first();

          	$sendemail = $user->paypal_email;
              $Currency = Currency::first();
              $defCurrency = $Currency->currency;
              $uniqid = str_random(10);
              $payouts = new Payout();
              // $inv_cus = Invoice::first();
              $senderBatchHeader = new PayoutSenderBatchHeader();
              $senderBatchHeader->setSenderBatchId(uniqid())
                  ->setEmailSubject("You have a Payout!");
              $senderItem = new PayoutItem();
              $senderItem->setRecipientType('Email')
                  ->setNote('Thanks for using our portal for selling your product!')
                  ->setReceiver($sendemail)
                  ->setSenderItemId($uniqid)
                  ->setAmount(new \PayPal\Api\Currency('{
                                      "value":'.$amount.',
                                      "currency":"'.$defCurrency.'"
                                  }'));
              $payouts->setSenderBatchHeader($senderBatchHeader)
                  ->addItem($senderItem);
              $request = clone $payouts;

              // return $request;

              try
              {
                  $output = $payouts->create(array('sync_mode' => 'false'), $this->_api_context);
                  $bid = $output->batch_header->payout_batch_id;
                  $response =  Payout::get($bid,$this->_api_context);

                  
                  $currency = Currency::first();
          
          
                  $orders = array();

                  foreach ($all_checked as $checked) {

                      $payout = PendingPayout::findOrFail($checked);

                      $orders[] = $payout->order->id;

                  }

                  $created_order = CompletedPayout::create([
                        'user_id' => $id,
                        'payer_id' => Auth::User()->id,
                        'pay_total' => $pay_total,
                        'order_id' =>  $orders,
                        'payment_method' => 'banktransfer',
                        'currency' => $currency->currency,
                        'currency_icon' => $currency->icon,
                        'pay_status' => 1,
                        'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                        ]
                    );

                    if($created_order){

                      foreach($all_checked as $checked) {

                          $payout = PendingPayout::findOrFail($checked);

                          
                          // PendingPayout::where('id', $checked)->delete();

                          PendingPayout::where('id', $checked)
                          ->update(['status' => '1']);

                      }

                    }

                   session()->flash('success','Payment Success');

                    return redirect('admin/instructor');
       

        			}
              catch(\Exception $e){

                $errorcode = $e->getCode();

                if($errorcode == 422){

                    Session::flash('delete','INSUFFICIENT FUNDS ! Check your paypal Account');
                    return view('admin/instructor');
                 }

                 if($errorcode == 400){

                    Session::flash('delete','Currency Not supported in paypal');
                    return view('admin/instructor');
                 }

                session()->flash('delete','Payment Failed');
                return redirect('admin/instructor');
          		}




        }


      }


      public function banktransfer(Request $request, $id)
      {

        $user = User::where('id', $id)->first();

        if($user->prefer_pay_method == "banktransfer") 
        {

          $currency = Currency::first();
          


          $orders = array();

          foreach ($request->checked as $checked) {

              $payout = PendingPayout::findOrFail($checked);

              $orders[] = $payout->order->id;

          }

          $created_order = CompletedPayout::create([
                'user_id' => $id,
                'payer_id' => Auth::User()->id,
                'pay_total' => $request->total,
                'order_id' =>  $orders,
                'payment_method' => 'banktransfer',
                'currency' => $currency->currency,
                'currency_icon' => $currency->icon,
                'pay_status' => 1,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                ]
            );

            if($created_order){

              foreach($request->checked as $checked) {

                  $payout = PendingPayout::findOrFail($checked);

                  
                  // PendingPayout::where('id', $checked)->delete();
                  PendingPayout::where('id', $checked)
                          ->update(['status' => '1']);

              }

            }

           session()->flash('success','Payment Success');

            return redirect('admin/instructor');
       

        }

      }

      public function paytm(Request $request, $id)
      {

        $user = User::where('id', $id)->first();

        if($user->prefer_pay_method == "paytm") 
        {

          $currency = Currency::first();

          $orders = array();

          foreach ($request->checked as $checked) {

              $payout = PendingPayout::findOrFail($checked);

              $orders[] = $payout->order->id;

          }
          

          $created_order = CompletedPayout::create([
                'user_id' => $id,
                'payer_id' => Auth::User()->id,
                'pay_total' => $request->total,
                'order_id' =>  $orders,
                'payment_method' => 'paytm',
                'currency' => $currency->currency,
                'currency_icon' => $currency->icon,
                'pay_status' => 1,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                ]
            );

            if($created_order){

              foreach($request->checked as $checked) {

                  $payout = PendingPayout::findOrFail($checked);

                  
                  // PendingPayout::where('id', $checked)->delete();
                  PendingPayout::where('id', $checked)
                          ->update(['status' => '1']);

              }

            }

           session()->flash('success','Payment Success');

            return redirect('admin/instructor');
       

        }

      }

       
}
