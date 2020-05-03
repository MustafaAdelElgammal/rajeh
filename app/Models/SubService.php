<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'sub_services';

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
        'service_id','name_ar', 'name_en','image','desc_ar','desc_en','is_featured'
    ];
    
    protected $appends = ['name','desc'];

    public function getNameAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function getDescAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->desc_ar;
        }
        return $this->desc_en;
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service','service_id');
    }
}
