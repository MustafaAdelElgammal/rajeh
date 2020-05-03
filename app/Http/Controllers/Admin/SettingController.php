<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        return view('admin.settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $rules = [
            'value_ar' => 'required|string',
            'value_en' => 'required|string',
        ];
        if ($setting->type == 'number') {
            $rules = [
                'value_ar' => 'required|numeric',
                'value_en' => 'required|numeric',
            ];
        } elseif ($setting->type == 'text') {
            $rules = [
                'value_ar' => 'required|string|max:191',
                'value_en' => 'required|string|max:191',
            ];
        } elseif ($setting->type == 'email') {
            $rules = [
                'value_ar' => 'required|email|max:191',
                'value_en' => 'required|email|max:191',
            ];
        } elseif ($setting->type == 'file') {
            $rules = [
                'value_ar' => 'required|image',
                'value_en' => 'required|image',
            ];
        } elseif ($setting->type == 'map') {
            $rules = [
                'lat' => 'required|numeric',
                'lng' => 'required|numeric'
            ];
        } elseif ($setting->type == 'select') {
            $rules = [
                'value_ar' => 'required|max:191',
                'value_en' => 'required|max:191',
            ];
        }
        $requests = $request->validate($rules);
        if (in_array($setting->type, ['number', 'email',  'select'])) {
            $requests['value_ar'] = $request->value_ar;
            $requests['value_en'] = $request->value_en;
        } elseif ($setting->type == 'map') {
            $value = serialize($requests);
            $requests = ['value_ar' => $value, 'value_en' => $value];
        } elseif ($setting->type == 'file') {
            $requests['value_ar'] = $requests['value_en'] = saveImage($request->file('value_ar'), 'settings');
        }
        $setting->fill($requests)->save();
        Alert::success('Success', 'Setting has been Updated.');
        return redirect()->route('settings.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
