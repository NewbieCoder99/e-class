<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WidgetSetting;

class WidgetController extends Controller
{

    public function edit()
    {
    	$show = WidgetSetting::first();
      	return view('admin.widget.edit',compact('show'));
    }

    public function update(Request $request)
    {
    	$widget = WidgetSetting::first();

        $input = $request->all();

        if(isset($widget))
        {
            $widget->update($input);
        }
        else
        {
            $widget = WidgetSetting::create($input);
          
            $widget->save();
        }

        return back()->with('success','Updated Successfully');
    }

    public function destroy($id)
    {
    	$widget = WidgetSetting::findorfail($id);
        $widget->delete();

        return back()->with('delete','Deleted Successfully');
    }
}
