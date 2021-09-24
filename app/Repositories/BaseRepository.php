<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

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

    public function getAll()
    {
        return $this->model->all();
    }

    /*public function find($id)
    {
        $result = $this->model->find($id);
        return $result;
    }*/

    public function create()
    {
    }

    public function store(array $input)
    {
        return $this->model->create($input);
    }

    public function edit($id)
    {
        $user = $this->model->find($id);
        return $user;
    }

    public function update(array $input, $id)
    {
        $data = $this->model::find($id);
        if(isset($input['stt'])){
            $data->stt = $input['stt'];
        }
        $data->update($input);
        return $data;
    }

    public function destroy($id)
    {
        $this->model::find($id)->delete();
    }
}
