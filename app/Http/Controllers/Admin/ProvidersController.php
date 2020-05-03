<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProviderRequest;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use Alert;

class ProvidersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Provider $provider)
    {
        $categories = Category::pluck('name_ar','id')->toArray();
        return view('admin.providers.create', compact('provider', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {

            $input = $request->except('image');
            if ($request->has('image')) {
                $image = saveImage($request->image, 'providers');
                $input['image'] = $image;
            }
            $provider = Provider::create($input);
            Alert::success('تم', 'تمت الاضافة بنجاح');
            return redirect()->route('providers.index');

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
    public function edit(Provider $provider )
    {
        $categories = Category::pluck('name_ar','id')->toArray();
        return view('admin.providers.edit', compact('provider', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $requests = $request->except('image');

                if ($request->has('image')) {
                    $image = saveImage($request->image, 'providers');
                    $requests['image'] = $image;
                }
                $requests['password'] = $request->password;
                $providers = $provider->update($requests);
                Alert::success('تم', 'تمت التعديل بنجاح');
                return redirect()->route('providers.index');



//            $input = $request->all();
//        dd($input);
//Provider::findOrFail($id)->fill($input)->save();
//        dd($requests);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider= Provider::find($id);
        if(is_null($provider))
        {
            return redirect()->back();
        }
        $provider->delete();
        return redirect()->route('providers.index');
    }
}
