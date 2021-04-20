<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Config;

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
    public function index(Request $request)
    {
        $data = Auth::guard('admin')->user();
        return view('admin.home', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return Response
     */
    public function updateProfile(Request $request){
        DB::transaction(function () use($request) {
            Admin::where('user_name', $request->user_name)->update(
                    [
                        'name' => $request->name,
                        'birthday' => $request->birthday,
                    ]
            );
        });

        // if (Config::get('app.locale') == "en") {
            // Alert::success('Success','successfully updated category');
        // }
        // else{
            Alert::success('Thành công','Sửa profile thành công');
        // }

        return redirect() -> back() -> withInput();
    }

    public function updateAvatar(Request $request)
    {
        DB::transaction(function () use($request) {
            Admin::where('id', $request->popup_value_id)->update(
                [
                    'avatar' => '/upload/avatar/'.$this->Service->uploadimg($request),
                ]
            );
        });
        Alert::success('Thành công','Sửa avatar thành công');
        return redirect() -> back() -> withInput();
    }

}
