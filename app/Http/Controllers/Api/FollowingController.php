<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;

class FollowingController extends Controller
{
    /**
     * FollowingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Follow anther user if not already follow.
     *
     * @param User $user
     * @return UserResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function follow(User $user)
    {
        $this->authorize('follow', $user);

        auth()->user()->follow($user);

        return new UserResource($user);
    }

    /**
     * Unfollow anther user if already follow.
     *
     * @param User $user
     * @return UserResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function unfollow(User $user)
    {
        $this->authorize('unfollow', $user);

        auth()->user()->unfollow($user);

        return new UserResource($user);
    }
}
