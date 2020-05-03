<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubService;
use App\Http\Requests\subServiceRequest;
use App\Models\Service;
use Alert;

class SubServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subServices = SubService::all();
        return view('admin.sub_services.index', compact('subServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SubService $sub_service)
    {
        $services = Service::pluck('name_ar','id')->toArray();
        return view('admin.sub_services.create', compact('sub_service', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubServiceRequest $request)
    {
        $input = $request->except('image');;
        if ($request->has('image')) {
            $image = saveImage($request->image, 'sub_services');
            $input['image'] = $image;
        }
        $subService = SubService::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('sub_services.index');
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
    public function edit(SubService $sub_service)
    {
        $services = Service::pluck('name_ar','id')->toArray();
        return view('admin.sub_services.edit', compact('sub_service', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubService $sub_service)
    {
         $input = $request->except('image');

        if ($request->hasFile('image')) {
            deleteFile($sub_service->image);
            $input['image'] = saveImage($request->image, 'sub_services');
        }
        $input['is_featured']=$request->is_featured ? 1 : 0;
        $sub_service = $sub_service->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('sub_services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_service = SubService::find($id);
        if (is_null($sub_service)) {
            return redirect()->back();
        }

        if ($sub_service->image != null) {
            deleteFile($sub_service->image);
        }

        $sub_service->delete();
        return redirect()->route('sub_services.index');
    }
}
