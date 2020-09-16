<?php

namespace App\Model;

use App\Http\Controllers\DateUtil;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable=['user_id','controller','description',];

    public function getDate()
    {
        $gregorianDate = $this->attributes['created_at'];
        $timestamp = strtotime($gregorianDate);
        $new_date_format = explode("-", date('Y-m-d', $timestamp));
        return date('H:i:s', $timestamp). " " . DateUtil::gregorian_to_jalali($new_date_format[0], $new_date_format[1], $new_date_format[2], "/") ;

    }

}
