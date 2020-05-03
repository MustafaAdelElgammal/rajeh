<?php

namespace App\Http\Controllers\Admin;

use App\Models\BuildingType;
use App\Models\Product;
use App\Models\Provider;
use App\Models\SubService;
use App\Models\TimePeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserNotification;
use App\Models\OrderComment;
use Carbon\Carbon;


use Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        $sub_services = SubService::pluck('name_ar', 'id')->toArray();
        $time_periods = TimePeriod::pluck('from', 'id')->toArray();
        $building_types = BuildingType::pluck('name_ar', 'id')->toArray();
        $products = Product::pluck('name_ar', 'id')->toArray();
        return view('admin.orders.create', compact('providers', 'sub_services', 'time_periods', 'building_types', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $order = Order::create($input);
        Alert::success('تم', 'تمت الاضافة بنجاح');
        return redirect()->route('orders.index');    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order_id = $order->id;
        $notifications = UserNotification::where('notifiable_id',$order_id)->where('user_id',\Auth::id())->first();
//         dd($notifications);
        if($notifications){
            $notifications->read_at = Carbon::now();
            $notifications->update();
        }

        $comments = OrderComment::where('order_id',$order_id)->get();
        return view('admin.orders.single_order',compact('order','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $providers = Provider::pluck('name_ar', 'id')->toArray();
        $sub_services = SubService::pluck('name_ar', 'id')->toArray();
        $time_periods = TimePeriod::pluck('from', 'id')->toArray();
        $building_types = BuildingType::pluck('name_ar', 'id')->toArray();
        $products = Product::pluck('name_ar', 'id')->toArray();
        return view('admin.orders.edit', compact('order', 'providers', 'sub_services', 'time_periods', 'building_types', 'products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();


        $order = Order::find($id);
        $order = $order->update($input);
        Alert::success('تم', 'تمت التعديل بنجاح');
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            return redirect()->back();
        }
        $order->delete();
        return redirect()->route('orders.index');
    }

//    public function update(Request $request, Order $order)
//    {
//
//        $requests = $request->all();
//        if ($request->has('value')){
//            if ($requests['value'] == 'working'){
//                $order->status = 'working';
//                $order->update();
//                Alert::success('Success','Order Accepted');
//                sendNotification($requests['user_id'],$order->id,'App\Models\Order','order_accepted',switch_notify_message('order_accepted'));
//                return redirect()->back();
//            }
//        }
//        if($request->has('reject_reason')){
//            $order->status = 'canceled';
//            $order->canceled_by_type = 'admin';
//            $order->canceled_by = \Auth::id();
//            $order->reject_reason = $requests['reject_reason']['1'];
//            $order->update();
//            sendNotification($requests['user_id'],$order->id,'App\Models\Order','order_canceled',switch_notify_message('order_canceled'));
//            return 'true';
//        }
//        if ($request->has('price') && $request->has('due_date')){
//            $order->price = $requests['price'];
//            $order->due_date = $requests['due_date'];
//            $order->status = 'working';
//            $order->update();
//            Alert::success('Success','Price & Due Date Added Successfully');
//
//            sendNotification($requests['user_id'],$order->id,'App\Models\Order','order_accepted',switch_notify_message('order_accepted'));
//            return redirect()->route('orders.index');
//        }
//
//        Alert::error('Fail');
//        return redirect()->route('orders.index');
//    }

    public function search_upload(Request $request,Order $order)
    {
        $rules = array(
            'search'  => 'required|file|mimes:jpeg,bmp,png,jpg,pdf,txt,xls,docx,xlsx,zip|max:2024'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $requests = $request->except('search');
        if($request->has('search')){
            $search = saveImage($request->search,'search');
            $requests['search'] = $search;
            $file = $requests['search'];
            $order->status = 'done';
            $order->search = $file;
            $order->update();
        }
        $output = array(
            'success' => 'file uploaded successfully',
            'image'  => '<a href="'.asset($file).'" download><i class="fa fa-download"></i>  تحميل البحث  </a>'
        );

        return response()->json($output);

    }

}
