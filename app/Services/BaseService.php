<?php

namespace App\Services;

use App\Mail\sendMail;
use App\Mail\VerificationMail;
use App\Models\Admin;
use App\Models\Code;
use App\Models\Reporter;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class BaseService
{
    public static function convertToIranFormat($mobileNumber) {
        $mobileNumber = preg_replace('/\D/', '', $mobileNumber);

        if (substr($mobileNumber, 0, 2) === '09') {
            return '98' . substr($mobileNumber, 1);
        }
        elseif (substr($mobileNumber, 0, 3) === '989') {
            return $mobileNumber;
        }
        elseif (substr($mobileNumber, 0, 4) === '+989') {
            return substr($mobileNumber, 1);
        }
        else {
            return false;
        }
    }

    public static function sendCode($dest, $type, $code)
    {
        $cache = json_decode(VerificationService::get($dest) , true) ;
        if ($type == 'email')
        {
//            self::SendMail($dest , $code);
            Log::info($code);
        }
        else
        {
            self::sendSms($dest , $cache['code'] , $cache['name']);
            Log::info($code);
        }
        self::createVerificationCode($dest , $code , $cache['name'] , $cache['type']);
    }

    public static function getCreatorType(): array
    {
        if (auth()->guard('admin')->check())
            return [Admin::class, 'admin'];
        elseif (auth()->guard('teacher')->check())
            return [Teacher::class, 'teacher'];
    }

    public static function sendMail($dest, $mail)
    {
        Mail::to($dest)->send(new sendMail($mail));

    }
    public static function createVerificationCode($dest, $code , $username , $type)
    {
        Code::create([
            'dest' => $dest,
            'code' => $code ,
            'username' => $username ,
            'type' => $type ,
            'date' => now()
        ]);

    }
    public static function sendSms($dest, $code , $name )
{
    $template = config('services.sms.template');
    $search = ['CODE'];
    $replace = [$code];
    $msg = str_replace($search , $replace , $template);
    $response = Http::withoutVerifying()->withHeaders([
        'Content-Type' => 'application/x-www-form-urlencoded',
    ])->asForm()->post(config('services.sms.url'), [
        'username' => config('services.sms.username'),
        'password' => config('services.sms.password'),
        'Source' => config('services.sms.source'),
        'Message' => $msg,
        'destination' => self::convertToIranFormat($dest)
    ]);
    $msgId = $response->body();
    return $response->body();

}

    public static function get_image($id)
    {
    if ($id == 11){
            return "http://127.0.0.1:4400/images/physic12.jpg";
        }elseif ($id == 12){
            return "http://127.0.0.1:4400/images/hendese12.jpg";
        }elseif ($id == 10){
            return "http://127.0.0.1:4400/images/shimi12.jpg";
        }elseif ($id == 9){
            return "http://127.0.0.1:4400/images/riazi12.jpg";
        }elseif ($id == 7){
            return "http://127.0.0.1:4400/images/physic11.jpg";
        }elseif ($id == 8){
            return "http://127.0.0.1:4400/images/hendese11.jpg";
        }elseif ($id == 6){
            return "http://127.0.0.1:4400/images/shimi11.jpg";
        }elseif ($id == 5){
            return "http://127.0.0.1:4400/images/riazi11.jpg";
        }elseif ($id == 3){
            return "http://127.0.0.1:4400/images/physic10.jpg";
        }elseif ($id == 4){
            return "http://127.0.0.1:4400/images/hendese10.jpg";
        }elseif ($id == 2){
            return "http://127.0.0.1:4400/images/shimi10.jpg";
        }elseif ($id == 1){
            return "http://127.0.0.1:4400/images/riazi10.jpg";
        }
    }

    public static function reporter($topic_id)
    {

        if ( Reporter::where('reporter_id' , Auth::id())->where('topic_id' , $topic_id)->first()){
            return 'report';
        }else{
            return 'not_report';
        }
    }

}
