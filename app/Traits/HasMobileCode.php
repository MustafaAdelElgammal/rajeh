<?php
namespace  App\Traits;


trait  HasMobileCode{
    /**
     * Boot the has password trait for a model.
     *
     * @return void
     */
    public static function bootHasMobileCode()
    {

        static::creating(function ($user) {
            $user->mobile_code =  mt_rand(10000, 99999);
        });



    }
}
