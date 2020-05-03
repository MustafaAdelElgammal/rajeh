<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\City;
use App\Models\News;
use App\Models\Provider;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Service;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['countries','cities','contact','terms','categories','servicesByCategoryID']]);
        $this->middleware('auth:api', ['except' => ['countries','cities','contact','terms','categories','servicesByCategoryID']]);
        $this->middleware('auth:proapi', ['except' => ['countries','cities','contact','terms','categories','servicesByCategoryID']]);
    }

    public function countries()
    {
        $data['countries'] = Country::get()->makeHidden(['name_ar', 'name_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function cities(Request $request)
    {
        $rules = [
            'country_id' => 'required|numeric|exists:countries,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $data['cities'] = City::where('country_id',$request->country_id)->get()->makeHidden(['name_ar', 'name_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function contact()
    {
        $data['settings'] = Setting::whereIn('key',['about_us','company_phone','company_website','company_email','facebook_url','twitter_url','instagram_url','snapchat_url'])->get()->makeHidden(['value_ar', 'value_en'])->pluck('value','key')->toArray();

        if (empty($data['settings'])){
            return responseJson(0,402, __('api.back.nodata'));
        }

        return responseJson(1,200, __('api.back.success'), $data);

    }

    public function terms()
    {
        $data['settings'] = Setting::where('key','terms')->get()->makeHidden(['value_ar', 'value_en'])->pluck('value','key')->toArray();

        if (empty($data['settings'])){
            return responseJson(0,402, __('api.back.nodata'));
        }

        return responseJson(1,200, __('api.back.success'), $data);

    }

    public function categories(Request $request)
    {
        $data['categories'] = Category::get()->makeHidden(['name_ar', 'name_en','desc_ar','desc_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function servicesByCategoryID(Request $request)
    {
        $rules = [
            'cat_id' => 'required|numeric|exists:categories,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $data['services'] = Service::where('cat_id',$request->cat_id)->get()->makeHidden(['name_ar', 'name_en','desc_ar','desc_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

}
