<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\File;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public static function upload($data = []){
        if (in_array('new_name',$data)){
            $new_name = $data['new_name'] === null?time():$data['new_name'];
        }
        if (request()->has($data['file']) && $data['upload_type'] == 'single'){
            Storage::has($data['delete_file'])?Storage::delete($data['delete_file']):'';
            return request()->file($data['file'])->store($data['file']);
        }

        elseif (request()->has($data['file']) && $data['upload_type'] == 'files'){
            $file = request()->file($data['file']);

            $name = $file->getClientOriginalName();
            $hashName = $file->hashName();
            $mimType = $file->getMimeType();
            $size = $file->getSize();
            $file->store($data['path']);
            File::create([
                'name'=>$name,
                'file'=>$hashName,
                'size'=>$size,
                'path'=>$data['path'],
                'full_file'=>$data['path'].'/'.$hashName,
                'mime_type'=>$mimType,
                'file_type'=>$data['file_type'],
                'relation_id'=>$data['relation_id'],
            ]);
            return $data['path'].'/'.$hashName;
        }
    }
}
