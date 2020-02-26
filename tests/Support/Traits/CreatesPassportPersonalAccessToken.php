<?php

namespace Tests\Support\Traits;

use Mockery;
use Laravel\Passport\PersonalAccessTokenResult;
use Laravel\Passport\PersonalAccessTokenFactory;
use Illuminate\Contracts\Encryption\EncrypterContract;

trait CreatesPassportPersonalAccessToken
{
    /** @before */
    public function registerPersonalAccessTokenFactoryMockCallback()
    {
        $this->afterApplicationCreated(function () {
            $this->app->bind(PersonalAccessTokenFactory::class, function () {
                return Mockery::mock(PersonalAccessTokenFactory::class, function ($mock) {
                    $mock->shouldReceive('make')->andReturn(
                        new PersonalAccessTokenResult('test_access_token', 'test_token')
                    );
                });
            });
        });
    }
}
