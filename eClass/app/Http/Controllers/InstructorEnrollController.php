<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Course;
use Auth;

class InstructorEnrollController extends Controller
{
    public function index()
    {
        $orders = Order::where('instructor_id', Auth::User()->id)->get();
        return view('admin.order.index', compact('orders'));
    }
}
