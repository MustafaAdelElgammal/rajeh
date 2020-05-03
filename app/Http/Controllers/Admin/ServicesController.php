<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\ServiceRequest;
use App\Models\Category;
use Alert;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Service $service)
    {
        $categories = Category::pluck('name_ar', 'id')->toArray();
        return view('admin.services.create', compact('service', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $input = $request->except('image');;
        if ($request->has('image')) {
            $image = saveImage($request->image, 'services');
            $input['image'] = $image;
        }
        $request->is_featured == 1 ?  $input['is_featured']=1 :  $input['is_featured']=0;

        $service = Service::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $categories = Category::pluck('name_ar', 'id')->toArray();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {


        $input = $request->except('image');

        if ($request->hasFile('image')) {
            deleteFile($service->image);
            $input['image'] = saveImage($request->image, 'services');
        }
        $request->is_featured == 1 ?  $input['is_featured']=1 :  $input['is_featured']=0;
        $service = $service->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if (is_null($service)) {
            return redirect()->back();
        }

        if ($service->image != null) {
            deleteFile($service->image);
        }

        $service->delete();
        return redirect()->route('services.index');
    }
}
