<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Search;
use App\Question;

class SearchController extends Controller
{
    public function index(Request $request) 
    {
        $searchTerm = $request->input('searchTerm');

        if(isset($searchTerm))
        {
        	$courses = Course::search($searchTerm)->paginate(20);
        	return view('front.search', compact('courses', 'searchTerm'));
    	}
    	else
    	{
    		return back()->with('delete','No Search Value Found');
    	}
        
    }

   
}
