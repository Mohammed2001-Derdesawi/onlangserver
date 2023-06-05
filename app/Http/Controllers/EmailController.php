<?php

namespace App\Http\Controllers;
use App\Mail\VisitorContact;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Modules\User\Entities\User;

class EmailController extends Controller
{
    public function submitContactForm(Request $request)
    {

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' =>$request->email,
            'message' =>$request->message,
        ];

        $email = Email::create($data);
        $email->save();
            $supportEmail = isset(cache()->get('settings')['general_info']['support_email'])?cache()->get('settings')['general_info']['support_email']:
config('front_settings.general_info.support_email');
        Mail::to($supportEmail)->send (new VisitorContact($data));
        Session::flash('message', 'Thank you for your email');
        return redirect()->route('contactUs');
    }


}
