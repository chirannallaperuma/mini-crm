<?php

namespace App\Repositories;

use Illuminate\Support\Arr;

class BaseEloquentRepository
{

    protected $model;

    /**
     * Find the model given an ID
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find the model given an ID
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find all models
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->paginate(10);
    }

    public function findIn(array $ids, $column = 'id')
    {
        return $this->model->whereIn($column, $ids)->get();
    }

    /**
     * Update record with the given id and data
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateWithId($id, $data)
    {

        $model = $this->model->findOrFail($id);
        return $this->update($model, $data);
    }

    /**
     * Update record and return model
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateWithIdAndReturnModel($id, $data)
    {
        $model = $this->model->findOrFail($id);
        $this->update($model, $data);

        return $model;
    }

    public function update($model, $data)
    {
        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        $model->save();

        return $model;
    }


    /**
     * Create record and return model
     * @param $data
     * @return mixed
     */
    public function createAndReturnModel($data)
    {
        $model =  $this->model->create($data);

        return $model;
    }

    /**
     * Create
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $model =  $this->model->create($data);
        return $model->toArray();
    }

    public function deleteById($id)
    {
        $model = $this->model->findOrFail($id);

        return $model->delete();
    }

    public function delete($model)
    {
        return $model->delete();
    }
}
