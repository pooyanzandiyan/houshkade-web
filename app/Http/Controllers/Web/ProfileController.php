<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return view('panel.profile.profile', compact('user'))->with("panel_title", "پروفایل");
    }

    public function store(Request $request)
    {
        $user_item = Auth::user();
        Validator::extend('changePass', function ($attribute, $value, $parameters) {
            $password2 = request()->input("pass-repeat");
            if (!isset($value))
                return true;
            else
                return $value == $password2;
        });

        $this->validate($request, [
            "full_name" => "required",
            "avatar" => "image|mimes:jpeg,png,jpg,gif,svg"
        ], [
            "full_name.required" => "وارد کردن نام و نام خانوادگی الزامی می باشد",
            "avatar.image" => "فرمت وارد شده برای آواتار معتبر نمی باشد",
        ]);
        if ($request->input('pass') != null) {

            $this->validate($request, [
                "pass" => "changePass",
            ], [
                "pass.change_pass" => "رمز عبور وارد شده با تکرار آن یکسان نمی باشد",
            ]);
        }
        $data = [
            "full_name" => $request->input("full_name"),
        ];
        if ($request->hasFile("avatar")) {
            $image = $request->file('avatar');
            $input['imagename'] = rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'file/avatar';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(300, $img->height(), function ($constraint) {
                $constraint->aspectRatio();
            })->crop(300, 300)->save($destinationPath . '/' . $input['imagename']);
            $data['avatar_url'] = "/file/avatar/" . $input['imagename'];
            Logger::profileAvatarChanged(Auth::id(), $this, $user_item);

        }
        $changedPassword = false;
        if (strlen($request->input("pass") > 0)) {
            $data['password'] = $request->input("pass");
            $changedPassword = true;
            Logger::profilePasswordChanged(Auth::id(), $this, $user_item);
        }


        $user_item->update($data);
        if ($changedPassword) {
            Auth::logoutOtherDevices($user_item->password);
        }
        Logger::profileChanged(Auth::id(), $this, $user_item);
        return redirect()->back()->with("msg", "با موفقیت ذخیره شد");


    }
}
