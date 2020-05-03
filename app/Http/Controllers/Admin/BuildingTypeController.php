<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuildingType;
use Alert;
use App\Http\Requests\BuildingTypeRequest;

class BuildingTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildingType = BuildingType::all();
        return view('admin.buildingType.index',compact('buildingType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buildingType.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingTypeRequest $request)
    {
        $input = $request->all();
        $buildingType = BuildingType::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('buildingType.index');

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
    public function edit(BuildingType $buildingType)
    {
        return view('admin.buildingType.edit',compact('buildingType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingTypeRequest $request,BuildingType $buildingType)
    {
        $input = $request->all();
        $buildingType  = $buildingType->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('buildingType.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buildingType=BuildingType::find($id);
        $buildingType->delete();
        return redirect()->route('buildingType.index');

    }
}
