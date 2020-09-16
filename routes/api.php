<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("getStatus/{id}","DeviceApi\DevicesController@getStatus");
Route::post("getConfig/{id}","DeviceApi\DevicesController@getDeviceConfig");
Route::post("devices/part/{id}/toggle/{status}/{user_id}", "DeviceApi\DevicesController@togglePart")->name("panel.device.part.toggle");
Route::post("devices/part/sub-device/{id}/toggle/{status}/{user_id}", "DeviceApi\DevicesController@togglePin")->name("panel.device.sub-device.toggle");

Route::post("newsletter/add/{email}","SiteApi\LandingPageController@addNewsletter");

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
