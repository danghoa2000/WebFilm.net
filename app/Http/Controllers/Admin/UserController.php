<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::select(
            'id',
            'avatar',
            'name',
            'user_name',
            'email',
            'birthday'
        )->where('flag_delete', ACTIVE)
        ->where('name', 'like', "%$request->search%")
        ->orwhere('user_name', 'like', "%$request->search%")
        ->Paginate(15);

        return view('admin.user.index', ['data' => $data, 'search' => $request->search]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return boolean
     */
    public function destroy($id)
    {
        DB::transaction(function () use($id){
            User::where('id', $id)->update(
                [
                    'flag_delete' => INACTIVE,
                ]
            );
        });

        return "true";
    }
}
