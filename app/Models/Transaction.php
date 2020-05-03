<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'transactions';

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
        'provider_id','package_id','image','notes',
    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider','provider_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package','package_id');
    }
}
