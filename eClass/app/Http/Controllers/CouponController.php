<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Categories;
use App\Course;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupans = Coupon::orderBy('id','DESC')->get();
        return view("admin.coupan.index",compact("coupans"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::all();
        $product = Course::all();
        $coupon_code = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7);
        return view("admin.coupan.add",compact('coupon_code','category','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $newc = new Coupon;

        if($request->link_by == 'product'){
            $input['minamount'] = NULL;
        }else{
            $input['pro_id'] = NULL;
        }

        $newc->create($input);

        return redirect("coupon")->with("success","Coupan Has Been Created !");
    }

   

    public function show($id)
    {
        //
    }

   

    public function edit($id)
    {
        $coupan = Coupon::findOrFail($id);
        return view("admin.coupan.edit",compact("coupan"));
    }

   

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $newc = Coupon::find($id);

        if($request->link_by == 'product'){
            $input['minamount'] = NULL;
        }else{
            $input['pro_id'] = NULL;
        }

        $newc->update($input);

        return redirect("coupon")->with("success","Coupan Has Been Updated !");    
    }
   
    public function destroy($id)
    {
        $newc = Coupon::find($id);
        if(isset($newc)){
            $newc->delete();
            return back()->with('success','Coupon has been deleted');
        }else{
            return back()->with('delete','404 | Coupon not found !');
        }
    }
}
