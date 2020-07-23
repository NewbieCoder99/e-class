<?php

namespace App\Http\Controllers;
use App\Course;
use App\Order;
use Auth;
use Redirect;
use PDF;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function show($id)
    {
        $order = Order::where('course_id', $id)->first();
    	$course = Course::where('id', $id)->first();
    	return view('front.certificate.certificate', compact('course', 'order'));
    }

    public function pdfdownload($id)
    {
    	$course = Course::where('id', $id)->first();
        $orders = Order::where('course_id', $id)->first();
        $pdf = PDF::loadView('front.certificate.download', compact('orders','course'))->setPaper('a4', 'landscape');
        return $pdf->download('certificate.pdf');
        // return $pdf->stream();
    }
}
