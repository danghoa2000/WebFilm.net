<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Services\Service;
use DB;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * Variables represent Model
     */
    protected $model;
    protected $service;

    /**
     * initialize Model
     */
    public function __construct(Service $service)
    {
        $this->setModel();
        $this->Service = $service;
    }

    /**
     * take the corresponding Model
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * get all the data of the models
     *
     * @return Response
     */
    public function getAll()
    {
        return $this->model->all();
    }
    /**
     * get data according to the id of the models
     *
     * @param int $id
     * @return Response
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     * @return Response
     */
    public function store($attributes = [])
    {
        DB::transaction(function () use($attributes) {
            if($this->model->create($attributes)){
                return true;
            }else{
                return false;
            }
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @return Response
     */
    public function update($id, $attributes = [])
    {
        DB::transaction(function () use($attributes,$id) {
            $result = $this->find($id);
            if ($result) {
                $result->update($attributes);
                return $result;
            }

            return false;
        });
    }

    /**
     * Remove the element from ACTIVE mode.
     *
     * @param  UserUpdateRequest  $request
     * @return Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use($id) {
            $this->productRepo->delete($id);
            return view('home.products');
        });
    }
}
