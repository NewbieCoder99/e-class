<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{

    public function show()
    {

    	$show = Currency::first();
    	return view('admin.currency.edit',compact('show'));
    }

    public function update(Request $request)
    {

    	$data = Currency::first();
        $input = $request->all();

        if(isset($data))
        {
            $data->update($input);
        }
        else
        {
            $data = Currency::create($input);
            $data->save();
        }

		return back()->with('success','Updated Successfully');
    }

    
}
