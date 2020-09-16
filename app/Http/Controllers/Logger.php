<?php
/**
 * Created by PhpStorm.
 * User: pooyan
 * Date: 31/07/2020
 * Time: 03:56 PM
 */

namespace App\Http\Controllers;


use App\Model\Log;

class Logger
{
     static function log($id, $controller, $text)
    {
        Log::create([
            "user_id" => $id,
            "controller" => $controller,
            "description" => $text,
        ]);
    }

    public static function profileChanged($id, $controller, $user)
    {
        $user=$user->username;
        $text="مشخصات کاربر $user تغییر داده شد";
        Logger::log($id,get_class($controller),$text);
    }
    public static function profileAvatarChanged($id, $controller, $user)
    {
        $user=$user->username;
        $text="آواتار کاربر $user تغییر داده شد";
        Logger::log($id,get_class($controller),$text);
    }
    public static function profilePasswordChanged($id, $controller, $user)
    {
        $user=$user->username;
        $text="رمز عبور کاربر $user تغییر داده شد";
        Logger::log($id,get_class($controller),$text);
    }

    public static function UserLoggedIn($id, $controller, $user)
    {
        $user=$user->username;
        $text=" کاربر $user به سامانه وارد شد";
        Logger::log($id,get_class($controller),$text);
    }
    public static function UserLoggedOut($id, $controller, $user)
    {
        $user=$user->username;
        $text=" کاربر $user از سامانه خارج شد";
        Logger::log($id,get_class($controller),$text);
    }
    public static function DeviceChanged($id, $controller, $user)
    {
        $user=$user->name;
        $text=" دستگاه  $user ویرایش شد";
        Logger::log($id,get_class($controller),$text);
    }
    public static function PartLog($id, $controller, $user)
    {
        $status=!$user->isDisable;
        $status=$status?"غیر فعال":"فعال";
        $user=$user->name;
        $text=" وضعیت بخش $user به $status تغییر داده شد";
        Logger::log($id,get_class($controller),$text);
    }
    public static function DeviceStatusLog($id, $controller, $user)
    {
        $status=!$user->isOn;
        $status=$status?"روشن":"خاموش";
        $user=$user->name;
        $text=" وضعیت کلید $user به $status تغییر داده شد";
        Logger::log($id,get_class($controller),$text);
    }
}
