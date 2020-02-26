<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TweetRequest;
use App\Http\Resources\TweetResource;
use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use App\Repositories\TweetRepository;
use App\Tweet;

class TweetController extends Controller
{
    /**
     * @var Repository
     */
    protected $model;

    /**
     * TweetController constructor.
     * @param Tweet $tweet
     */
    public function __construct(Tweet $tweet)
    {
        $this->middleware('auth:api');

        $this->model = new TweetRepository($tweet);
    }

    /**
     * Display list of all tweets for this user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tweets = $this->model->all();

        return TweetResource::collection($tweets);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $tweet = $this->model->show($id);

        return new TweetResource($tweet);
    }

    /**
     * Storing tweet.
     *
     * @param TweetRequest $request
     * @return TweetResource
     */
    public function store(TweetRequest $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id
        ]);

        $tweet = $this->model->create($request->all());

        return new TweetResource($tweet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tweet $tweet
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete', $tweet);

        $this->model->delete($tweet->id);

        return response()->json([
            'message' => trans('tweets.messages.deleted'),
        ]);
    }
}
