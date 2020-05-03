<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Http\Requests\packageRequest;
use Alert;
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view ('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.

     * @return \Illuminate\Http\Response
     */
    public function create(Package $package)
    {
        return view('admin.packages.create', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(packageRequest $request)
    {
        $input = $request->except('image');
        if ($request->has('image')) {
            $image = saveImage($request->image, 'packages');
            $input['image'] = $image;
        }
        $package = Package::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('packages.index');
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
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(packageRequest $request, Package $package)
    {
        $input = $request->except('image');
        if ($request->has('image')) {
            $image = saveImage($request->image, 'packages');
            $input['image'] = $image;
        }
        $packages = $package->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package= Package::find($id);
        if(is_null($package))
        {
            return redirect()->back();
        }
        $package->delete();
        return redirect()->route('packages.index');
    }
}
