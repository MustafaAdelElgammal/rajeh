<?php

namespace App\Http\Controllers\Admin;

use App\Models\TimePeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProviderBranch;
use App\Http\Requests\ProviderBranchRequest;
use Alert;
use App\Models\Provider, App\Models\Country, App\Models\City;

class ProviderBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers_branches = ProviderBranch::all();
        return view('admin.providers_branches.index', compact('providers_branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name_ar', 'id')->toArray();
        $cities = City::pluck('name_ar', 'id')->toArray();
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        return view('admin.providers_branches.create', compact('countries', 'cities', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $provider_branch = ProviderBranch::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('providers_branches.index');
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
    public function edit($id)
    {
        $providerBranch = ProviderBranch::find($id);
        $countries = Country::pluck('name_ar', 'id')->toArray();
        $cities = City::pluck('name_ar', 'id')->toArray();
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        return view('admin.providers_branches.edit', compact('providerBranch', 'countries', 'cities', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderBranchRequest $request, $id)
    {
        $providerBranch = ProviderBranch::find($id);

        $input = $request->all();
        $providerBranch = $providerBranch->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('providers_branches.index');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $providerBranch = ProviderBranch::find($id);
        if (is_null($providerBranch)) {
            return redirect()->back();
        }
        $providerBranch->delete();
        return redirect()->route('providers_branches.index');
    }
}
