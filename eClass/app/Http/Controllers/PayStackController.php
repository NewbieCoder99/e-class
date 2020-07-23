<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use DB;
use Auth;
use App\Cart;
use App\Wishlist;
use App\Order;
use App\Currency;
use Mail;
use App\Mail\SendOrderMail;
use App\Notifications\UserEnroll;
use App\Course;
use App\User;
use Notification;
use Carbon\Carbon;
use App\InstructorSetting;
use App\PendingPayout;

class PayStackController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();


        $paymentdata = $paymentDetails['data'];
       

        if($paymentDetails['status'] == 'true') {

			$currency = Currency::first();

			$carts = Cart::where('user_id',Auth::User()->id)->get();

		

            $pay_amount = 0;
		   
		   	foreach($carts as $cart)
		   	{  
		   		if ($cart->offer_price != 0 || $cart->offer_price != NULL)
	            {
	                $pay_amount =  $cart->offer_price;
	            }
	            else
	            {
	                $pay_amount =  $cart->price;
	            }

	            if ($cart->disamount != 0 || $cart->disamount != NULL)
	            {
	                $cpn_discount =  $cart->disamount;
	            }
	            else
	            {
	                $cpn_discount =  '';
	            }

                $lastOrder = Order::orderBy('created_at', 'desc')->first();

                if ( ! $lastOrder )
                {
                    // We get here if there is no order at all
                    // If there is no number set it to 0, which will be 1 at the end.
                    $number = 0;
                }
                else
                { 
                    $number = substr($lastOrder->order_id, 3);
                }

                if($cart->type == 1)
                {
                    $bundle_id = $cart->bundle_id;
                    $bundle_course_id = $cart->bundle->course_id;
                    $course_id = NULL;
                    $duration = NULL;
                    $instructor_payout = NULL;
                    $todayDate = NULL;
                    $expireDate = NULL;
                    $instructor_id = $cart->bundle->user_id;
                }
                else{

                    if($cart->courses->duration != NULL && $cart->courses->duration !='')
                    {
                        $days = $cart->courses->duration * 30;
                        $todayDate = date('Y-m-d');
                        $expireDate = date("Y-m-d", strtotime("$todayDate +$days days"));
                    }
                    else{
                        $todayDate = NULL;
                        $expireDate = NULL;
                    }

                    $setting = InstructorSetting::first();

                    if(isset($setting))
                    {
                        if($cart->courses->user->role == "instructor")
                        {
                            $x_amount = $pay_amount * $setting->instructor_revenue;
                            $instructor_payout = $x_amount / 100;
                        }
                        else
                        {
                            $instructor_payout = NULL;
                        }
                    }
                    else
                    {
                        $instructor_payout = NULL;
                    }

                    $bundle_id = NULL;
                    $course_id = $cart->course_id;
                    $bundle_course_id = NULL;
                    $duration = $cart->courses->duration;
                    $instructor_id = $cart->courses->user_id;
                }

		        $created_order = Order::create([
		        	'course_id' => $course_id,
		        	'user_id' => Auth::User()->id,
		        	'instructor_id' => $instructor_id,
		        	'order_id' => '#' . sprintf("%08d", intval($number) + 1),
		            'transaction_id' => $paymentdata['reference'],
		            'payment_method' => 'Paystack',
		            'total_amount' => $pay_amount,
		            'coupon_discount' => $cpn_discount,
		            'currency' => $paymentdata['currency'],
		            'currency_icon' => $currency->icon,
		            'duration' => $duration,
		            'enroll_start' => $todayDate,
                    'enroll_expire' => $expireDate,
                    'bundle_id' => $bundle_id,
                    'bundle_course_id' => $bundle_course_id,
		            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
		            ]
		        );
		        
		        Wishlist::where('user_id',Auth::User()->id)->where('course_id', $cart->course_id)->delete();

		        Cart::where('user_id',Auth::User()->id)->where('course_id', $cart->course_id)->delete();

		        if($created_order){

		        	if($cart->type == 0)
                    {

	                    if($cart->courses->user->role == "instructor")
	                    {

	                        $created_payout = PendingPayout::create([
	                            'user_id' => $cart->courses->user_id,
	                            'course_id' => $cart->course_id,
	                            'order_id' => $created_order->id,
	                            'transaction_id' => $paymentdata['reference'],
	                            'total_amount' => $pay_amount,
	                            'currency' => $currency->currency,
	                            'currency_icon' => $currency->icon,
	                            'instructor_revenue' => $instructor_payout,
	                            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
	                            'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
	                            ]
	                        );
	                    }
	                }

                }

		        if($created_order){
		        	if (env('MAIL_USERNAME')!=null) {
						try{
							
							/*sending email*/
							$x = 'You are successfully enrolled in a course';
							$order = $created_order;
							Mail::to(Auth::User()->email)->send(new SendOrderMail($x, $order));


						}catch(\Swift_TransportException $e){
							Session::flash('deleted','Payment Successfully ! but Invoice will not sent because of error in mail configuration !');
							return redirect('/');
						}
					}
				}


				if($cart->type == 0)
                {

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
		    }
        	

        	\Session::flash('success', 'Payment success');
		    return Redirect::route('home');
		}

		\Session::flash('delete', 'Payment failed');
		    return Redirect::route('home');
    }
}
