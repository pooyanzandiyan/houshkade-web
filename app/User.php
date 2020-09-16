<?php

namespace App;

use App\Http\Controllers\DateUtil;
use App\Model\Device;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password',"username","avatar_url"
    ];
    public function getDate()
    {
        $gregorianDate = $this->attributes['created_at'];
        $timestamp = strtotime($gregorianDate);
        $new_date_format = explode("-", date('Y-m-d', $timestamp));
        return date('H:i:s', $timestamp). " " . DateUtil::gregorian_to_jalali($new_date_format[0], $new_date_format[1], $new_date_format[2], "/") ;

    }

    public function devices()
    {
        return $this->hasMany(Device::class,"user_id","id");
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function setPasswordAttribute($value)
    {

       dd($this->attributes['password']=bcrypt($value)) ;
    }
}
