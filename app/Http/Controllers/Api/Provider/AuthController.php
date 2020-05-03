<?php

namespace App\Http\Controllers\Api\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mail;
use JWTAuth;
use App\Models\Provider;
use App\Models\Setting;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:proapi', ['except' => ['register','login','forgetpassword','verification','resend_verification']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name_ar'               => 'required|string',
            'name_en'               => 'required|string',
            'mobile'                => 'required|unique:providers,mobile',
            'image'                 => 'sometimes|image|mimes:jpeg,bmp,png,jpg',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'cat_id'                => 'required|numeric',
            'workday_from'          => 'required|string',
            'workday_to'            => 'required|string',
            'trading_license'       => 'required|string',
            'device_token'          => 'sometimes|string',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $requests = $request->except('image');
        if ($request->has('image')) {
            $requests['image'] = saveImage($request->image, 'providers');
        }
        $provider = Provider::create($requests);
        $provider->refresh();

        //TO DO: SMS Verification Code
        // $mobile_code = strrev($user->mobile_code);
        // \jawalbsms::sendSMS(urlencode("كود التفعيل ".$user->mobile_code."التطبيق خاص للإيجارات والعقود الالكترونية ٠٠٩٦٦٥٣٥٣٨١٣١١"), $user->mobile);

        $credentials = $request->only('mobile', 'password');
        if (!$token = auth('proapi')->attempt($credentials)) {
            return responseJson(0, 402, __('api.login.error'));
        }
        $token = $this->generateUserToken($token);
        $data = ['provider' => $provider, 'token' => $token];

        return responseJson(1, 200, __('api.save.success'), $data);
    }

    public function login(Request $request)
    {
        $rules = [
            'mobile'    => 'required|exists:providers,mobile',
            'password' => 'required|min:6',
        ];
        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }

        $credentials = $request->only('mobile', 'password');
        $provider = Provider::where('mobile', $request->mobile)->first();
        if ($provider == null) {
            return responseJson(0, 402, __('api.login.provider not found'));
        }
        if (!$token = auth('proapi')->attempt($credentials)) {
            return responseJson(0, 402, __('api.login.wrong password'));
        }
        $token = $this->generateUserToken($token);
        $data = ['provider' => $provider, 'token' => $token];
        return responseJson(1, 200, __('api.login.success'), $data);
    }

    public function verification(Request $request)
    {
        $rules = [
            'mobile_code' => 'required|integer',
            'mobile'       => 'required|exists:providers,mobile',
        ];

        $validation = validator()->make($request->all(), $rules);
        if ($validation->fails()) {
            return responseJson(0, 402, $validation->errors()->first());
        }
        $provider = Provider::where('mobile', $request->mobile)
            ->where('mobile_code', $request->mobile_code)
            ->first();
        if ($provider == null) {
            return responseJson(0, 402, 'كود التفعيل غير صحيح');
        }
        $provider = $provider->fill(['mobile_verify_at' => Carbon::parse()]);
        $provider->update();
        if (!$token = auth('proapi')->login($provider, true)) {
            return responseJson(0, 402, __('api.login.wrong password'));
        }
        $token = $this->generateUserToken($token);
        $data = ['provider' => $provider, 'token' => $token];
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
        $provider = Provider::where('mobile',$request->mobile)->first();      
        if (!$provider) {
            return responseJson(0, 402, __('api.login.error'));
        }

        //TODO :: add message mobile verify
        // $mobile_code = strrev($user->mobile_code);
        // \jawalbsms::sendSMS(urlencode("كود التفعيل ".$provider->mobile_code."التطبيق خاص للإيجارات والعقود الالكترونية ٠٠٩٦٦٥٣٥٣٨١٣١١"), $provider->mobile);

        if (!$token = auth('proapi')->login($provider, true)) {
            return responseJson(0, 402, __('api.login.wrong password'));
        }
        $token = $this->generateUserToken($token);
        $data = ['provider' => $provider, 'token' => $token];
        return responseJson(1, 200, __('api.save.success'), $data);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('proapi')->logout();
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
        $provider = Provider::where('mobile', $request->mobile)->first();
        $provider->update(['password' => $new_password]);

        //TODO:: send sms with new password
        $new_password =  (string) $new_password;
        // \jawalbsms::sendSMS(urlencode("كلمة المرور الجديدة: ".$new_password) ,$user->mobile);

        $data = ['provider' => $provider,'new_password'=>$new_password];

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
            $requests['image'] = saveImage($request->image, 'users');
        }
        $provider = Auth::user()->fill($requests);
        $provider->save();
        $data = ['provider' => $provider];
        return responseJson(1, 200, __('api.updateProfile.success'), $data);
    }

}
