<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login.index');
    }

    public function checkLogin(Request $request)
    {
        $this->validate($request, [
            "username" => "required",
            "password" => "required",
        ], [
            "username.required" => "وارد کردن نام کاربری الزامی است",
            "password.required" => "وارد کردن رمز عبور الزامی است",
        ]);

        $attempt = Auth::attempt(["username" => $request->input("username"), "password" => $request->input("password"),], $request->has('remmber'));

        if ($attempt) {
            Logger::UserLoggedIn(Auth::id(),$this,Auth::user());
            return redirect()->route('panel.index');
        } else {
            return redirect()->route('login')->with("err", "نام کاربری یا رمز عبور نا معتبر است");
        }
    }
}
