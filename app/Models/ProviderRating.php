<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderRating extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'provider_ratings';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
}
