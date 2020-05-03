<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'packages';

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
        'name_ar','name_en','desc_ar','desc_en','price','period','type','image'
    ];
    //'type' => ['day', 'week', 'month', 'year']
    
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

}
