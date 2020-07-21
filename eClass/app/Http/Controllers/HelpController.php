<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaqStudent;
use App\FaqInstructor;

class HelpController extends Controller
{
    public function faqstudentpage($id)
    {

      	$data = FaqStudent::findorfail($id);

	  	return view('front.help.faq_detail',compact('data')); 
    }

    public function faqinstructorpage($id)
    {
    	
	  	$data = FaqInstructor::findorfail($id);

	  	return view('front.help.faq_detail',compact('data')); 
    }
}
