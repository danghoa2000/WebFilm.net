<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Config;
use Illuminate\Support\Facades\Hash;

class HomeAdminController extends Controller
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
     * Display the admin home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Auth::guard('admin')->user();
        return view('admin.home', ['data' => $data]);
    }

    /**
     * update profile of administrator.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request){
        $admin = Admin::select(
            'id',
            'name',
            'birthday',
            'password',
        )->where('user_name', $request->user_name)->first();

        $admin->name = $request->name;
        $admin->birthday = $request->birthday;
        if ($request->password) {
            $admin->password = Hash::make($request->new_password);
        }
        $admin->save();

        Alert::success('Thành công', 'Sửa profile thành công');

        return redirect()->back()->withInput();
    }

    /**
     * update admin avatar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        DB::transaction(function () use($request) {
            Admin::where('id', $request->popup_value_id)->update(
                [
                    'avatar' => '/upload/avatar/' . $this->Service->uploadimg($request),
                ]
            );
        });

        Alert::success('Thành công', 'Sửa avatar thành công');
        return redirect()->back()->withInput();
    }

    /**
     * Check the password of the admin currently logged in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function checkPassword(Request $request)
    {
        $password = $request->password;
        if (Hash::check($password, Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }
}
