<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubService;
use Alert;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_services = SubService::pluck('name_ar', 'id')->toArray();
        return view('admin.products.create', compact('sub_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $input = $request->except('image');;
        if ($request->has('image')) {
            $image = saveImage($request->image, 'products');
            $input['image'] = $image;
        }
        $product = Product::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('products.index');
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
    public function edit(Product $product)
    {
        $sub_services = SubService::pluck('name_ar','id')->toArray();
        return view('admin.products.edit', compact('sub_services', 'product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
//        dd($request->all());
        $input = $request->except('image');

        if ($request->hasFile('image')) {
            deleteFile($product->image);
            $input['image'] = saveImage($request->image, 'products');
        }
        $input['is_featured']=$request->is_featured ? 1 : 0;
        $product = $product->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return redirect()->back();
        }

        if ($product->image != null) {
            deleteFile($product->image);
        }

        $product->delete();
        return redirect()->route('products.index');
    }
}
