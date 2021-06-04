<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    protected $fillable = [
        'manufacturer_name_ar' ,
        'manufacturer_name_en' ,
        'manufacturer_logo' ,
        'country_id' ,
        'city_id',
        'email' ,
        'phone' ,
        'address',
        'lat' ,
        'long' ,
        'site',
    ];

    public function country_id(){
        return $this->hasOne('App\Model\Country','id','country_id');
    }

    public function city_id(){
        return $this->hasOne('App\Model\City','id','city_id');
    }
}
