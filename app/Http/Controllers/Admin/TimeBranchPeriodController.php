<?php

namespace App\Http\Controllers\Admin;

use App\Models\Provider;
use App\Models\ProviderBranch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
use App\Models\TimePeriod;

class TimeBranchPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time_periods = TimePeriod::all();
        return view('admin.time_periods.index', compact('time_periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::pluck('name_ar')->toArray();
        $provider_branches = ProviderBranch::pluck('address');
        return view('admin.time_periods.create', compact('providers', 'provider_branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $provider_branch = TimePeriod::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect('dashboard/branch_period_time');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($branch_id)
    {
        $branch_all = ProviderBranch::find($branch_id);
        $provider_id = $branch_all->provider_id;
        $time_period = TimePeriod::where('provider_branch_id',$branch_id)->get();
        if (empty($time_period->first()))
            return view('admin.time_periods.create', compact('branch_id', 'provider_id'));

        return view('admin.time_periods.show', compact('time_period', 'branch_id', 'provider_id'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $time_period = TimePeriod::find($id);
        $providers = Provider::pluck('name_ar')->toArray();
        $provider_branches = ProviderBranch::pluck('address');
        return view('admin.time_periods.edit', compact('time_period','providers', 'provider_branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
//        dd($input);
        $time_period = TimePeriod::find($id);
        $time_period = $time_period->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('branch_period_time.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
