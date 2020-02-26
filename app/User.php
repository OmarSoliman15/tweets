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
    public function following()
    {
        return $this->belongsToMany(User::class, 'followings', 'user_id', 'follower_id')->withTimestamps();
    }

    /**
     * return follower of this user.
     *
     * @return mixed
     */
    public function follower()
    {
        return $this->belongsToMany(User::class, 'followings', 'follower_id', 'user_id')->withTimestamps();
    }

    /**
     * Determine whether the authenticated user following the user.
     *
     * @return bool
     */
    public function isFollowing()
    {
        $id = auth('api')->id() ?: auth()->id();

        return $this->follower()->where('user_id', $id)->exists();
    }
}
