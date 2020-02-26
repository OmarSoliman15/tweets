<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Display list of all model data.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->paginate();
    }

    /**
     * Create new model
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /*
     * Delete model
     *
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * show a specific model.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
}
