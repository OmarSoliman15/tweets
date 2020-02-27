<?php

namespace Tests\Feature\Api;

use App\Tweet;
use App\User;
use Tests\Support\Structure;

class TweetsTest extends TestCase
{
    /** @test */
    public function user_can_list_tweets()
    {
        $this->be($user = factory(User::class)->create(), 'api');

        $tweet = factory(Tweet::class)->create();

        $user->follow($tweet->user);

        $response = $this->get(route('api.tweets.index'));
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => [
                '*' => Structure::make(Tweet::class)
            ],
        ]);

        $this->assertCount(1, $response->json('data'));
    }

    /** @test */
    public function user_can_display_tweet()
    {
        $this->be($user = factory(User::class)->create(), 'api');

        $tweet = factory(Tweet::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->get(route('api.tweets.show', $tweet));

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => Structure::make(Tweet::class),
        ]);
    }

    /** @test */
    public function user_can_store_new_tweet()
    {
        $this->be($user = factory(User::class)->create(), 'api');

        $response = $this->post(route('api.tweets.store', [
            'body' => 'Body of the tweet'
        ]));

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => Structure::make(Tweet::class),
        ]);
    }

    /** @test */
    public function user_can_delete_existing_tweet()
    {
        $this->be($user = factory(User::class)->create(), 'api');

        $tweet = factory(Tweet::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals(1, Tweet::count());

        $response = $this->delete(route('api.tweets.destroy', $tweet));

        $response->assertSuccessful();

        $this->assertEquals(0, Tweet::count());
    }
}
