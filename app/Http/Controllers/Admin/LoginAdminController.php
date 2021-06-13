<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Jobs\Job;
use App\Models\Admin;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class LoginAdminController extends Controller
{
    /**
     * Display the admin login page
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * Check the credentials sent over the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function performLogin(Request $request)
    {
        $credentials = $request->only(['user_name', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin_index');
        } else {
            return redirect()->route('admin_login');
        }
    }

    /**
     * sign out of your account
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin_login');
    }

    /**
     * display the email input interface to change the password
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword()
    {
        return view('resetPassword.forgotPassword');
    }

    /**
     * Send password change link via email email
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request)
    {
        $token = str_replace("/", "1", bcrypt(Str::random(TOKEN_LENGTH)));

        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'status' => 1
        ]);

        dispatch(new Job($request->email, "resetPassword.emailForgotPassword", $token));
        Alert::success('Success', 'Password change link has been sent to your email');
        return redirect() -> back();
    }

    /**
     * display the password change the password
     *
     * @return \Illuminate\Http\Response
     */
    public function viewReset()
    {
        return view("resetPassword.resetPassword");
    }

    /**
     * perform password update
     *
     * @param  \App\Http\Requests\User\ResetPasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(ResetPasswordRequest $request)
    {
        $time = date( 'Y-m-d H:i:j', strtotime('-5 minute', strtotime(Carbon::now())));
        $passwordReset = PasswordReset::where('token', $request->token)
                              ->where('created_at', '>=', $time)
                              ->where('status', '>', INACTIVE)
                              ->select('id', 'email', 'status')
                              ->first();
        if ($passwordReset) {
            if ($passwordReset->status == 1) {
                Admin::where('email', $passwordReset->email)->update(
                    [
                        'password' =>  bcrypt( $request->password)
                    ]
                );

                $passwordReset->status = INACTIVE;
                $passwordReset->save();
                if (\Config::get('app.locale') == "en") {
                    Alert::success('Success','Password changed successfully');
                }
                else{
                    Alert::success('Thành công','Mật khẩu đã được thay đổi');
                }

                return redirect()->route('admin_login');
            } else {
                User::where('email', $passwordReset->email)->update(
                    [
                        'password' =>  bcrypt( $request->password)
                    ]
                );

                $passwordReset->status = INACTIVE;
                $passwordReset->save();
                if (\Config::get('app.locale') == "en") {
                    Alert::success('Success','Password changed successfully');
                }
                else{
                    Alert::success('Thành công','Mật khẩu đã được thay đổi');
                }

                return redirect()->route('user_login');
            }
        }else{

            if (\Config::get('app.locale') == "en") {
                Alert::Error('Error','Your session has ended, please try again');
            }
            else{
                Alert::success('Lỗi','Session đã hết hạn, Vui lòng gửi lại email');
            }

            return redirect() -> back() -> withInput();
        }
    }
}
