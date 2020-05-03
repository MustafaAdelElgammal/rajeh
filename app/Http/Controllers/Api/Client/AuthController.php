<?php

namespace App\Http\Controllers\Api\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mail;
use JWTAuth;
use App\Models\Client;
use App\Models\Setting;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login','forgetpassword','verification','resend_verification']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|string',
            'mobile'                => 'required|unique:clients,mobile',
            'image'                 => 'sometimes|image|mimes:jpeg,bmp,png,jpg',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'country_id'            => 'required|numeric',
            'city_id'               => 'required|numeric',
            'address'               => 'required|string',
            'lat'                   => 'required|numeric',
            'lng'                   => 'required|numeric',
            'device_token'          => 'sometimes|string',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = $request->except('image');
        if ($request->has('image')) {
            $requests['image'] = saveImage($request->image, 'clients');
        }
        $client = Client::create($requests);
        $client->refresh();

        //TO DO: SMS Verification Code
        // $mobile_code = strrev($user->mobile_code);
        // \jawalbsms::sendSMS(urlencode("كود التفعيل ".$user->mobile_code."التطبيق خاص للإيجارات والعقود الالكترونية ٠٠٩٦٦٥٣٥٣٨١٣١١"), $user->mobile);

        $credentials = $request->only('mobile', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return responseJson(0, 402, __('api.login.error'));
        }
        $token = $this->generateUserToken($token);
        $data = ['client' => $client, 'token' => $token];

        return responseJson(1, 200, __('api.save.success'), $data);
    }

    public function login(Request $request)
    {
        $rules = [
            'email'    => 'required|exists:clients,email',
            'password' => 'required|min:8',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $credentials = $request->only('email', 'password');
        $client = Client::where('email', $request->email)->first();
//        return responseJson(1, 200, __('api.login.success'),$client);
        if ($client == null) {
            return responseJson(0, 402, __('api.login.client not found'));
        }
        if (!$token = auth('api')->attempt($credentials)) {
            return responseJson(0, 402, __('api.login.wrong password'));
        }
        $token = $this->generateUserToken($token);
        $data = ['client' => $client, 'token' => $token];
        return responseJson(1, 200, __('api.login.success'), $data);
    }

    public function verification(Request $request)
    {
        $rules = [
            'mobile_code' => 'required|integer',
            'mobile'       => 'required|exists:clients,mobile',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $client = Client::where('mobile', $request->mobile)
            ->where('mobile_code', $request->mobile_code)
            ->first();
        if ($client == null) {
            return responseJson(0, 402, 'كود التفعيل غير صحيح');
        }
        $client = $client->fill(['mobile_verify_at' => Carbon::parse()]);
        $client->update();
        if (!$token = auth('api')->login($client, true)) {
            return responseJson(0, 402, __('api.login.wrong password'));
        }
        $token = $this->generateUserToken($token);
        $data = ['client' => $client, 'token' => $token];
        return responseJson(1, 200, __('api.save.success'), $data);
    }

    public function resend_verification(Request $request)
    {
        $rules = [
            'mobile'       => 'required|string',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $client = Client::where('mobile',$request->mobile)->first();
        if (!$client) {
            return responseJson(0, 402, __('api.login.error'));
        }

        //TODO :: add message mobile verify
        // $mobile_code = strrev($user->mobile_code);
        // \jawalbsms::sendSMS(urlencode("كود التفعيل ".$client->mobile_code."التطبيق خاص للإيجارات والعقود الالكترونية ٠٠٩٦٦٥٣٥٣٨١٣١١"), $client->mobile);

        if (!$token = auth('api')->login($client, true)) {
            return responseJson(0, 402, __('api.login.wrong password'));
        }
        $token = $this->generateUserToken($token);
        $data = ['client' => $client, 'token' => $token];
        return responseJson(1, 200, __('api.save.success'), $data);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return responseJson(1, 200, __('api.logout'));
    }

    protected function generateUserToken($token)
    {
        /*$user = auth('api')->user();*/
        $tok = [];
        $tok['access_token'] = $token;
        $tok['token_type'] = 'bearer';
        // $tok['expires_in'] = auth('api')->factory()->getTTL() * 86400;
        return $tok;
    }

    public function refresh()
    {
        $client = Auth::user();
        $token = $this->generateUserToken(auth('api')->refresh());
        $data = ['client' => $client, 'token' => $token];
        return responseJson(1, 200, __('api.login.success'), $data);
    }

    public function forgetpassword(Request $request)
    {
        $rules = [
            'mobile' => 'required|exists:clients,mobile',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $new_password = mt_rand(10000000, 99999999);
        $client = Client::where('mobile', $request->mobile)->first();
        $client->update(['password' => $new_password]);

        //TODO:: send sms with new password
        $new_password =  (string) $new_password;
        // \jawalbsms::sendSMS(urlencode("كلمة المرور الجديدة: ".$new_password) ,$user->mobile);

        $data = ['client' => $client,'new_password'=>$new_password];

        return responseJson(1, 200, __('api.back.success'), $data);
    }

    public function editPassword(Request $request)
    {
        $rules = [
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'old_password'          => 'required|min:8',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $client = Auth::user();
        if ($client != null) {
            if ($request->password != '' && $request->old_password != '') {
                $password_hash = Hash::make($request->old_password);
                if (Hash::check($request->old_password, $password_hash) && Hash::check($request->old_password, $client->password)) {
                    $client->password = Hash::make($request->password);
                    $success = $client->update();
                    return responseJson(1, 200,__('api.user.updatePassword'), ['client' => $client,'password'=>$request->password]);
                } else {
                    return responseJson(0, 402, __('api.user.passwordNotMatch'));
                }
            }
        } else {
            return responseJson(0, 402, __('api.user.notFound'));
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        //
        $requests = collect($request->except('image'))->filter()->toArray();
        if ($request->has('image')) {
            $requests['image'] = saveImage($request->image, 'clients');
        }
        $client = Auth::user()->fill($requests);
        $client->save();
        $data = ['client' => $client];
        return responseJson(1, 200, __('api.updateProfile.success'), $data);
    }

}
