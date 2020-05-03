<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashPassword;
use App\Traits\HasMobileCode;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Authenticatable implements JWTSubject
{
    //
    use HashPassword, HasMobileCode;

    protected  $table = 'providers';

    protected  $fillable = ['name_ar','name_en','mobile','mobile_code','password','cat_id','workday_from','workday_to','trading_license','image','avg_rate','device_token','mobile_verify_at','branch_no'];

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

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function orders()
    {
        return $this->hasMany('App\Order');
    }
  
    public function categories(){
        return $this->belongsTo('App\Models\Category','cat_id');
    }

}
