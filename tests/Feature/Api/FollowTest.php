<?php

namespace Tests\Feature\Api;

use App\User;
use Tests\Support\Structure;

class FollowTest extends TestCase
{
    /** @test */
    public function user_can_follow_anther_user()
    {
        $this->be($auth = factory(User::class)->create(), 'api');

        $user = factory(User::class)->create();

        $response = $this->postJson(route('api.users.follow', $user));

        $response->assertSuccessful();

        $this->assertEquals(1, $auth->followings()->count());
        $this->assertTrue($response->json('data.is_following'));

        $response = $this->postJson(route('api.users.follow', $user));
        $this->assertEquals(1, $auth->followings()->count());

        $response->assertJsonStructure([
            'data' => Structure::make(User::class),
        ]);
    }

    /** @test */
    public function user_can_unfollow_followed_user()
    {
        $this->be($auth = factory(User::class)->create(), 'api');

        $user = factory(User::class)->create();

        $response = $this->postJson(route('api.users.follow', $user));

        $response->assertSuccessful();

        $this->assertEquals(1, $auth->followings()->count());
        $this->assertTrue($response->json('data.is_following'));

        $response = $this->postJson(route('api.users.unfollow', $user));
        $this->assertEquals(0, $auth->followings()->count());
        $this->assertFalse($response->json('data.is_following'));

        $response = $this->postJson(route('api.users.unfollow', $user));
        $this->assertEquals(0, $auth->followings()->count());

        $response->assertJsonStructure([
            'data' => Structure::make(User::class),
        ]);
    }
}
