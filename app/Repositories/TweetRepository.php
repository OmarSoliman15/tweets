<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class TweetRepository extends Repository
{
    /**
     * Display list of all model data.
     *
     * @return mixed
     */
    public function all()
    {
        $auth = auth('api')->user() ?: auth()->user();

        return $this->model->whereIn('user_id', $auth->followings()->pluck('follower_id'))->latest()->paginate();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $model = $this->model->fill($data);

        $model->forceFill(['user_id' => $data['user_id']])->save();

        return $model;
    }
}
