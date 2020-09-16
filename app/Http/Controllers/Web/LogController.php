<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    //
    public function index()
    {
        $logs=Log::query()->where("user_id","=",Auth::id())->orderBy("created_at","desc")->paginate(10);
        return view('panel.log.index',compact('logs'))->with("panel_title","گزارش های سیستم");
    }
}
