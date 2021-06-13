<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\Job;
use App\Mail\UserMail;
use App\Models\Category;
use App\Models\PasswordReset;
use App\Models\User;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class LoginUserController extends Controller
{

    protected $Service;

    /**
     * initialize the value for the Service.
     *
     * @param  Service  $Service
     */
    public function __construct(Service $Service)
    {
        $this->Service = $Service;
    }

    /**
     * Displays the user's login page
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * perform login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function performLogin(Request $request)
    {
        if (Auth::attempt(['user_name' => $request->user_name,
                            'password' => $request->password,
                            'flag_delete' => ACTIVE]))
        {
            return redirect()->route('user_home_index');
        } else {
            return redirect()->back()->withInput();
        }
    }


    /**
     * Displays the user's login page
     *
     * @return \Illuminate\Http\Response
     */
    public function signup()
    {
        return view('user.SignUp');
    }

    /**
     * perform signup
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function performSignup(Request $request)
    {
        $array = [
            'email' => $request->email,
            'name' => $request->name,
            'user_name' => $request->user_name,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday,
        ];

        if ($request->hasFile('avatar')) {
            $request->avatar = '/upload/avatar/' . $this->Service->uploadimg($request);
            $array = $array + [ 'avatar' => $request->avatar];
        }

        DB::transaction(function () use($array) {
            User::insert([$array]);
        });

        return redirect()->route('user_login');
    }

    /**
     * Delete Session and return response
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->back()->withInput();
    }

    /**
     * Check email in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function checkEmail(Request $request)
    {
        $data = User::where('email', $request->email)->select('email')->first();

        if ($data) {
            return "false";
        }else{
            return "true";
        }
    }

    /**
     * Check user_name in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function checkUserName(Request $request)
    {
        $data = User::where('user_name', $request->user_name)->select('user_name')->first();

        if ($data) {
            return "false";
        }else{
            return "true";
        }
    }

    public function resetPassword()
    {
        return view('resetPassword.forgotPassword');
    }

    public function sendMail(Request $request)
    {
        $token = str_replace("/", "2", bcrypt(Str::random(TOKEN_LENGTH)));

        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'status' => 2
        ]);

        dispatch(new Job($request->email, "resetPassword.emailForgotPassword", $token));
        Alert::success('Success', 'Password change link has been sent to your email');
        return redirect() -> back();
    }
}
