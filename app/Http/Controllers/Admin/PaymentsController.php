<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Alert;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        $packages = Package::pluck('name_ar', 'id')->toArray();
        return view('admin.payments.create', compact('providers', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $input = $request->all();
        $payment = Payment::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('payments.index');
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
    public function edit(Payment $payment)
    {
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        $packages = Package::pluck('name_ar', 'id')->toArray();
        return view('admin.payments.edit', compact('providers', 'packages', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $input = $request->all();
        $payments  = $payment->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment= Payment::find($id);
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
