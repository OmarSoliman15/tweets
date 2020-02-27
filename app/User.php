<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasApiTokens, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * return tweets of this user.
     *
     * @return mixed
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * return following of this user.
     *
     * @return mixed
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followings', 'user_id', 'following_id')
            ->using(Follow::class)
            ->withTimestamps();
    }

    /**
     * return follower of this user.
     *
     * @return mixed
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followings', 'following_id', 'user_id')
            ->using(Follow::class)
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function followingTweets()
    {
        return $this->hasManyThrough(Tweet::class, Follow::class, 'user_id', 'user_id', 'id', 'following_id');
    }

    /**
     * Determine whether the authenticated user following the user.
     *
     * @return bool
     */
    public function isFollowingByAuth()
    {
        $authId = auth('api')->id() ?: auth()->id();

        return $this->followers()->where('user_id', $authId)->exists();
    }

    /**
     * Follow anther user.
     *
     * @param User $user
     */
    public function follow(User $user)
    {
        $this->followings()->syncWithoutDetaching($user);
    }

    /**
     * Unfollow anther user.
     *
     * @param User $user
     */
    public function unfollow(User $user)
    {
        if ($follow = $this->followings()->where('following_id', $user->id)->first()) {
            $this->followings()->detach($user);
        }
    }
}
