<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'user_notifications';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message','notifiable_id', 'notifiable_type', 'type', 'read_at', 'is_read','user_id','user_type'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'read_at' => 'datetime',
    ];


}
