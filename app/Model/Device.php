<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $fillable = [
        'user_id', 'isEnabled', 'name',"serial","isReadLocation","locations","wifi_name","wifi_password"
    ];

    public function deviceStatus()
    {
       return $this->hasMany(DeviceStatus::class,"device_id","id");
    }
    public function part()
    {
        return $this->hasOne(Part::class,"device_id","id");
    }
    protected $hidden=["user_id","id","updated_at","created_at"];
}
