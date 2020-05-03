<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityRequest;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Alert;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index',compact('cities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name_ar','id')->toArray();
        return view('admin.cities.create',compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $input = $request->all();
        $City = City::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('cities.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::pluck('name_ar','id')->toArray();
        return view('admin.cities.edit',compact('countries','city'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request,City $city)
    {
        $input = $request->all();
        $clients  = $city->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('cities.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city=City::find($id);
        if(is_null($city))
        {
            return redirect()->back();
        }
        $city->delete();
        return redirect()->route('cities.index');

    }
}
