<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustmorSupport extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'custmor_supports';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $fillable = ['from_id', 'to_id', 'message', 'read_at', 'parent_id'];

    public function user(){
        return $this->belongsTo('App\User','to_id');
    }

    public function client_to(){
        return $this->belongsTo('App\Models\Client','to_id');
    }
    public function client_from(){
        return $this->belongsTo('App\Models\Client','from_id');
    }


}
