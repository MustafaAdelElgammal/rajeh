<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use Alert;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=News::all();
        return view('admin.news.index',compact('news'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $input = $request->except('image');;

        if($request->has('image')){
            $image = saveImage($request->image,'news');
            $input['image'] = $image;
        }
        $News = News::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('news.index');

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
    public function edit(News $news)
    {
        return view('admin.news.edit',compact('news'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request,News $news)
    {
        $input = $request->except('image');
        
        if ($request->hasFile('image')) {
            deleteFile($news->image);
            $input['image'] = saveImage($request->image, 'news');
        }
  
        $news  = $news->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('news.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news=News::find($id);
        if(is_null($news))
        {
            return redirect()->back();
        }
        deleteFile($news->image);
        $news->delete();
        return redirect()->route('news.index');
 
    }
}
