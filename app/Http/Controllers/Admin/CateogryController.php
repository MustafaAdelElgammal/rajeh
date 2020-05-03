<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Alert;

class CateogryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categroies=Category::all();
        return view('admin.categroies.index',compact('categroies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categroies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->except('image');;
        if($request->has('image')){
            $image = saveImage($request->image,'categroies');
            $input['image'] = $image;
        }
        $request->is_featured == 1 ?  $input['is_featured']=1 :  $input['is_featured']=0;

        $Category = Category::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('categroies.index');
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
    public function edit($id)
    {
        //dd($id);
        $category=Category::find($id);
        return view('admin.categroies.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $input = $request->except('image');
        $category=Category::find($id);
        if ($request->hasFile('image')) {
            deleteFile($category->image);
            $input['image'] = saveImage($request->image, 'categroies');
        }
        $request->is_featured == 1 ?  $input['is_featured']=1 :  $input['is_featured']=0;

        $category  = $category->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('categroies.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if(is_null($category))
        {
            return redirect()->back();
        }
        $category->delete();
        return redirect()->route('categroies.index');

    }
}
