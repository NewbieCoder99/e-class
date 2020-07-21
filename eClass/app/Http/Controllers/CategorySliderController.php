<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategorySlider;
use App\Categories;

class CategorySliderController extends Controller
{
    public function show()
    {
    	$category = Categories::orderBy('position','ASC')->get();
    	$category_slider = CategorySlider::first();
    	return view('admin.category_slider.edit', compact('category', 'category_slider'));
    }

    public function update(Request $request)
    {

        $data = $this->validate($request, [
            'category_id' => 'required',
        ]);


        $cat = CategorySlider::first();

    	if(isset($cat))
        {
            $data = CategorySlider::first();
            $input = $request->all();
            $data->update($input);
        }
        else
        {
            $input = $request->all();
            $data = CategorySlider::create($input);
            $data->save();

        }
        return back()->with('message','Updated Successfully');
    }
}
