<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PromoCodeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promocode;
use Alert;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo_code = Promocode::all();
        return view('admin.promo_code.index', compact('promo_code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promo_code = Promocode::pluck('code','id')->toArray();
        return view('admin.promo_code.create',compact('promo_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoCodeRequest $request)
    {
        $input = $request->all();
        // dd($input);
        $promo_code = Promocode::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('promo_code.index');
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
    public function edit(Promocode $promo_code)
    {
        return view('admin.promo_code.edit', compact('promo_code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promocode $promo_code)
    {
        // dd($request->all());

        $input = $request->all();
         $promo_code = $promo_code->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('promo_code.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $promo_code = Promocode::find($id);
        if(is_null($promo_code))
        {
            return redirect()->back();
        }
        $promo_code->delete();
        return redirect()->route('promo_code.index');

    }    
}
