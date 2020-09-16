<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Logger;
use App\Model\Device;
use App\Model\DeviceStatus;
use App\Model\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    //
    public function index()
    {
        $devices = Auth::user()->devices;

        return view('panel.device.index', compact('devices'))->with("panel_title", "دستگاه ها");
    }

    public function create()
    {
        return view('panel.device.add')->with("panel_title", "اضافه کردن دستگاه");
    }

    public function save(Request $request)
    {
        $this->validate($request,
            [
                "name" => "required",
                "serial" => "required",
                "wifi_name" => "required",
                "wifi_password" => "required",
            ],
            [
                "name.required" => "فیلد نام دستگاه الزامی است",
                "serial.required" => "فیلد سریال دستگاه الزامی است",
                "wifi_name.required" => "فیلد نام Wi-Fi الزامی است",
                "wifi_password.required" => "فیلد رمز Wi-Fi الزامی است"
            ]);
        $data = [
            "user_id" => Auth::id(),
            "name" => $request->input('name'),
            "serial" => $request->input('serial'),
            "wifi_name" => $request->input('wifi_name'),
            "wifi_password" => $request->input('wifi_password'),
            "isEnabled" => $request->has('isEnabled'),
            "isReadLocation" => $request->has('isReadLocation'),
        ];
        $newDevice = Device::create($data);
        if ($newDevice instanceof Device)
            return redirect()->route('panel.device.index')->with("msg", "با موفقیت ثبت شد");
        else
            return redirect()->back()->with("err", "خطا در ثبت دستگاه جدید");
    }

    public function edit($id)
    {
        $device = Device::find(base64_decode($id));
        return view('panel.device.add', compact('device'))->with("panel_title", "ویرایش  دستگاه");
    }

    public function store($id, Request $request)
    {
        $this->validate($request,
            [
                "name" => "required",
                "serial" => "required",
                "wifi_name" => "required",
                "wifi_password" => "required",
            ],
            [
                "name.required" => "فیلد نام دستگاه الزامی است",
                "serial.required" => "فیلد سریال دستگاه الزامی است",
                "wifi_name.required" => "فیلد نام Wi-Fi الزامی است",
                "wifi_password.required" => "فیلد رمز Wi-Fi الزامی است"
            ]);

        $data = [
            "user_id" => Auth::id(),
            "name" => $request->input('name'),
            "serial" => $request->input('serial'),
            "wifi_name" => $request->input('wifi_name'),
            "wifi_password" => $request->input('wifi_password'),
            "isEnabled" => $request->has('isEnabled'),
            "isReadLocation" => $request->has('isReadLocation'),
        ];
        $device = Device::find(base64_decode($id));
        $device->update($data);
        Logger::DeviceChanged(Auth::id(),$this,$device);
        return redirect()->route('panel.device.index')->with("msg", "با موفقیت ویرایش شد");
    }

    public function deleteDevice($id)
    {

        $device = Device::query()
            ->where("id", "=", base64_decode($id))
            ->where("user_id", "=", Auth::id());
        if (count($device->get()) > 0) {
            $deviceStatus = DeviceStatus::query()->where("device_id", "=", base64_decode($id));
            $deviceStatus->delete();
            $device->delete();
            return redirect()->back()->with("msg", "با موفقیت حذف شد")->with("panel_title", "دستگاه ها");
        }
        return redirect()->back()->with("err", "دسترسی غیرمجاز!")->with("panel_title", "دستگاه ها");
    }

    public function showPart($id)
    {
        $devices = Part::where("device_id", base64_decode($id))->get();

        return view('panel.part.index', compact('devices'), compact('id'))->with("panel_title", "بخش ها");
    }

    public function showSubDevice($id, $partId)
    {
        $devices = DeviceStatus::where("device_id", base64_decode($id))->get();
        return view('panel.deviceStatus.index', compact('devices'), compact('id'))->with("panel_title", "کلید ها");
    }




}
