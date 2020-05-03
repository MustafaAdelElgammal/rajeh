<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\City;
use App\Models\News;
use App\Models\Provider;
use App\Models\Category;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Product;
use App\Models\ServiceProvider;
use App\Models\ProviderBranch;
use App\Models\UserNotification;
use App\Models\BuildingType;
use App\Models\Order;
use App\Models\OrderComment;
use App\Models\Image;
use App\Models\TimePeriod;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['home']]);
    }

    public function home()
    {
        $data['latestnews'] = News::orderBy('created_at','DESC')->take(5)->get()->makeHidden(['title_ar', 'title_en', 'body_ar', 'body_en']);

        $data['categories'] = Category::orderBy('created_at','DESC')->get()->makeHidden(['name_ar', 'name_en','desc_ar','desc_en']);

        $data['providers'] = Provider::orderBy('created_at','DESC')->take(4)->get()->makeHidden(['name_ar', 'name_en']);

        $data['featured'] = Category::where('is_featured',1)->orderBy('created_at','DESC')->take(2)->get()->makeHidden(['name_ar', 'name_en','desc_ar','desc_en']);

        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function latestnews()
    {
        $data['latestnews'] = News::get()->makeHidden(['title_ar', 'title_en','body_ar','body_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function notifications()
    {
        $data['notifications'] = UserNotification::where('user_type', 'client')->where('user_id',Auth::id())->where('is_read',0)->orderBy('created_at','DESC')->get();

        if (empty($data['notifications'])){
            return responseJson(0,402, __('api.back.nodata'));
        }

        return responseJson(1,200, __('api.back.success'), $data);

    }

    public function notificationsRead(Request $request)
    {
        $rules = [
            'notification_id' => 'required|numeric|exists:user_notifications,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $notification = UserNotification::find($request->notification_id);
        $notification->fill(['read_at' => Carbon::parse(), 'is_read' => 1]);
        $notification->update();

        $data['notifications'] = $notification;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function providers()
    {
        $data['providers'] = Provider::get()->makeHidden(['name_ar', 'name_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function getProvider(Request $request)
    {
        //
        $rules = [
            'provider_id' => 'required|integer|exists:providers,id'
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = $request->all();
        $data['provider'] = Provider::find($request->provider_id)->first();
        if(!empty($data['provider'])){
            $data['subservices'] = ServiceProvider::where('provider_id',$data['provider']['id'])->with('subservice')->get();
        }

        return responseJson(1,200, __('api.back.success'), $data);

    }

    public function providersByService(Request $request)
    {
        $rules = [
            'cat_id' => 'required|numeric|exists:categories,id',
            'service_id' => 'required|numeric|exists:services,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $service_providers = ServiceProvider::where('cat_id',$request->cat_id)->where('service_id',$request->service_id)->pluck('provider_id')->toArray();

        //Note: The provided distance is in Miles. If you need Kilometers, use 6371 instead of 3959.        
        $provider_branches = ProviderBranch::where('city_id',$request->city_id)->whereIN('provider_id',$service_providers)->select(DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( lat ) ) ) ) AS distance'))->orderBy('distance');
        
        $data['provider_branches'] = $provider_branches->with('provider')->get();

        // $data['providers'] = Provider::whereIN('id',$provider_branches->pluck('provider_id')->toArray())->get()->makeHidden(['name_ar', 'name_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function buildingTypes()
    {
        $data['buildingTypes'] = BuildingType::get()->makeHidden(['name_ar', 'name_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function subservicesByProviderID(Request $request)
    {
        $rules = [
            'provider_id' => 'required|numeric|exists:providers,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $service_providers = ServiceProvider::where('provider_id',$request->provider_id)->pluck('sub_service_id')->toArray();

        $data['subservices'] = SubService::whereIN('id',$service_providers)->get()->makeHidden(['name_ar', 'name_en','desc_ar','desc_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function productsByProviderID(Request $request)
    {
        $rules = [
            'provider_id' => 'required|numeric|exists:providers,id',
            'sub_service_id' => 'required|numeric|exists:sub_services,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $product_ids = ServiceProvider::where('provider_id',$request->provider_id)->where('sub_service_id',$request->sub_service_id)->pluck('product_id')->toArray();

        $data['products'] = Product::whereIN('id',$product_ids)->get()->makeHidden(['name_ar', 'name_en','desc_ar','desc_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function timePeriodsByProviderBranchID(Request $request)
    {
        $rules = [
            'provider_id' => 'required|numeric|exists:providers,id',
            'branch_id' => 'required|numeric|exists:providers_branches,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $data['time_periods'] = TimePeriod::where('provider_id',$request->provider_id)->where('provider_branch_id',$request->branch_id)->get();
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function search(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:3',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $data['providers'] = Provider::where('name_ar','LIKE','%'.$request->name.'%')->orWhere('name_en','LIKE','%'.$request->name.'%')->get()->makeHidden(['name_ar', 'name_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function newOrder(Request $request)
    {
        $rules = [
            'provider_id'       => 'required|numeric|exists:providers,id',
            'sub_service_id'    => 'required|numeric|exists:sub_services,id',
            'product_id'        => 'nullable|numeric|exists:products,id',
            'bulding_type_id'   => 'required|numeric|exists:building_types,id',
            'desc'              => 'nullable|string',
            'address'           => 'required|string',
            'lat'               => 'required|numeric',
            'lng'               => 'required|numeric',
            'time_period_id'    => 'required|numeric|exists:time_periods,id',
            'price'             => 'nullable|numeric',
            'tax'               => 'nullable|numeric',
            'delivery'          => 'nullable|numeric',
            'total'             => 'nullable|numeric',
            // 'status'            => 'required|string', 
            //['new','priced','accepted','working','done','rejected','canceled']
            // 'payment_type'      => 'required|string', //cash
            // 'reject_reason'     => 'nullable|string',,
            'images.*'          =>'nullable|file'
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->except('images'))->filter()->toArray();
        $requests['client_id'] = \Auth::id();
        $order = Order::create($requests);
        if($request->has('images')){
            $images = [];
            foreach ($request->images as $key=>$attachment_file) {
                $images[$key]['title'] = $attachment_file->getClientOriginalName();
                $images[$key]["path"] = saveImage($attachment_file,'images');
            }
            $images = $order->images()->createMany($images);
        }
        //
        $order->load('images');
        $order->refresh();
        $data['order'] = $order;

        // sendNotification('0',$order->id,'App\Models\Order','order_sent',switch_notify_message('order_new'));
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function editOrder(Request $request)
    {
        if($order->status == 'priced'){
            $msg = 'You Can\'t Edit Order after Pricing';
            return responseJson(1,200, __('api.back.success'), $msg);
        }else if ($order->status == 'accepted'){
            $msg = 'You Can\'t Edit Order after Accepted';
            return responseJson(1,200, __('api.back.success'), $msg);
        }else if ($order->status == 'working'){
            $msg = 'You Can\'t Edit Order while Working';
            return responseJson(1,200, __('api.back.success'), $msg);
        }else if($order->status == 'done'){
            $msg = 'You Can\'t Edit Order after Being Done';
            return responseJson(1,200, __('api.back.success'), $msg);
        }else if($order->status == 'rejected'){
            $msg = 'You Can\'t Edit Order after Rejection';
            return responseJson(1,200, __('api.back.success'), $msg);
        }else if($order->status == 'canceled'){
            $msg = 'You Can\'t Edit Order after Cancelation';
            return responseJson(1,200, __('api.back.success'), $msg);
        }
        //
        $rules = [
            'order_id'          => 'required|numeric|exists:orders,id',
            'provider_id'       => 'required|numeric|exists:providers,id',
            'sub_service_id'    => 'required|numeric|exists:sub_services,id',
            'product_id'        => 'nullable|numeric|exists:products,id',
            'bulding_type_id'   => 'required|numeric|exists:building_types,id',
            'desc'              => 'nullable|string',
            'address'           => 'required|string',
            'lat'               => 'required|numeric',
            'lng'               => 'required|numeric',
            'time_period_id'    => 'required|numeric|exists:time_periods,id',
            'price'             => 'nullable|numeric',
            'tax'               => 'nullable|numeric',
            'delivery'          => 'nullable|numeric',
            'total'             => 'nullable|numeric',
            // 'status'            => 'required|string', 
            //['new','priced','accepted','working','done','rejected','canceled']
            // 'payment_type'      => 'required|string', //cash
            // 'reject_reason'     => 'nullable|string',,
            'images.*'          =>'nullable|file'
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->except('images'))->filter()->toArray();
        // $requests['client_id'] = \Auth::id();
        $order = Order::update($requests);
        if($request->has('images')){
            $images = [];
            foreach ($request->images as $key=>$attachment_file) {
                $images[$key]['title'] = $attachment_file->getClientOriginalName();
                $images[$key]["path"] = saveImage($attachment_file,'images');
            }
            $images = $order->images()->createMany($images);
        }
        //
        $order->load('images');
        $order->refresh();
        $data['order'] = $order;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function deleteImage(Request $request)
    {
        $rules = [
            'image_id' => 'required|integer|exists:images,id',
            'order_id' => 'required|integer|exists:orders,id'
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        Image::destroy($request->image_id);

        $order = Order::findOrFail($request->order_id);

        if ($order != null) {
            $order->images()->where('id', $request->image_id)->delete();
            $order->load('images');
            $order->refresh();
            return responseJson(1, 200, __('api.delete.success'),$order);
        }

        return responseJson(1, 402, __('api.delete.error'));

    }

    public function cancelOrder(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer|exists:orders,id',
            'reject_reason' => 'required|string',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $requests = $request->all();
        $order = Order::findorfail($requests['order_id']);
        if ($order->status == 'new'){
            $order->canceled_by = \Auth::id();
            $order->canceled_by_type = 'client';
            $order->status = 'canceled';
            $order->reject_reason = $request->reject_reason;
            $order->update();
            $order->load('images');
            $order->refresh();
            // sendNotification('0',$order->id,'App\Models\Order','order_canceled',switch_notify_message('order_canceled'));
            return responseJson(1,200, __('api.back.success'), $order);
        }
        $msg = 'You Can\'t Cancel Order after Approved';
        return responseJson(0,402, $msg);
    }

    public function acceptOrder(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer|exists:orders,id',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $requests = $request->all();
        $order = Order::findorfail($requests['order_id']);
        $order->status = 'accepted';
        $order->update();
        $order->load('images');
        $order->refresh();
        // sendNotification('0',$order->id,'App\Models\Order','order_accepted',switch_notify_message('order_accepted'));
        return responseJson(1,200, __('api.back.success'), "true");

    }

    public function rejectOrder(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer|exists:orders,id',
            'reject_reason' => 'required|string',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $requests = $request->all();
        $order = Order::findorfail($requests['order_id']);
        if ($order->status == 'new'){
            $order->canceled_by = \Auth::id();
            $order->canceled_by_type = 'client';
            $order->status = 'rejected';
            $order->reject_reason = $request->reject_reason;
            $order->update();
            $order->load('images');
            $order->refresh();
            // sendNotification('0',$order->id,'App\Models\Order','order_canceled',switch_notify_message('order_canceled'));
            return responseJson(1,200, __('api.back.success'), $order);
        }
        $msg = 'You Can\'t Cancel Order after Approved';
        return responseJson(0,402, $msg);
    }

    public function getOrder(Request $request)
    {
        //
        $rules = [
            'order_id' => 'required|integer|exists:orders,id'
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = $request->all();
        $order = Order::where('id',$request->order_id)->with('images')->first()->makeHidden(['provider','sub_services','product','time_periods']);

        return responseJson(1,200, __('api.back.success'), $order);

    }

    public function getOrders(Request $request)
    {
        //
        $rules = [
            'status' => 'required'
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $requests = $request->all();
        $orders = Order::where('client_id',\Auth::id())->where('status',$requests['status'])->with('images')->get()->makeHidden(['provider','sub_services','product','time_periods']);
        // ->each(function ($i, $k) {
        //         $i->with('provider');
        //     });
        if (count($orders) == 0){
            return responseJson(1,200, __('api.back.success'), null);
        }
        return responseJson(1,200, __('api.back.success'), $orders);

    }

    public function getOrderComments(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $comments = OrderComment::where('order_id',$request->order_id)->get();
        if (count($comments) == 0){
            return responseJson(0,200, __('api.back.noComments'), null);
        }
        return responseJson(1,200, __('api.back.success'), $comments);

    }

    public function addComment(Request $request)
    {
        $rules = [
            'message' => 'required|string',
            'order_id'=> 'required|integer',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $order = Order::find($request->order_id);
        $requests = $request->all();
        $requests['from_id'] = \Auth::id();
        $requests['from_type'] = 'client';
        $requests['to_id'] = $order->provider_id;
        $requests['to_type'] = 'provider';
        $comment = OrderComment::create($requests);
        return responseJson(1,200, __('api.back.success'), $comment);
    }

}
