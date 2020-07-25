<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PendingPayout;

class PayoutController extends Controller
{
    public function pending()
    {
    	$payout = PendingPayout::where('status', '0')->get();

    	return view('instructor.revenue.pending', compact('payout'));

    }
}
