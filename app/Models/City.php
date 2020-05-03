<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'cities';

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
        'name_en', 'name_ar','country_id'
    ];
    
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }
}
