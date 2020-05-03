<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\City;
use App\Models\Country;
use Alert;

class ClientsController extends Controller
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
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name_ar', 'id')->toArray();
        $citys = City::pluck('name_ar', 'id')->toArray();

        return view('admin.clients.create', compact('countries', 'citys'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        if ($request->password !== $request->re_password) {
            return redirect()->back();
        }
        $input = $request->except('image');;
        if ($request->has('image')) {
            $image = saveImage($request->image, 'clients');
            $input['image'] = $image;
        }

//        dd($input);

        $Client = Client::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('clients.index');
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
    public function edit(client $client)
    {
        $countries = Country::pluck('name_ar', 'id');
        $citys = City::pluck('name_ar', 'id')->toArray();
        $country = Country::select('name_ar')->whereId($client->country_id)->first();
        $city = Country::select('name_ar')->whereId($client->city_id)->first();
        return view('admin.clients.edit', compact('countries', 'citys', 'client', 'country', 'city'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
//        dd($request->all());
        if ($request->password === $request->re_password) {
            $input = $request->except('image');

            if ($request->hasFile('image')) {
                deleteFile($client->image);
                $input['image'] = saveImage($request->image, 'clients');
            }
            $clients = $client->update($input);
            Alert::success('تم', 'تمت التعديل بنجاح');
            return redirect()->route('clients.index');
        } else {
            Alert::error('خطأ', 'تأكيد كلمة المرور غير متطابقة');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if (is_null($client)) {
            return redirect()->back();
        }

        if ($client->image != null) {
            deleteFile($client->image);
        }

        $client->delete();
        return redirect()->route('clients.index');
    }
}
