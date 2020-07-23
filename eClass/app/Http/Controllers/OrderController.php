<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;
use App\Setting;
use App\Course;
use App\User;
use Auth;
use Redirect;
use PDF;
use App\Currency;
use App\BundleCourse;
use Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('admin.order.create', compact('users', 'courses'));
    }

    public function store(Request $request)
    {
        $created_order = Order::create([
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'instructor_id' => $request->user_id,
            'payment_method' => 'Admin Enroll',
            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
            ]
        );

        Session::flash('success','Enrolled Successfully !');
        return redirect('order');
    }

    public function destroy($id)
    {
        DB::table('orders')->where('id',$id)->delete();
        return back();
    }

    public function vieworder($id)
    {
        $setting = Setting::first();
        $show = Order::where('id', $id)->first();
        return view('admin.order.view', compact('show', 'setting'));
    }

    public function purchasehistory()
    {
        $course = Course::all();
        $orders = Order::all();
        if(Auth::check())
        {
            return view('front.purchase_history.purchase',compact('orders', 'course'));
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.'); 
    }

    public function invoice($id)
    {
        $course = Course::all();
        $Bundle = BundleCourse::all();
        $orders = Order::where('id', $id)->first();

        $bundle_order = BundleCourse::where('id', $orders->bundle_id)->first();

        if(Auth::check())
        {
            return view('front.purchase_history.invoice',compact('orders', 'course', 'Bundle', 'bundle_order')); 
        }

        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.'); 
    }

    public function pdfdownload($id){
        $course = Course::all();
        $orders = Order::where('id', $id)->first();

        $bundle_order = BundleCourse::where('id', $orders->bundle_id)->first();

        $pdf = PDF::loadView('front.purchase_history.download', compact('orders','course', 'bundle_order'))->setPaper('a4', 'landscape');
        return $pdf->download('invoice.pdf');
        // return $pdf->stream();

    }

    
}
