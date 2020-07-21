<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use DB;

class DemoController extends Controller
{
    public function index()
    {
    	 $name = Test::get();
    	return view('admin.test.index', compact('name'));
    }

    public function create()
    {
    	return view('admin.test.add');
    }

    public function store(Request $request)
    {
    	// return $request;

    	DB::table('tests')->insert(
            array(
                'name' => $request->name,
                'mobile'=> $request->mobile,
                'address'   => $request->address,
                'status' => $request->status,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
            )
        );

        return redirect('test');

    }
}
