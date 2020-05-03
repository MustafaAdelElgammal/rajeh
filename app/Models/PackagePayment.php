<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePayment extends Model
{
    //

    /**
     * The model table.
     *
     * @var array
     */
    protected  $table = 'package_payments';

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
        'provider_id','package_id','payment_type','promocode_id','payment_id',
    ];
    //status => ('pending', 'paid', 'unpaid')
    //type => ('payment', 'refund')

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider','provider_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package','package_id');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment','payment_id');

    }
    public function promocode()
    {
        return $this->belongsTo('App\Models\Promocode','promocode_id');

    }
}
