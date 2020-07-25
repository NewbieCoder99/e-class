<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PwaSettingController extends Controller
{
    public function index()
    {
    	$manifest = @file_get_contents(public_path().'/manifest.json');
        $swjs = @file_get_contents(public_path().'/sw.js');
    	return view('admin.pwasetting.show',compact('manifest','swjs'));
    }

    public function updatemanifest(Request $request){

    	$manifest = @file_put_contents(public_path().'/manifest.json', $request->manifest);
    	
    	return back()->with('success','Manifiest Setting Updated !');
    	
    }

    public function updatesw(Request $request){

    	$swjs = @file_put_contents(public_path().'/sw.js', $request->swupdate);
    	
    	return back()->with('success','Service Worker Updated !');
    	
    }

    public function updateicons(Request $request){

       if($file = $request->file('icon36x36'))
        {

            $name = 'icon36x36.png';
            $file->move('images/icons', $name);
        
        }

        if($file = $request->file('icon48x48'))
        {
            
            $name = 'icon48x48.png';
            $file->move('images/icons', $name);
        
        }

        if($file = $request->file('icon72x72'))
        {
            
            $name = 'icon72x72.png';
            $file->move('images/icons', $name);
        
        }

        if($file = $request->file('icon96x96'))
        {
            
            $name = 'icon96x96.png';
            $file->move('images/icons', $name);
        
        }

        if($file = $request->file('icon144x144'))
        {
            
            $name = 'icon144x144.png';
            $file->move('images/icons', $name);
        
        }

        if($file = $request->file('icon168x168'))
        {
            
            $name = 'icon168x168.png';
            $file->move('images/icons', $name);
        
        }

        if($file = $request->file('icon192x192'))
        {
            
            $name = 'icon192x192.png';
            $file->move('images/icons', $name);
        
        }

         if($file = $request->file('icon256x256'))
        {
            
            $name = 'icon256x256.png';
            $file->move('images/icons', $name);
        
        }

        return back()->with('success','Icons are updated !');
    }
}
