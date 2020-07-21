<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Cart;
use Auth;

class CheckoutController extends Controller
{
    public function checkoutpage(Request $request)
    {
        // return $request;
    	$course = Course::all();
        $carts = Cart::where('user_id',Auth::User()->id)->get();

        $price_total = $request->price_total;
        $offer_total = $request->offer_total;
        $offer_percent = $request->offer_percent;
        $cart_total = $request->cart_total;


        return view('front.checkout',compact('course', 'carts','price_total','offer_total', 'offer_percent', 'cart_total'));
    }
}
