<?php

namespace App\Http\Controllers\SiteApi;

use App\Http\Controllers\Controller;
use App\Model\NewsLetter;
use Illuminate\Http\Request;
use Throwable;

class LandingPageController extends Controller
{
    //
    public function addNewsletter($email)
    {
        try {
            $response = ["status" => false, "message" => "خطا! این ایمیل قبلا در سامانه ثبت شده است"];
            $item = NewsLetter::create(["email" => $email]);
            if ($item && $item instanceof NewsLetter) {
                $response['status'] = true;
                $response['message'] = "سپاس! ایمیل شما در سامانه ثبت شد.";
            }
        }catch (Throwable $exception){
            $response = ["status" => false, "message" => "خطا! این ایمیل قبلا در سامانه ثبت شده است"];
        }
        return response()->json($response);
    }
}
