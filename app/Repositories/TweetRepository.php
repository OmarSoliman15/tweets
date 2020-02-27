<?php namespace App\Repositories;

use App\User;
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
        /** @var User $auth */
        $auth = auth('api')->user() ?: auth()->user();

        return $auth->followingTweets()->latest()->paginate();
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
