<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'orders';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id', 'sub_service_id', 'product_id', 'bulding_type_id',
        'desc', 'address', 'lat', 'lng', 'time_period_id', 'price', 'tax',
        'delivery', 'status', 'payment_type', 'reject_reason', 'client_id'
    ];

    protected $appends = ['provider_name','provider_mobile','sub_service_name','product_name','time_period_from','time_period_to'];

    public function provider(){
        return $this->belongsTo('App\Models\Provider', 'provider_id');
    }
    public function client(){
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
    public function getProviderNameAttribute()
    {
        $provider = $this->provider;
        if (app()->isLocale('ar')) {
            return $provider->name_ar;
        }
        return $provider->name_en;
    }

    public function getProviderMobileAttribute()
    {
        $provider = $this->provider;
        return $provider->mobile;
    }

    public function sub_services(){
        return $this->belongsTo('App\Models\SubService', 'sub_service_id');
    }

    public function getSubServiceNameAttribute()
    {
        $sub_services = $this->sub_services;
        if (app()->isLocale('ar')) {
            return $sub_services->name_ar;
        }
        return $sub_services->name_en;
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function getProductNameAttribute()
    {
        $product = $this->product;
        if($product){
            if (app()->isLocale('ar')) {
                return $product->name_ar;
            }
            return $product->name_en;
        }else{
            return '';
        }

    }

    public function time_periods(){
        return $this->belongsTo('App\Models\TimePeriod', 'time_period_id');
    }

    public function getTimePeriodFromAttribute()
    {
        $time_periods = $this->time_periods;
        return $time_periods->from;
    }

    public function getTimePeriodToAttribute()
    {
        $time_periods = $this->time_periods;
        return $time_periods->to;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }

}
