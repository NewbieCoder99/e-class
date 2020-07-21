<?php

namespace App\Http\Controllers;

use App\Allcountry;
use Illuminate\Http\Request;
use Session;
use App\Allstate;
use App\Country;
use DB;
use App\State;
use App\City;

class CountryController extends Controller
{
    public function index(Request $request)
    {
       
        $countries = Country::all();

        return view("admin.country.index",compact('countries'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Allcountry::all();
        return view("admin.country.add_country",compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $countries = Country::where('country_id', $request->country)->first();

        if($countries == NULL){


            $data = Allcountry::where('id', $request->country)->first();


            DB::table('countries')->insert(
                array(
                    'country_id'=> $data->id,
                    'iso'       => $data->iso,
                    'name'      => $data->name,
                    'nicename'  => $data->nicename,
                    'iso3'      => $data->iso3,
                    'numcode'   => $data->numcode,
                    'created_at'=> \Carbon\Carbon::now()->toDateTimeString(),
                )
            );

            session()->flash("success","Country Has Been Added !");
        }
        else{
            session()->flash("delete","Country already Exist !");
        }
                
        return redirect('admin/country');
            

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::findOrFail($id);
        $allcountry = Allcountry::all();
        return view("admin.country.edit",compact("countries", "allcountry"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $countries = Country::where('country_id', $request->country)->first();

        if($countries == NULL){


            $data = Allcountry::where('id', $request->country)->first();


            DB::table('countries')->where('id',$id)
            ->update([
               'country_id'=> $data->country_id,
               'iso'       => $data->iso,
               'name'      => $data->name,
               'nicename'  => $data->nicename,
               'iso3'      => $data->iso3,
               'numcode'   => $data->numcode,
             

            ]);

            session()->flash("success","Country Has Been Added !");
        }
        else{
            session()->flash("delete","Country already Exist !");
        }
                
        return redirect('admin/country');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $daa = new Country;
        $obj = $daa->findorFail($id);
        $value = $obj->delete();

        State::where('country_id', $obj->country_id)->delete();
        City::where('country_id', $obj->country_id)->delete();

        if($value){
            session()->flash("deleted","Country Has Been deleted");
            return redirect("admin/country");
        }
    }


    public function upload_info(Request $request) 
    {
        
        $id = $request['catId'];
        
        $country = Allcountry::findOrFail($id);
        $upload = State::where('country_id',$country->id)->pluck('name','state_id')->all();

        return response()->json($upload);
    }


    public function gcity(Request $request) 
    {

        $id = $request['catId'];

        $state = Allstate::findOrFail($id);
        return $upload = City::where('state_id',$state->id)->pluck('name','id')->all();

        return response()->json($upload);


        

    }

    


}
