<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class TabController extends Controller
{
    public function show($id){
    	$cate = $id;
    	return view('tabs',compact('cate'));
    }
}
