<?php
namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Imports\CommuneImport;
use App\Imports\DistrictImport;
use App\Imports\ProvinceImports;
use App\Models\Commune;
use App\Models\District;
use App\Models\Province;
use App\Models\ResetPassword;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\Admin\UserRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Str;
use Config;
use Illuminate\Http\Request;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * initialize Model for user.
     *
     * @return \App\Models\User::class
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }

    /**
     * Element initialization.
     *
     * @param   UserCreateRequest $request
     * @return  Response
     */
    public function userStore(Request $request){
        $array = [
            'avatar' => '/upload/user/'.$this->Service->uploadimg($request),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'user_name' => $request->user_name,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'commune_id' => $request->commune_id,
            'address' => $request->address
        ];

        $this->Store($array);

        $token = str_replace("/", "i", bcrypt( Str::random(TOKEN_LENGTH)));
        ResetPassword::insert(
            [
                'email' => $request->email,
                'token' => $token,
                'status' => ACTIVE,
                'created_at' => Carbon::now()
            ]
        );
        UserController::sendMail($request->email,'admin.user.emailCreate',$token);
        if (Config::get('app.locale') == "en") {
            Alert::success('Success','user has been added successfully');
        }
        else{
            Alert::success('Thành công','Tài khoản người dùng đã được tao thành công');
        }

        return redirect('/admin');
    }

    /**
     * Element update.
     *
     * @param   UserUpdateRequest $request
     * @return  Response
     */
    public function userUpdate(Request $request){
        $array = [
            'password' => $request->password = bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'user_name' => $request->user_name,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'commune_id' => $request->commune_id,
            'address' => $request->address
        ];
        if ($request->hasFile('avatar') ) {
            $request->avatar = '/upload/user/'.$this->Service->uploadimg($request);
            $array = $array + [ 'avatar' => $request->avatar];
        }
        $this->update($request->id,$array);
            UserController::sendMail($request->email,'admin.user.emailEdit','');
            if (Config::get('app.locale') == "en") {
                Alert::success('Success','the user has been successfully edited');
            }
            else{
                Alert::success('Thành công','Tài khoản người dùng được sửa thành công');
            }

            return redirect('/admin');

    }

    /**
     * Updates the existence state for the element.
     *
     * @param   int $id
     * @return  Response
     */
    public function userDestroy($id){
        $result = $this->find($id);
        if ($result) {
            $this->Service->UpdateFlagDelete($id,User::class);
            return redirect('/admin');
        }

        if (Config::get('app.locale') == "en") {
            Alert::error('error','An error occurred during deletion');
        }
        else{
            Alert::success('Lỗi','Xóa không thành công');
        }
        return redirect('/admin');
    }

    /**
     * update data for province, district and commune.
     */
    public function userAddress()
    {
        //function to update data for the province
        $this->updateProvince();

        //function to update data for the District
        $this->updateDistrict();

        //function to update data for the Commune
        $this->updateCommune();
        if (Config::get('app.locale') == "en") {
            Alert::success('Success','The address data has been successfully updated');
        }
        else{
            Alert::success('Thành công','Dữ liệu địa chỉ đã được cập nhật thành công');
        }
    }

    /**
     * function to update data for the province.
     */
    public function updateProvince()
    {
        $data = Excel::toArray(new ProvinceImports, 'tinh.xls');
        for ($i=0; $i < count($data[0]) ; $i++) {
            if (Province::find($data[0][$i][0])) {
                DB::transaction(function () use($data,$i){
                    Province::where('id',$data[0][$i][0])->update(
                        [
                            'name' => $data[0][$i][1]
                        ]
                    );
                });
            }else {
                DB::transaction(function () use($data,$i){
                    Province::insert([
                        [
                            'name' => $data[0][$i][1],
                            'id' => $data[0][$i][0],
                        ]
                    ]);
                });
            }
        }
    }

    /**
     * function to update data for the District.
     */
    public function updateDistrict()
    {
        $data = Excel::toArray(new DistrictImport, 'huyen.xls');
        for ($i=0; $i < count($data[0]) ; $i++) {
            if (District::find($data[0][$i][0])) {
                DB::transaction(function () use($data,$i){
                    District::where('id',$data[0][$i][0])->update(
                        [
                            'name' => $data[0][$i][1],
                            'province_id' => $data[0][$i][4]
                        ]
                    );
                });
            }else {
                DB::transaction(function () use($data,$i){
                    District::insert([
                        [
                            'name' => $data[0][$i][1],
                            'id' => $data[0][$i][0],
                            'province_id' => $data[0][$i][4]
                        ]
                    ]);
                });
            }
        }
    }

    /**
     * function to update data for the Commune.
     */
    public function updateCommune()
    {
        $data = Excel::toArray(new CommuneImport, 'xa.xls');
        for ($i=0; $i < count($data[0]) ; $i++) {
            if (Commune::find($data[0][$i][0])) {
                DB::transaction(function () use($data,$i){
                    Commune::where('id',$data[0][$i][0])->update(
                        [
                            'name' => $data[0][$i][1],
                            'district_id' => $data[0][$i][4]
                        ]
                    );
                });
            }else {
                DB::transaction(function () use($data,$i){
                    Commune::insert([
                        [
                            'name' => $data[0][$i][1],
                            'id' => $data[0][$i][0],
                            'district_id' => $data[0][$i][4]
                        ]
                    ]);
                });
            }
        }
    }

    /**
     * get the data in the Province table .
     *
     * @return  Response
     */
    public function valueProvince()
    {
        return Province::select('id','name')->get();
    }

    /**
     * gets the data in the District table.
     *
     * @param   int $id
     * @return  Response
     */
    public function valueDistrict($id)
    {
        return District::where('province_id',$id)->select('id','name')->get();
    }

    /**
     * get the data in the Commune table .
     *
     * @param   int $id
     * @return  Response
     */
    public function valueCommune($id)
    {
        return Commune::where('district_id',$id)->select('id','name')->get();
    }

    /**
     * Perform confirm password.
     *
     * @param String $token
     * @param ResetPasswordRequest $request
     * @return Response
     */
    public function passwordConfirm($request,$token)
    {
        $time = date( 'Y-m-d h:i:j', strtotime('-3 hour', strtotime( Carbon::now())) );
        $email = ResetPassword::where('token',$token)
                              ->where('created_at','>=',$time)
                              ->where('status',ACTIVE)
                              ->select('email', 'id', 'status')
                              ->first();

        if ($email) {
            User::where('email',$email->email)->update(
                [
                    'password' =>  bcrypt( $request->password),
                    'status' => ACCESS
                ]
            );
            $email->status = INACTIVE;
            $email->save();
            if (Config::get('app.locale') == "en") {
                Alert::success('Success','Password changed successfully');
            }
            else{
                Alert::success('Thành công','Mật khẩu được cập nhật thành công');
            }
        }else{

            if (Config::get('app.locale') == "en") {
                Alert::Error('Error','Your session has ended, please try again');
            }
            else{
                Alert::success('Lỗi','Session đã hết hạn, Vui lòng thực hiện lại từ đầu');
            }
        }
    }
}
