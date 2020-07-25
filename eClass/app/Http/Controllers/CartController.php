<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Cart;
use App\Course;
use App\Wishlist;
use Session;
use App\Coupon;
use Illuminate\Support\Facades\App;
use App\Adsense;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        
        return view('admin.cart.index', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::findorfail($id);
        $cart->delete();

        return back()->with('delete','Course is removed from your cart');
    }

    public function addtocart(Request $request)
    {

        $cart = Cart::where('user_id', Auth::User()->id)->where('course_id', $request->course_id)->first();

        if(!empty($cart)){

            return back()->with('delete','Item is already in your cart');
        }
        else {
            
            DB::table('carts')->insert(
            array(

            'user_id' => Auth::User()->id,
            'course_id' => $request->course_id,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer_price' => $request->discount_price,
            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),

            )
        );


        return back()->with('success','Course is added to your cart !');
        }

    	
    }

    public function removefromcart($id)
    {
        $cart = Cart::findorfail($id);
        $cart->delete();

        return back()->with('delete','Course is removed from your cart');
    }

    public function cartpage(Request $request)
    {

        $coupanapplieds = Session::get('coupanapplied');
        if(empty($coupanapplieds) == true ){
                 
            Cart::where('user_id', Auth::user()
                        ->id)
                        ->update(['distype' => NULL, 'disamount' => NULL]);

        }

        $wishlist = Wishlist::all();
        $course = Course::all();
        $carts = Cart::where('user_id', Auth::User()->id)->get();

        $ad = Adsense::first();

       
        
        $cartitems = Cart::where('user_id', Auth::User()->id)->first();
        if ($cartitems == NULL){

            //when cart empty 
            return view('front.cart',compact('course', 'carts', 'wishlist', 'ad'));

            
           
        }
        else {

            $price_total = 0;
            $offer_total = 0;
            $cpn_discount = 0;


            //cart price after offer
            foreach ($carts as $key => $c)
            {
                if ($c->offer_price != 0)
                {
                    $offer_total = $offer_total + $c->offer_price;
                }
                else
                {
                    $offer_total = $offer_total + $c->price;
                }
            }

            //for price total
            foreach ($carts as $key => $c)
            {
                
                $price_total = $price_total + $c->price;
                
            }


            //for coupon discount total
            foreach ($carts as $key => $c)
            {
                
                $cpn_discount = $cpn_discount + $c->disamount;
            }


            $cart_total = 0;
            
            foreach ($carts as $key => $c)
            {

                if ($cpn_discount != 0)
                {
                    $cart_total = $offer_total - $cpn_discount;
                }
                else{

                    $cart_total = $offer_total;
                }
            }


            //for offer percent
            foreach ($carts as $key => $c)
            {
                if ($cpn_discount != 0)
                {
                    $offer_amount  = $price_total - ($offer_total - $cpn_discount);
                    $value         =  $offer_amount / $price_total;
                    $offer_percent = $value * 100;
                }
                else
                {
                    $offer_amount  = $price_total - $offer_total;
                    $value         =  $offer_amount / $price_total;
                    $offer_percent = $value * 100; 
                }
            }
            

        }
        

        return view('front.cart',compact('course', 'carts', 'wishlist','offer_total','price_total', 'offer_percent', 'cart_total', 'cpn_discount', 'ad'));
       
    }
   
    
}
