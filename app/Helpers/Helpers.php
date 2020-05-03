<?php
use Illuminate\Container\Container;


//Json array response
function responseJson($status, $code, $msg, $data = null, $state = 200)
{
    $response = [
        'status' => (int)$status,
        'code' => (int)$code,
        'message' => $msg,
        'data' => $data,
    ];
    return response()->json($response, $state);
}

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array   $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }
        return Container::getInstance()->make($abstract, $parameters);
    }
}


function saveImage($file, $folder = '/')
{
    $fileName = date('YmdHis').'-'.$file->getClientOriginalName();
    $dest = public_path('uploads/' . $folder);
    $file->move($dest, $fileName);
    return 'uploads/' . $folder . '/' . $fileName;
}

//Delete Image
 function deleteFile($name)
{
    $file = public_path('/'.$name);
    if(file_exists($file))
    {
    File::delete($file);
    }
}

function saveImageBase64($image, $folder = '/', $filename = 'image')
{
    $type = "png";
    //get the base-64 from data
    //$base64_str = substr($request->image, strpos($request->image, ",")+1);
    $data = base64_decode($image);
    if ($data === false) {
        return "";// throw new \Exception('base64_decode failed');
    }
    $fileName =  date('YmdHis').'-'.$filename.'.'.$type;
    $dest = public_path('uploads/' . $folder);
    $path = 'uploads/' . $folder . '/' . $fileName;
    if (!is_dir(public_path('uploads/' . $folder ))) {
      // dir doesn't exist, make it
      mkdir(public_path('uploads/' . $folder));
    }
    file_put_contents($dest.'/'.$fileName, $data);
    return 'uploads/' . $folder . '/' . $fileName;
}

function routeActive($path, $active = 'active')
{
    return request()->routeIs($path) ? $active : '';
}

function urlActive($path, $active = 'active')
{
    return Request::is($path . '*') ? $active : '';
}

function switch_notify_message($notifiable_type){
    $message = '';

    switch ($notifiable_type) {
        case 'test':
            $message = "مرحبا بك في تطبيق الأبحاث";
            break;
        case 'order_sent':
            $message = "تم إرسال الطلب بنجاح";
            break;
        case 'new_message':
            $message = "لديك رسالة جديدة";
            break;
        case 'order_new':
            $message = "طلب جديد";
            break;
        case 'order_canceled':
            $message = "تم إلغاء الطلب";
            break;
        case 'order_accepted':
            $message = "تم قبول الطلب";
            break;
        case 'order_reminder':
            $message = "تذكير للطلب";
            break;
    }
    return $message;
}

function sendNotification( $user_id, $notifiable_id = 0, $notifiable_type, $type, $message='') {
    //
    $input_arr = [];
    if ($user_id == 0){
        $input_arr['user_type'] = 'admin';
    }else{
        $input_arr['user_type'] = 'client';
    }
    $input_arr['notifiable_type'] = $notifiable_type;
    $input_arr['notifiable_id'] = $notifiable_id;
    $input_arr['type'] = $type;
    $input_arr['message'] = $message;
    $input_arr['user_id'] = $user_id;

    $notification = \App\Models\UserNotification::create($input_arr);
    //
    if ($notification->id) {
    //     //send via firebase
        $notify_sent = firebasePushNotification($user_id, $type);
        return true;
    } else {
        return false;
    }
}

function firebasePushNotification( $user_id, $type) {
    //get user
    $user = \App\Models\Client::find($user_id);
    if (!empty($user) && isset($user->id)) {
        //get player or device id
        $tokenId = $user->device_id;
        if (empty($tokenId)) {
            return false;
        }
    } else {
        return false;
    }
    $notification_text = switch_notify_message($type);
    if (!empty($notification_text)) {
        $message = $notification_text;
    } else {
        $message = "";
    }
    //dump_exit(" MSG : ".$notify_obj);
    if (!defined('API_ACCESS_KEY')) {
        define('API_ACCESS_KEY', 'AAAAid5FKeE:APA91bFfn_Iob6L3veHU4G42fJxpaqEazZoHOp9Llf5MoGo5KoHFxo5EZZEF2dTGEoZjur-r4vpFjyWdPyTp0JG6L8xTYGXDkRjKJ503dv2DKPfOksQiNhVmAholWN73f1kWna6lo-ZO');
    }
    $registrationIds = array($tokenId);
    $title = " ";
    $msg = array(
        "to" => $tokenId,
        "notification" => array(
            "title" => $title,
            "body" => $message,
            "sound" => "default",
            "is_background" => FALSE,
        //"icon" => ci_site_url('assets/images/favicon.png')
        ),
        /*
          To send additional data
          "data" : {
          "volume" : "3.21.15",
          "contents" : "http://www.news-magazine.com/world-week/21659772"
          },
         */
        "priority" => "high",
    );
    $firebase_fields = array(
        'registration_ids' => $registrationIds,
        'data' => $msg
    );
    //dump_exit(json_encode( $firebase_fields ));
    $headers = array(
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
    $url = 'https://fcm.googleapis.com/fcm/send';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($msg));
    $result = curl_exec($ch);
    curl_close($ch);
    $result_obj = json_decode($result);
    //if(!empty($this->_debug_mode)) dump_exit($result_array);
    if (!empty($result_obj)) {
        return (!empty($result_obj->success)) ? true : false;
    } else {
        return $result;
    }
}

function getUnreadMsgsCount(){
    return \App\Messege::where('to_id', Auth::id())->where('read_at', null)->count();
}

