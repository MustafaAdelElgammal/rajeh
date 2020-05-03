<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderBranch extends Model
{
    //
    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'providers_branches';

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
        'provider_id','country_id', 'city_id','address','lat','lng','mobile'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider','provider_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
}
