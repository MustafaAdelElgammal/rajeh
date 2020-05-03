<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'news';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    
    protected $fillable = [
        'title_ar', 'title_en','image','body_ar','body_en'
    ];
    
    protected $appends = ['title','body'];

    public function getTitleAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->title_ar;
        }
        return $this->title_en;
    }

    public function getBodyAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->body_ar;
        }
        return $this->body_en;
    }
}
