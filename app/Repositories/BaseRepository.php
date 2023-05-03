<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $model = app()->make(
            $this->getModel()
        );

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    /**
     * @param int $id
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    // public function getList()
    // {
    //     return $this->model->all();
    // }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function upsert($attributes = [])
    {
        return $this->model->upsert($attributes, ['ma_lsx']);
    }

    public function update($attributes = [], $id)
    {
        return $this->model->where('id', $id)->update($attributes);
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
