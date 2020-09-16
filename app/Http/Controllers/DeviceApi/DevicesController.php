<?php

namespace App\Http\Controllers\DeviceApi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Logger;
use App\Model\Device;
use App\Model\DeviceStatus;
use App\Model\Part;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    //
    public function getStatus($serial)
    {
        $device = Device::where("serial", $serial)->first();
        $resultPin1 = 0;
        $resultPin2 = 0;
        $data = [];
        foreach ($device->deviceStatus as $item) {

            if ($item->type == 1) {
                if ($item->pin < 8) {
                    //echo $item->pin;
                    $resultPin1 += pow(2, $item->pin) * $item->isOn;
                } else if ($item->pin >= 8 && $item->pin < 16) {
                    //dd($item->pin);
                    $resultPin2 += pow(2, ($item->pin - 8)) * $item->isOn;
                }
            }
            if ($item->type == 0) {
                $pinData['pin'] = $item->pin;
                $pinData['isOn'] = $item->isOn;
                array_push($data, $pinData);
            }
        }
        //dd($result);
        $status = (!$device->part->isDisable) && $device->isEnabled;
        return response()->json(["status" => $status, "data" => $data, "spiPin1" => $resultPin1, "spiPin2" => $resultPin2]);
    }

    public function getDeviceConfig($serial)
    {
        $device = Device::where("serial", $serial)->first(["wifi_password", "wifi_name"]);
        return response()->json($device);
    }

    public function togglePin($id, $status, $user_id)
    {
        $device = DeviceStatus::query()->find(base64_decode($id));
        Logger::DeviceStatusLog(base64_decode(base64_decode($user_id)), $this, $device);
        $device->update(["isOn" => $status == 1]);
        return response()->json(["status" => true]);
    }

    public function togglePart($id, $status, $user_id)
    {
        $part = Part::query()->find(base64_decode($id));
        Logger::PartLog(base64_decode(base64_decode($user_id)), $this, $part);
        $part->update(["isDisable" => $status == 1]);
        return response()->json(["status" => true]);
    }

}
