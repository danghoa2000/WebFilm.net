<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Auth::guard('web')->user();
        return view('user.profile', ['data' => $data]);
    }

    /**
     * update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request){
        $user = User::select(
            'id',
            'name',
            'birthday',
            'password',
        )->where('id', $request->id)->first();

        $user->name = $request->name;
        $user->birthday = $request->birthday;
        if ($request->password) {
            $user->password = Hash::make($request->new_password);
        }
        $user->save();

        Alert::success('Sửa profile thành công');

        return redirect()->back()->withInput();
    }

    /**
     * update the user's avatar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        User::where('id', $request->popup_value_id)->update(
            [
                'avatar' => '/upload/avatar/' . $this->Service->uploadimg($request),
            ]
        );

        Alert::success('Sửa avatar thành công');

        return redirect()->back()->withInput();
    }

    /**
     * Check the password of the user currently logged in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkPassword(Request $request)
    {
        $password = $request->password;
        if (Hash::check($password, Auth::guard('web')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }
}
