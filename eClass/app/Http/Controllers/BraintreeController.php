<?php

namespace App\Http\Controllers;

use App\Config;
use App\Menu;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Braintree_Transaction;
use Braintree\MerchantAccount;
use Braintree_ClientToken;
use App\PaypalSubscription;
use Illuminate\Support\Carbon;
use Session;
use Validator;
use DB;
use App\Mail\SendInvoiceMailable;
use Braintree_Configuration;
use App\Cart;
use App\Wishlist;
use App\Order;
use App\Currency;
use App\Mail\SendOrderMail;
use App\Notifications\UserEnroll;
use App\Course;
use App\User;
use Notification;

class BraintreeController extends Controller
{

	public function __construct()
    {
        Braintree_Configuration::environment(env('BRAINTREE_ENV'));
        Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
    }

	public function payment(Request $request)
	{
		$customer = Auth::user();
		$currency = Currency::findOrFail(1)->currency;
		$account = env('BRAINTREE_MERCHANT_ACCOUNT_ID');
		$acc = MerchantAccount::find($account);

		if(isset($acc) && ($acc->currencyIsoCode == $currency)){
			$result = Braintree_Transaction::sale([
				'amount' =>  $request->amount,
				'paymentMethodNonce' => $request->payment_method_nonce,
				'merchantAccountId' => $account,
				'options' => [
						   'submitForSettlement' => True
							 ]
		  ]);
			

		if($result->success || !is_null($result->transaction)) {
			$txn = $result->transaction;
				if($txn->paymentInstrumentType == 'paypal_account'){
					$paypal = $txn->paypal;
				}


			$currency = Currency::first();

			$carts = Cart::where('user_id',Auth::User()->id)->get();
		   
		   	foreach($carts as $cart)
		   	{
		   		if ($cart->offer_price != 0)
	            {
	                $pay_amount =  $cart->offer_price;
	            }
	            else
	            {
	                $pay_amount =  $cart->price;
	            }
	                    
		        $created_order = Order::create([
		        	'course_id' => $cart->course_id,
		        	'user_id' => Auth::User()->id,
		        	'instructor_id' => $cart->courses->user_id,
		            'transaction_id' => isset($paypal) ? $paypal['paymentId'] : $txn->id,
		            'payment_method' => 'BrainTree',
		            'total_amount' => $pay_amount,
		            'currency' => $currency->currency,
		            'currency_icon' => $currency->icon,
		            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
		            ]
		        );
		        
		        Wishlist::where('user_id',Auth::User()->id)->where('course_id', $cart->course_id)->delete();

		        Cart::where('user_id',Auth::User()->id)->where('course_id', $cart->course_id)->delete();

		        if($created_order){
		        	if (env('MAIL_USERNAME')!=null) {
						try{
							
							/*sending email*/
							$x = 'You are successfully enrolled in a course';
							$order = $created_order;
							Mail::to(Auth::User()->email)->send(new SendOrderMail($x, $order));


						}catch(\Swift_TransportException $e){
							header( "refresh:5;url=./" );
							dd("Payment Successfully ! but Invoice will not sent because admin not updated the mail setting in admin dashboard ! Redirecting you to homepage... !");
						}
					}
				}

				if($created_order){
					// Notification when user enroll
			        $cor = Course::where('id', $cart->course_id)->first();

			        $course = [
			          'title' => $cor->title,
			          'image' => $cor->preview_image,
			        ];

			        $enroll = Order::where('course_id', $cart->course_id)->get();

			        if(!$enroll->isEmpty())
			        {
			            foreach($enroll as $enrol)
			            {
			                $user = User::where('id', $enrol->user_id)->get();
			                Notification::send($user,new UserEnroll($course));
			            }
			        }
				}

		    }


			return redirect('/')->with('success', 'Payment success !');
			
		} else {

			return redirect('/')->with('delete', 'Payment error occured. Please try again !');
		}


		
		}
	}

	public function get_bt()
	{
	  	$customer = Auth::User();

		if(!$customer->braintree_id){

			$response = \Braintree_Customer::create([

			   'id' => 'BT0'.$customer->id
			]);

			if($response->success) {

				$customer->braintree_id = $response->customer->id;
				$customer->save();
			}
		}

  		$client = Braintree_ClientToken::generate(["customerId" => $customer->braintree_id]);
		return response()->json(array('client' => $client));
	}



}
