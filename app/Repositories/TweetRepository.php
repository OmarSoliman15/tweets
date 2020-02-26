<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class TweetRepository extends Repository
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $model = $this->model->fill($data);

        $model->forceFill(['user_id', $data['user_id']]);

        return $model;
    }
}
