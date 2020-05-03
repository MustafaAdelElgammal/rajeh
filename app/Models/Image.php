<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'images';

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
    protected $fillable = ['title','path'];

    public function imagable()
    {
        return $this->morphTo();
    }
}
