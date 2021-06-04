<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;

class SettingController extends Controller
{
    protected function setting(){
        return view('admin.settings',['title'=>trans('admin.settings')]);
    }

    protected function setting_save(){
        $data = $this->validate(request(),
            [
                'site_name_ar'=> 'required',
                'site_name_en'=> 'required',
                'logo'=> validate_image(),
                'icon'=> validate_image(),
                'email'=> '',
                'descriptions'=> '',
                'keywords'=> '',
                'status'=> '',
                'msg_maintenance_ar'=> '',
                'msg_maintenance_en'=> '',
            ],
            [],
            [
                'site_name_ar'=>trans('admin.site_name_ar'),
                'site_name_en'=>trans('admin.site_name_ar'),
                'logo'=>trans('admin.logo'),
                'icon'=>trans('admin.icon')
            ]
        );
        if (request()->hasFile('logo')){
//            !empty(setting()->logo)?Storage::delete(setting()->logo):'';
//            $data['logo'] = request()->file('logo')->store('settings');
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo
            ]);
        }
        if (request()->hasFile('icon')){
//            !empty(setting()->icon)?Storage::delete(setting()->icon):'';
//            $data['icon'] = request()->file('icon')->store('settings');
            $data['icon'] = upload_file()->upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->icon
            ]);
        }
        Setting::orderBy('id','desc')->update($data);
        session()->flash('success',trans('admin.records_update_success'));
        return redirect(aurl('settings'));
    }
}
