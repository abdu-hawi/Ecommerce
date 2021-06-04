<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = [
        'district_name_ar',
        'district_name_en',
        'country_id',
        'city_id',
    ];

    public function country_id(){
        return $this->hasOne('App\Model\Country','id','country_id');
    }

    public function city_id(){
        return $this->hasOne('App\Model\City','id','city_id');
    }
}
