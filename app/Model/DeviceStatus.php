<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeviceStatus extends Model
{
    //
    protected $fillable = [
        'device_id', 'pin', 'isOn',"part_id","name","type"
    ];

    public function device()
    {
        return $this->belongsTo(Device::class,"device_id","id");
    }
    public function part()
    {
        return $this->belongsTo(Part::class,"part_id","id");
    }
    protected $hidden=["device_id","id","updated_at","created_at","name","part_id"];
}
