<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimePeriod extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'time_periods';

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
        'provider_id','provider_branch_id','from','to','desc_ar','desc_en',
    ];

    public function providers()
    {
        return $this->belongsTo('App\Models\Provider','provider_id');
    }

    public function branch(){
        return $this->belongsTo('App\Models\ProviderBranch','provider_branch_id');

    }

}
