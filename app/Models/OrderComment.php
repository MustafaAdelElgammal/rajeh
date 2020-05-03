<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderComment extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'order_comments';
    protected $fillable = ['message','from_id','from_type','order_id','to_id','to_type'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    public function client_from()
    {
        return $this->belongsTo(Client::class,'from_id');
    }
    public function client_to()
    {
        return $this->belongsTo(Client::class,'to_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
