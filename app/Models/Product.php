<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'products';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['name_en', 'name_ar','desc_en','desc_ar','created_at', 'updated_at','deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en', 'name_ar','is_featured','desc_en','desc_ar','image','sub_service_id'
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

    public function sub_service(){
        return $this->belongsTo('App\Models\SubService','sub_service_id');
    }

}
