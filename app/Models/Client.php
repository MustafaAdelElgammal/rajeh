<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashPassword;
use App\Traits\HasMobileCode;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable implements JWTSubject
{
    //
    use HashPassword, HasMobileCode;

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'clients';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = ['name','mobile','mobile_code','password','country_id','city_id','address','lat','lng','image','avg_rate','device_token','mobile_verify_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'device_token', 'created_at', 'updated_at','deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'mobile_verify_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
//    public function CustmorSupport(){
//        return $this->belongsTo('App\Models\CustmorSupport','customer_support_id');
//    }
}
