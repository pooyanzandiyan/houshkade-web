<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Logger;
use App\Model\Log;
use App\Model\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    //
    public function index()
    {
        $logs=Log::query()->where("user_id","=",Auth::id())->orderby("created_at","desc")->limit(5)->get();
        return view('panel.dashboard.dashboard',compact('logs'));
    }

    public function logout()
    {
        Logger::UserLoggedOut(Auth::id(),$this,Auth::user());
        Auth::logout();
        return redirect()->route('login')->with("msg","با موفقیت از حساب کاربری خود خارج شدید");
    }
}
