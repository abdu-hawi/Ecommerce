<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'name',
        'file',
        'path',
        'full_file',
        'mime_type',
        'file_type',
        'relation_id',
    ];
}
