<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Config::set('auth.defines','admin');

    Route::get('login','AdminAuth@login');
    Route::post('login','AdminAuth@doLogin');
    Route::get('forgotPassword','AdminAuth@forgotPassword');
    Route::post('forgotPassword','AdminAuth@forgotPasswordPost');
    Route::get('reset/password/{token}','AdminAuth@resetPassword');
    Route::post('reset/password/{token}','AdminAuth@resetNewPassword');

    Route::get('lang/{token}',function($lang){
        session()->has('lang')?session()->forget('lang'):'';
        $lang == 'ar'?session()->put('lang','ar'):session()->put('lang','en');
        return back();
    });

    Route::group(['middleware'=>'admin:admin'],function(){

        Route::get('logout','AdminAuth@logout');

        Route::resource('admin','AdminController');
        Route::delete('admin/destroy/all','AdminController@multi_delete');

        Route::resource('users','UsersController');
        Route::delete('users/destroy/all','UsersController@multi_delete');

        Route::get('settings','SettingController@setting');
        Route::post('settings','SettingController@setting_save');

        Route::resource('countries','CountryController');
        Route::delete('countries/destroy/all','CountryController@multi_delete');

        Route::resource('cities','CityController');
        Route::delete('cities/destroy/all','CityController@multi_delete');

        Route::resource('districts','DistrictController');
        Route::delete('districts/destroy/all','DistrictController@multi_delete');

        Route::resource('sections','SectionController');

        Route::resource('trademarks','TradeMarkController');
        Route::delete('trademarks/destroy/all','TradeMarkController@multi_delete');

        Route::resource('manufacturers','ManufacturerController');
        Route::delete('manufacturers/destroy/all','ManufacturerController@multi_delete');

        Route::get('/',function (){
            return view('admin.home');
        });

    });

});
