<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TweetRequest;
use App\Http\Resources\TweetResource;
use App\Http\Controllers\Controller;
use App\Tweet;

class TweetController extends Controller
{
    /**
     * TweetController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display list of all tweets.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tweets = Tweet::paginate();

        return TweetResource::collection($tweets);
    }

    /**
     * Storing tweet.
     *
     * @param TweetRequest $request
     * @return TweetResource
     */
    public function store(TweetRequest $request)
    {
        $tweet = auth()->user()->tweets()->create($request->all());

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

        $tweet->delete();

        return response()->json([
            'message' => trans('tweets.messages.deleted'),
        ]);
    }
}
