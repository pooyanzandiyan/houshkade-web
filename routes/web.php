<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function (){
    return view('landing.index');
});
Route::get('/login', "Web\LoginController@index")->name("login");
Route::post('/login', "Web\LoginController@checkLogin");
Route::group(['prefix' => 'panel', "namespace" => "Web", "middleware" => "auth"], function () {
    //logout
    Route::get('logout', "PanelController@logout")->name("logout");
    //dashboard
    Route::get("/", "PanelController@index")->name("panel.index");
    //profile
    Route::get("profile", "ProfileController@index")->name("panel.profile.index");
    Route::post("profile", "ProfileController@store")->name("panel.profile.index");
    //devices
    Route::get("devices", "DeviceController@index")->name("panel.device.index");
    Route::get("devices/add", "DeviceController@create")->name("panel.device.create");
    Route::post("devices/add", "DeviceController@save")->name("panel.device.save");
    Route::get("devices/edit/{id}", "DeviceController@edit")->name("panel.device.edit");
    Route::post("devices/edit/{id}", "DeviceController@store")->name("panel.device.store");
    Route::get("devices/delete/{id}", "DeviceController@deleteDevice")->name("panel.device.delete");

    Route::get("devices/part/{partId}/sub-device/{id}", "DeviceController@showSubDevice")->name("panel.device.sub-device");
    Route::get("devices/part/{id}", "DeviceController@showPart")->name("panel.device.part");

    Route::get("logs", "LogController@index")->name("panel.log");


});

