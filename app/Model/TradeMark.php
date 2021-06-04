<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model
{
    protected $table = 'trademarks';
    protected $fillable = [
        'trademark_name_ar' ,
        'trademark_name_en' ,
        'trademark_logo' ,
    ];
}
