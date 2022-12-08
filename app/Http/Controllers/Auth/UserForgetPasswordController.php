<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpVarify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserForgetPasswordController extends Controller
{
    public function send_otp_page(Request $request)
    {
        $email = "";
        if (Auth::user()) {
            $email = Auth::user()->email;
        }
        return view('Auth/send_otp_page', compact('email'));
    }

    public function view(Request $request)
    {

        $email = $request->email;
        $user_id = User::where('email', $email)->pluck('id')->first();
        // dd($user_id);
        if (!$user_id) {
            return redirect()->back()->with('danger', 'User not found !');
        }


        // mail sending 
        $otp = rand(100000, 999999);
        $details = [
            'email' => $email,
            'otp' => $otp,
        ];

        // Mail::to($email)->send(new \App\Mail\password_otp($details));

        dispatch(new \App\Jobs\SendMailJob($details));
        $request->session()->put('user_id', $user_id);

        //update in database
        if (OtpVarify::where('user_id', $user_id)->first()) {
            $otpVarify =  OtpVarify::where('user_id', $user_id)->first();
        } else {
            $otpVarify = new OtpVarify();
        }
        $otpVarify->otp = Hash::make($otp);
        $otpVarify->user_id = $user_id;
        $otpVarify->save();

        return view('Auth/forget_password');
    }



    public function change_password(Request $request)
    {

        $user_id = $request->session()->get('user_id');
        $user_otp  = $request->otp;
        $password  = $request->new_pwd;

        $main_otp = (OtpVarify::where('user_id', $user_id)->first())->otp;

        if (Hash::check($user_otp, $main_otp)) {
            $user = User::find($user_id);
            $user->password = Hash::make($password);
            $user->save();
            return redirect('/')->with('success' , 'Password changed successfully');
        } else {
            return redirect('forget-password')->with('danger', 'Invaild Otp');
        }
    }
}
