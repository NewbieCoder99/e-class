<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankTransfer;
use App\Order;
use Redirect,Response;
use App\Cart;
use Auth;
use DB;
use App\Currency;
use Session;
use App\Wishlist;
use Mail;
use App\Mail\SendOrderMail;
use App\Notifications\UserEnroll;
use App\Course;
use App\User;
use Notification;
use Carbon\Carbon;
use App\InstructorSetting;
use App\PendingPayout;

class BankTransferController extends Controller
{
    public function banktransfer(Request $request)
    {
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

                if($file = $request->file('proof'))
                {
                    $name = time().$file->getClientOriginalName();
                    $file->move('images/order', $name);
                    $input['proof'] = $name;
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
                'transaction_id' => str_random(32),
                'payment_method' => 'BankTransfer',
                'total_amount' => $pay_amount,
                'coupon_discount' => $cpn_discount,
                'currency' => $currency->currency,
                'currency_icon' => $currency->icon,
                'duration' => $duration,
                'enroll_start' => $todayDate,
                'enroll_expire' => $expireDate,
                'status' => 0,
                'bundle_id' => $bundle_id,
                'bundle_course_id' => $bundle_course_id,
                'proof' => $name,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                ]
            );



            $created_order->save();



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
                            'transaction_id' => $created_order->transaction_id,
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
            return Redirect::route('/');
        
    }

    public function show()
    {
        $show = BankTransfer::first();
        return view('admin.bank_transfer.edit',compact('show'));
    }

    public function update(Request $request)
    {

        $data = BankTransfer::first();
        $input = $request->all();

        if(isset($data))
        {
            if(isset($request->bank_enable)){
              	$data->bank_enable = 1;
            }else{
            	$data->bank_enable = 0;
            }

            $data->save();
            $data->update($input);
        }
        else
        {

            if($request->bank_enable == 'on')
            {
                $input['bank_enable'] = '1';
            }
            else
            {
                $input['bank_enable'] = '0';
            }
            
            
            $data = BankTransfer::create($input);
          
            $data->save();
        }

        return back()->with('success','Updated Successfully');
    }


}
