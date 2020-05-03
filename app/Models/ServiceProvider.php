<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'service_providers';

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
        'provider_id','provider_branch_id','service_id','cat_id','sub_service_id','product_id',
    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider','provider_id');
    }

    public function provider_branch()
    {
        return $this->belongsTo('App\Models\ProviderBranch','provider_branch_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service','service_id');
    }

    public function subservice()
    {
        return $this->belongsTo('App\Models\SubService','sub_service_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }

}
