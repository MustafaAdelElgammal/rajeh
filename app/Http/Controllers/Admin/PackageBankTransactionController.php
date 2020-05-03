<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Provider;
use App\Models\Package;
use App\Http\Requests\PackageBankTransactionRequest;
use Alert;

class PackageBankTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();
        return view('admin.package_bank_transaction.index', compact('transaction'));
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
        return view('admin.package_bank_transaction.create', compact('providers', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageBankTransactionRequest $request)
    {
        $input = $request->except('image');;
        if ($request->has('image')) {
            $image = saveImage($request->image, 'package_transaction');
            $input['image'] = $image;
        }
        $transaction = Transaction::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('package_bank_transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        $packages = Package::pluck('name_ar', 'id')->toArray();
        return view('admin.package_bank_transaction.show', compact('transaction', 'providers', 'packages'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        $packages = Package::pluck('name_ar', 'id')->toArray();
        return view('admin.package_bank_transaction.edit', compact('transaction', 'providers', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageBankTransactionRequest $request, $id)
    {
        $transaction = Transaction::find($id);
        $input = $request->except('image');
        if ($request->hasFile('image')) {
            deleteFile($transaction->image);
            $input['image'] = saveImage($request->image, 'services');
        }
        $transaction = $transaction->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('package_bank_transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (is_null($transaction)) {
            return redirect()->back();
        }

        $transaction->delete();
        return redirect()->route('package_bank_transaction.index');
    }

    // confirm transaction request
    public function confirmTransaction(Request $request)
    {
        $transaction = Transaction::find($request->id);
        if ($transaction->is_confirmed == 0) {
            $transaction->is_confirmed = 1;
            $transaction->save();
            return 1;
        } else {
            $transaction->is_confirmed = 0;
            $transaction->save();
            return -1;
        }

    }
}
