<?php
namespace App\Repositories\Admin;

use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    /**
     * Element initialization.
     *
     * @param   UserCreateRequest $request
     * @return  Response
     */
    public function userStore(Request $request);

    /**
     * Element update.
     *
     * @param   UserUpdateRequest $request
     * @return  Response
     */
    public function userUpdate(Request $request);

    /**
     * Updates the existence state for the element.
     *
     * @param   int $id
     * @return  Response
     */
    public function userDestroy($id);

}
