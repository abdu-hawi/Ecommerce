<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';
    protected $fillable = [
        'section_name_ar',
        'section_name_en',
        'icon_section',
        'description',
        'keyword',
        'parent',
    ];

    public function parent(){
        return $this->hasMany('App\Model\Section','id','parent');
    }
}
