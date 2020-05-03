<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'settings';

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
    protected $fillable = ['value_ar','value_en','key','name','type'];

    protected $appends = ['value'];

    public function getValueAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->value_ar;
        }
        return $this->value_en;
    }
}
