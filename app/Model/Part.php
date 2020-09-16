<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
    protected $fillable = [
        'device_id', "name", "isDisable"
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, "device_id", "id");
    }

    public function deviceStatus()
    {
        return $this->hasMany(DeviceStatus::class, "part_id", "id");
    }

    protected $hidden = ["device_id", "id", "updated_at", "created_at"];
    protected $guarded = ['id'];
}
