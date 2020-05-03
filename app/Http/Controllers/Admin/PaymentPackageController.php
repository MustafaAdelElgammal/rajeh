<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Payment;
use App\Models\Promocode;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
use App\Models\PackagePayment;

class PaymentPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_packages = PackagePayment::all();
        return view('admin.payment_package.index', compact('payment_packages'));
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
        $payments = Payment::pluck('id')->toArray();
        $promo_codes = Promocode::pluck('code', 'id')->toArray();
        return view('admin.payment_package.create', compact('providers', 'packages', 'payments', 'promo_codes'));
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
        $package_payment = PackagePayment::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('payment-packages.index');    }

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
        $packagePayment = PackagePayment::find($id);
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        $packages = Package::pluck('name_ar', 'id')->toArray();
        $payments = Payment::pluck('id')->toArray();
        $promo_codes = Promocode::pluck('code', 'id')->toArray();
        return view('admin.payment_package.edit', compact('packagePayment', 'providers', 'packages', 'payments', 'promo_codes'));

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
        $package_payment = PackagePayment::find($id);
        $package_payment = $package_payment->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('payment-packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package_payment = PackagePayment::find($id);
        $package_payment->delete();
        return redirect()->route('payment-packages.index');

    }
}
