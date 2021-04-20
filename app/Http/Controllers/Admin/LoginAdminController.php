<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    /**
     * Display the admin login page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return view('admin.login');
    }

    public function performLogin(Request $request)
    {
        $credentials = $request -> only(['user_name', 'password']);
        if (Auth::guard('admin') -> attempt($credentials)) {
            return redirect() -> route('admin_index');
        } else {
            return redirect() -> route('admin_login');
        }
    }

    /**
     * Delete Session and return response
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect() -> route('admin_login');
    }
}
