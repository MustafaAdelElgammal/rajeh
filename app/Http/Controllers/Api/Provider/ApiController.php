<?php

namespace App\Http\Controllers\Api\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\UserNotification;
use App\Models\ProviderBranch;
use App\Models\Package;
use App\Models\ServiceProvider;
use App\Models\TimePeriod;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\PackagePayment;
use App\Models\Promocode;
use App\Models\Order;
use App\Models\OrderComment;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:proapi', ['except' => ['home']]);
    }

    public function notifications()
    {
        $data['notifications'] = UserNotification::where('user_type', 'provider')->where('user_id',Auth::id())->where('is_read',0)->orderBy('created_at','DESC')->get();

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

    public function branchNumber(Request $request)
    {
        $rules = [
            'branch_no' => 'required|numeric',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->all())->filter()->toArray();
        $provider = Auth::user()->fill($requests);
        $provider->save();
        $data['provider'] = $provider;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function newBranch(Request $request)
    {
        $rules = [
            'provider_id'   => 'required|numeric|exists:providers,id',
            'country_id'    => 'required|numeric|exists:countries,id',
            'city_id'       => 'required|numeric|exists:cities,id',
            'address'       => 'required|string',
            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
            'mobile'        => 'required|numeric',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->all())->filter()->toArray();
        $branch = ProviderBranch::create($requests);
        $branch->refresh();
        $data['branch'] = $branch;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function editBranch(Request $request)
    {
        $rules = [
            'branch_id'     => 'required|numeric|exists:providers_branches,id',
            'provider_id'   => 'required|numeric|exists:providers,id',
            'country_id'    => 'required|numeric|exists:countries,id',
            'city_id'       => 'required|numeric|exists:cities,id',
            'address'       => 'required|string',
            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
            'mobile'        => 'required|numeric',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->all())->filter()->toArray();
        $branch = ProviderBranch::find($request->branch_id)->fill($requests);
        $branch->save();
        $branch->refresh();
        $data['branch'] = $branch;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function deleteBranch(Request $request)
    {
        $rules = [
            'branch_id'   => 'required|numeric|exists:providers_branches,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $branch = ProviderBranch::find($request->branch_id);
        $branch->delete();
        
        return responseJson(1,200, __('api.back.success'), null);
    }

    public function packages()
    {
        $data['packages'] = Package::get()->makeHidden(['name_ar','name_en','desc_ar','desc_en']);
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function payPackage(Request $request)
    {
        $rules = [
            'package_id'            => 'required|numeric|exists:packages,id',
            'provider_id'           => 'required|numeric|exists:providers,id',
            // 'payment_id'            => 'required|numeric',
            'payment_type'          => 'required|string', //cash, online
            'promocode_id'          => 'nullable|numeric|exists:promocodes,id',
            'image'                 => 'sometimes|image', //if cash
            'notes'                 => 'sometimes|string', //if cash
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        if($request->payment_type == "cash"){
            $inputs = null;
            $inputs['package_id'] = $request->package_id;
            $inputs['provider_id'] = $request->provider_id;
            $inputs['image'] = $request->image;
            $inputs['notes'] = $request->notes;
            $inputs['is_confirmed'] = 0;
            $payment = Transaction::create($inputs);            
        }elseif($request->payment_type == "online"){
            //TO DO: Online Payfort Payment
            $inputs = null;
            $inputs['package_id'] = $request->package_id;
            $inputs['provider_id'] = $request->provider_id;
            $inputs['amount'] = $request->amount;
            $inputs['status'] = 'pending';
            $inputs['type'] = 'payment';
            $payment = Payment::create($inputs); 
        }

        if($request->has('promocode_id')){
            $promo_code = Promocode::findorfail($request->promocode_id);
            $used = $promo_code->used_number - 1;
            $promo_code->used_number= $used;
            $promo_code->update();
        }
        
        $requests = collect($request->except('image','notes'))->filter()->toArray();
        $requests['payment_id'] = $payment->id;
        $package = PackagePayment::create($requests);
        $package->refresh();
        $data['package'] = $package;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function newBranchService(Request $request)
    {
        $rules = [
            'provider_id'           => 'required|numeric|exists:providers,id',
            'provider_branch_id'    => 'required|numeric|exists:providers_branches,id',
            'service_id'            => 'required|numeric|exists:services,id',
            'cat_id'                => 'required|numeric|exists:categories,id',
            'sub_service_id'        => 'required|numeric|exists:sub_services,id',
            'product_id'            => 'nullable|numeric|exists:products,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->all())->filter()->toArray();
        $service = ServiceProvider::create($requests);
        $service->refresh();
        $data['service'] = $service;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function editBranchService(Request $request)
    {
        $rules = [
            'branch_service_id'     => 'required|numeric|exists:service_providers,id',
            'provider_id'           => 'required|numeric|exists:providers,id',
            'provider_branch_id'    => 'required|numeric|exists:providers_branches,id',
            'service_id'            => 'required|numeric|exists:services,id',
            'cat_id'                => 'required|numeric|exists:categories,id',
            'sub_service_id'        => 'required|numeric|exists:sub_services,id',
            'product_id'            => 'nullable|numeric|exists:products,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->all())->filter()->toArray();
        $service = ServiceProvider::find($request->branch_service_id)->fill($requests);
        $service->save();
        $service->refresh();
        $data['service'] = $service;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function deleteBranchService(Request $request)
    {
        $rules = [
            'branch_service_id'    => 'required|numeric|exists:service_providers,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $service = ServiceProvider::find($request->branch_service_id);
        $service->delete();
        
        return responseJson(1,200, __('api.back.success'), null);
    }

    public function newBranchTimePeriod(Request $request)
    {
        $rules = [
            'provider_id'           => 'required|numeric|exists:providers,id',
            'provider_branch_id'    => 'required|numeric|exists:providers_branches,id',
            'from'                  => 'required|string',
            'to'                    => 'required|string',
            'desc_ar'               => 'nullable|string',
            'desc_en'               => 'nullable|string',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->all())->filter()->toArray();
        $timeperiod = TimePeriod::create($requests);
        $timeperiod->refresh();
        $data['timeperiod'] = $timeperiod;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function editBranchTimePeriod(Request $request)
    {
        $rules = [
            'timeperiod_id'         => 'required|numeric|exists:time_periods,id',
            'provider_id'           => 'required|numeric|exists:providers,id',
            'provider_branch_id'    => 'required|numeric|exists:providers_branches,id',
            'from'                  => 'required|string',
            'to'                    => 'required|string',
            'desc_ar'               => 'nullable|string',
            'desc_en'               => 'nullable|string',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = collect($request->all())->filter()->toArray();
        $timeperiod = TimePeriod::find($request->timeperiod_id)->fill($requests);
        $timeperiod->save();
        $timeperiod->refresh();
        $data['timeperiod'] = $timeperiod;
        
        return responseJson(1,200, __('api.back.success'), $data);
    }

    public function deleteBranchTimePeriod(Request $request)
    {
        $rules = [
            'timeperiod_id'    => 'required|numeric|exists:time_periods,id',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $timeperiod = TimePeriod::find($request->timeperiod_id);
        $timeperiod->delete();
        
        return responseJson(1,200, __('api.back.success'), null);
    }

    public function checkPromoCode(Request $request)
    {
        $rules = [
            'promocode' => 'required|string',
            'package_id' => 'required|integer|exists:orders,id',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $promo_code = Promocode::where('code',$request->promocode)->first();
        if ($promo_code == null){
            return responseJson(0, 200, 'كود الخصم لا يعمل');
        }
        if($promo_code->used_number == 0){
            return responseJson(0, 200, 'كود الخصم منتهى');
        }
        $amount = $promo_code->amount;
        /////Package Not Order
        $package = Package::findorfail($request->package_id);
        if ($package->price != 0.0){
            $price = $package->price;
            $discount = $price * ($amount/100);
            $low_price = $price - $discount;
        }
        // $used = $promo_code->used_number - 1;
        // $promo_code->used_number= $used;
        // $promo_code->update();
        $object = (object)['price'=>$price ,'percentage'=>$amount,'discount'=>$discount,'price_after_discount'=>$low_price];
        return responseJson(1,200, __('api.back.success'), $object);
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
            $order->canceled_by_type = 'provider';
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
            'order_id'  => 'required|integer|exists:orders,id',
            'price'     => 'required|numeric',
            'tax'       => 'required|numeric',
            'delivery'  => 'required|numeric',
            'total'     => 'required|numeric',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $requests = $request->all();
        $order = Order::findorfail($requests['order_id']);
        $order->price = $requests['price'];
        $order->tax = $requests['tax'];
        $order->delivery = $requests['delivery'];
        $order->total = $requests['total'];
        $order->status = 'priced';
        $order->update();
        $order->load('images');
        $order->refresh();
        // sendNotification('0',$order->id,'App\Models\Order','order_accepted',switch_notify_message('order_accepted'));
        return responseJson(1,200, __('api.back.success'), "true");

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
        $orders = Order::where('provider_id',\Auth::id())->where('status',$requests['status'])->with('images')->get()->makeHidden(['provider','sub_services','product','time_periods']);
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
        $requests['from_type'] = 'provider';
        $requests['to_id'] = $order->client_id;
        $requests['to_type'] = 'client';
        $comment = OrderComment::create($requests);
        return responseJson(1,200, __('api.back.success'), $comment);
    }


}
