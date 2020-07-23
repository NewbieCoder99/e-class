<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactUsController extends Controller
{
	public function index()
	{
		$items = Contact::all();
    	return view('admin.contact.index',compact('items'));
	}

	public function edit($id)
	{
    	$show = Contact::where('id', $id)->first();
    	return view('admin.contact.view',compact('show'));
	}

	public function update(Request $request, $id)
	{
		$data = Contact::findorfail($id);
        $input = $request->all();
        $data->update($input);

		return redirect()->route('usermessage.index');
	}

	public function destroy($id)
	{
		Contact::where('id',$id)->delete();
        return redirect()->route('usermessage.index');
	}

    public function usermessage(Request $request)
    {
    	$data = $this->validate($request,[
            'user_id' => 'required',
            'fname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();
        $data = Contact::create($input);
        $data->save();
        
        return back()->with('success','Message send successfully!');
    }
}
